<?php
namespace frontend\controllers;

use distance\models\DistanceCategory;
use organizer\models\Organizer;
use promo\models\Promo;
use race\models\Race;
use race\models\RaceDistanceCategoryRef;
use seo\models\Seo;
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
                        'actions' => [
                            'login',
                            'error',
                            'auth',
                            'index',
                            'magazine',
                            'about',
                            'advertising',
                            'domains',
                            'bmi',
                            'convert',
                            'privacy',
                            'search-races',
                            'sport',
                            'sitemap',
                        ],
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
        //$token = $client->getAccessToken()->getToken();
        //$client->setReturnUrl(\Yii::$app->request->url);

        //Yii::info(json_encode($attributes));

        switch ($client->name) {
            case 'facebook' :
                $email = $attributes['email'];
                $username = $attributes['email'];
                $fb_id = $attributes['id'];
                $first_name = explode(' ', $attributes['name'])[0];
                $last_name = explode(' ', $attributes['name'])[1];
                $sex = $attributes['gender'];
                $locale = $attributes['locale'];
                $timezone = $attributes['timezone'];
                $age = $attributes['age_range']['min'] . '|' . $attributes['age_range']['max'];
                $birthday = '';
                $photo_url = $attributes['picture']['data']['url'];
                break;
            case 'google' :
                $email = $attributes['emails'][0]['value'];
                $username = $attributes['emails'][0]['value'];
                $fb_id = '';
                $first_name = $attributes['name']['givenName'];
                $last_name = $attributes['name']['familyName'];
                $sex = $attributes['gender'];
                $locale = '';
                $timezone = '';
                $age = $attributes['ageRange']['min'] . '|' . $attributes['ageRange']['max'];
                $birthday = '';
                $photo_url = $attributes['image']['url'];
                break;
            case 'vkontakte' :
                $email = $attributes['email'];
                $username = $attributes['email'];
                $fb_id = '';
                $first_name = $attributes['first_name'];
                $last_name = $attributes['last_name'];
                if ($attributes['sex'] == 1) {
                    $sex = 'female';
                }else {
                    $sex = 'male';
                }
                $locale = '';
                $timezone = $attributes['timezone'];
                $age = '';
                $birthday = date("Y-m-d H:i", strtotime($attributes['bdate']));
                $photo_url = $attributes['photo'];
                break;
        }

        if (!empty($email)){
            $user = User::find()->where(['email'=> $email])->one();
            if (!$user){
                $user = new User();
                $user->email = $email;
                $user->username = $email;
                $user->fb_id = $fb_id;
                $user->first_name = $first_name;
                $user->last_name = $last_name;

                $listId = '4a7ae4d6e6';
                $mailChimp = new \DrewM\MailChimp\MailChimp(Yii::$app->params['MailChimpApiKey']);
                $mailChimp->post('lists/' . $listId . '/members', ['email_address' => $email, 'status' => 'subscribed']);
            }
            $user->sex = $user->sex ? $user->sex : $sex;
            $user->locale = $user->locale ? $user->locale : $locale;
            $user->timezone = $timezone ? $timezone : $user->timezone;
            $user->age = $age ? $age : $user->age;
            $user->photo_url = $photo_url ? $photo_url : $user->photo_url;
            $user->birthday = $user->birthday ? $user->birthday : $birthday;
            $user->save(false);

            Yii::$app->user->login($user, 3600 * 24 * 30);
        }
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $promos = Promo::find()->orderBy('created DESC')->limit(6)->all();

        $sportModel = null;

        $mainRaces = Race::find()->where(['>=', 'start_date', date('Y-m-d', time())])->published()->orderBy('start_date ASC, id DESC')->limit(12)->all();
        $secondaryRaces = Race::find()->where(['>=', 'start_date', date('Y-m-d', time())])->published()->orderBy('start_date ASC, id DESC')->limit(12)->offset(12)->all();
        $lastRaces = Race::find()->where(['>=', 'start_date', date('Y-m-d', time())])->published()->orderBy('start_date ASC, id DESC')->limit(13)->offset(24)->all();

        $showMore = false;
        if (count($lastRaces) > 12){
            $showMore = true;
            array_pop($lastRaces);
        }

        return $this->render('index', [
            'mainRaces' => $mainRaces,
            'promos' => $promos,
            'showMore' => $showMore,
            'secondaryRaces' => $secondaryRaces,
            'lastRaces' => $lastRaces,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionSport($sport)
    {
        $races = Race::searchForSportPage($sport);

        Seo::registerModel(Sport::getCurrentSportModel());

        $showMore = false;
        if (count($races) > 12){
            $showMore = true;
            array_pop($races);
        }



        return $this->render('races', [
            'races' => $races,
            'showMore' => $showMore,
        ]);
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSearchRaces()
    {
        $sportModelSeo = Sport::getCurrentSportModel();
        if (!$sportModelSeo){
            $sportModelSeo = new Sport();
        }

        Seo::registerModel($sportModelSeo);

        $raceCondition = Race::find();

        $sportModel = null;
        if (!empty($_GET['sport'])){
            if ($sportModel = Sport::find()->where(['url' => $_GET['sport']])->one()) {
                $raceCondition->andWhere(['sport_id'  => $sportModel->id ]);
            } else {
                throw new NotFoundHttpException();
            }
        }

        if (!empty($_GET['distance'])){
            $idArray = [];
            $distance = DistanceCategory::find()
                ->where(['label' => $_GET['distance'], ]);
            if ($sportModel){
                $distance->andWhere(['sport_id'  => $sportModel->id ]);
            }
            $distance = $distance->one();
            if (!$distance){
                throw new NotFoundHttpException();
            }
            $refs = RaceDistanceCategoryRef::find()->where(['distance_category_id' => $distance->id, ])->all();
            foreach ($refs as  $ref)
                $idArray[] = $ref->race_id;
            if (!empty($idArray))
                $raceCondition->andWhere(['in', Race::tableName() . '.id', $idArray]);
        }

        if (!empty($_GET['date'])){
            $dateFrom = $_GET['date'] . '-01';
            if (substr($dateFrom, 0, 8) == date('Y-m-')){
                $dateFrom = substr($_GET['date'], 0, 8).date('-d');
            }
            $raceCondition->andWhere(['between', 'start_date', $dateFrom, substr($_GET['date'], 0, 8) . '-31']);
        } else {
            $raceCondition->andWhere(['>=', 'start_date', date('Y-m-d', time())]);
        }
        if (!empty($_GET['country'])) $raceCondition->andWhere([Race::tableName().'.country' => $_GET['country']]);

        if (!empty($_GET['organizer'])){
            $raceCondition->leftJoin(Organizer::tableName(), 'organizer_id = organizer.id');
            $raceCondition->andWhere(['organizer.label' => $_GET['organizer']]);
        }

        $raceCondition->andWhere(['race.published' => 1]);
        
        if (!empty($_GET['sort']) && $_GET['sort'] == 'popular'){
            $races = $raceCondition->orderBy('popularity DESC, start_date ASC, id DESC')->limit(13)->all();
        } else {
            $races = $raceCondition->orderBy('start_date ASC, id DESC')->limit(13)->all();
        }
        $showMore = false;
        if (count($races) > 12){
            $showMore = true;
            array_pop($races);
        }
        return $this->render('search-races', [
            'races' => $races,
            'showMore' => $showMore,
        ]);
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
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCalendar(){
        $startDate = date('Y-m-d', time());
        $endDate = date('Y-m-d', strtotime('+1year'));

        $joinedRaces = Race::find()->joinWith('willGo')->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['>', 'start_date', $startDate])->andWhere(['<', 'start_date', $endDate])->all();
        $notJoinedRaces = Race::find()->where(['not in', 'id', ArrayHelper::getColumn($joinedRaces, 'id')])->andWhere(['>', 'start_date', $startDate])->andWhere(['<', 'start_date', $endDate])->all();

        $joinedRacesArray = ArrayHelper::index($joinedRaces, null, 'start_date');
        $notJoinedRacesArray = ArrayHelper::index($notJoinedRaces, null, 'start_date');

        return $this->render('calendar', [
            'joinedRacesArray' => $joinedRacesArray,
            'notJoinedRacesArray' => $notJoinedRacesArray,
        ]);
    }

    
    //static pages

    public function actionAdvertising()
    {
        return $this->render('advertising');
    }

    public function actionDomains()
    {
        return $this->render('domains');
    }

    public function actionBmi()
    {
        return $this->render('bmi');
    }

    public function actionConvert()
    {
        return $this->render('convert');
    }

    public function actionPrivacy() {
        return $this->render('privacy');
    }

    public function actionLogin() {
        return $this->render('login');
    }

    public function actionSitemap() {
        //static
        $routes = [
            ['site/index'],
            ['site/advertising'],
            ['site/domains'],
            ['site/bmi'],
            ['site/convert'],
            ['site/calendar'],
            ['site/about'],
            ['site/privacy'],
            ['site/search-races'],
            ['post/default/index'],
            ['organizer/default/index'],
            ['race/default/create'],
            ['product/default/index'],
            ['promocode/default/index'],
            ['coach/default/index'],
        ];
        $items = [];
        $models = [
            '\sport\models\Sport',
            '\race\models\Race',
            '\post\models\Post',
            '\product\models\Product',
            '\coach\models\Coach',
        ];
        foreach ($models as $model) {
            $items = array_merge($items, $model::find()->published()->all());
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->set('Content-type', 'text/xml');

        return $this->renderPartial('sitemap', [
            'routes' => $routes,
            'items' => $items,
        ]);
    }
}
