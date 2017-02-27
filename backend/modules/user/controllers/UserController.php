<?php

namespace user\controllers;

use backend\components\BackController;
use Faker\Factory;
use Yii;
use user\models\User;
use user\models\UserSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BackController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [

                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /*$faker = Factory::create();
        for($i = 0; $i < 30; $i++){
            $model = new User();
            $model->setAttributes([
                'username' => $faker->userName,
                'auth_key' => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
                'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),
                'email' => $faker->email,
                'status' => '10',
                'created_at' => time(),
                'updated_at' => time(),
            ]);
            $model->save();
        }*/

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->role = array_keys(Yii::$app->authManager->getRolesByUser($id));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMailchimp() {
        $mailChimp = new \DrewM\MailChimp\MailChimp(Yii::$app->params['MailChimpApiKey']);
        $mailChimp->verify_ssl = true;

        $listId = '4a7ae4d6e6';

        $mailChimpUsers = $mailChimp->get('lists/' . $listId . '/members', ['count' => 320]);
        $mailChimpUsersEmails = ArrayHelper::getColumn($mailChimpUsers['members'], 'email_address');

        $users = ArrayHelper::getColumn(User::find()->where(['not', ['id' => [1, 1263]]])->all(), 'email');

        $i=0;
        foreach ($users as $user) {
            if (!in_array($user, $mailChimpUsersEmails)) {
                $mailChimp->post('lists/' . $listId . '/members', ['email_address' => $user, 'status' => 'subscribed']);
                $i++;
            }
        }
        echo $i;


    }
}
