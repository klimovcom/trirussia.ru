<?php
namespace frontend\controllers;

use distance\models\DistanceCategory;
use race\models\Race;
use race\models\RaceDistanceCategoryRef;
use sport\models\Sport;
use user\models\User;
use willGo\models\WillGo;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\authclient\ClientInterface;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                /*'only' => ['logout', 'signup'],*/
                'rules' => [
                    [
                        'actions' => [ 'login', 'error', 'auth', 'index' ],
                        'allow'   => true,
                    ],
                    [
                        'actions' => [ 'logout', 'calendar'],
                        'allow'   => true,
                        'roles'   => [ '@' ],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'oAuthSuccess'],
            ],
        ];
    }

    /**
     * This function will be triggered when user is successfuly authenticated using some oAuth client.
     *
     * @param ClientInterface $client
     * @return bool Response
     */
    public function oAuthSuccess($client) {
        if (!$this->action instanceof \yii\authclient\AuthAction) {
            throw new \yii\base\InvalidCallException("successCallback is only meant to be executed by AuthAction!");
        }

        $attributes = $client->getUserAttributes();
        //$client->setReturnUrl(\Yii::$app->request->url);

        if (!empty($attributes['email'])){
            $user = User::find()->where(['email'=>$attributes['email']])->one();
            if (!$user){
                $user = new User();
                $user->email = $attributes['email'];
                $user->username = $attributes['email'];
                $user->fb_id = $attributes['id'];
                $user->first_name = explode(' ', $attributes['name'])[0];
                $user->last_name = explode(' ', $attributes['name'])[1];
                $user->save(false);
            }
            Yii::$app->user->login($user);
        }
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($sport = null)
    {
        $raceCondition = Race::find();

        $sportModel = null;
        if ($sport){
            if ($sportModel = Sport::find()->where(['url' => $sport])->one()) {
                $raceCondition->andWhere(['sport_id'  => $sportModel->id ]);
            } else {
                throw new NotFoundHttpException();
            }
        }


        if (!empty($_GET['distance'])){
            $idArray = [];
            $distance = DistanceCategory::find()->where(['label' => $_GET['distance'], 'sport_id'  => $sport->id ])->one();
            if (!$distance){
                throw new NotFoundHttpException();
            }
            $refs = RaceDistanceCategoryRef::find()->where(['distance_category_id' => $distance->id, ])->all();
            foreach ($refs as  $ref)
                $idArray[] = $ref->race_id;
            if (!empty($idArray))
                $raceCondition->andWhere(['in', 'id', $idArray]);
        }

        if (!empty($_GET['date'])){
            $raceCondition->andWhere(['between', 'start_date', $_GET['date'], substr($_GET['date'], 0, 8) . '31']);
        } else {
            $raceCondition->andWhere(['>=', 'start_date', date('Y-m-d', time())]);
        }

        if (!empty($_GET['country'])) $raceCondition->andWhere(['country' => $_GET['country']]);

        if (!empty($_GET['organizer'])){
            $raceCondition->leftJoin('{{%organizer}}', 'organizer_id = organizer.id');
            $raceCondition->andWhere(['organizer.label' => $_GET['organizer']]);
        }

        if ($sportModel){
            $races = $raceCondition->orderBy('start_date DESC')->limit(12)/*->offset($page*12)*/->all();
            return $this->render('races', [
                'races' => $races,
            ]);
        } else {
            $mainRaces = Race::find()->where(['>=', 'start_date', date('Y-m-d', time())])->orderBy('start_date ASC')->limit(12)/*->offset($page*12)*/->all();
            $secondaryRaces = Race::find()->where(['>=', 'start_date', date('Y-m-d', time())])->orderBy('start_date ASC')->limit(12)->offset(12)->all();
            $lastRaces = Race::find()->orderBy('start_date DESC')->limit(12)->offset(24)->all();
            return $this->render('index', [
                'mainRaces' => $mainRaces,
                'secondaryRaces' => $secondaryRaces,
                'lastRaces' => $lastRaces,
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionCalendar(){
        $joins = ArrayHelper::map(WillGo::find()->where(['user_id' => Yii::$app->user->identity->id])->all(), 'race_id', 'race_id');
        $idArray = array_values($joins);
        $races = Race::find()->where(['in', 'id', $idArray])->all();
        $racesArrayImproved = [];
        /** @var Race $race */
        foreach ($races as $race){
            if (!isset($racesArrayImproved[strtotime($race->start_date)])){
                $racesArrayImproved[strtotime($race->start_date)] = [$race];
            } else {
                $racesArrayImproved[strtotime($race->start_date)][] = $race;
            }

        }
        return $this->render('calendar', ['races'=>$racesArrayImproved, ]);
    }
}
