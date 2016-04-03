<?php

namespace seo\controllers;

use Yii;
use seo\models\Seo;
use seo\models\SeoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SeoController implements the CRUD actions for Seo model.
 */
class SeoController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all Seo models.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new SeoSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render(
			'index',
			[
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]
		);
	}

	/**
	 * Displays a single Seo model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render(
			'view',
			[
				'model' => $this->findModel($id),
			]
		);
	}

	/**
	 * Creates a new Seo model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Seo();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render(
				'create',
				[
					'model' => $model,
				]
			);
		}
	}

	/**
	 * Updates an existing Seo model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render(
				'update',
				[
					'model' => $model,
				]
			);
		}
	}

	/**
	 * Deletes an existing Seo model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Seo model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Seo the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Seo::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionModel()
	{
		$model = new Seo();
		$post = Yii::$app->request->post();
		if ($model->load($post)) {

			if ($seo = Seo::findOne(['model_name' => $model->model_name, 'model_id' => 0])) {
				$seo->load($post);
				$seo->save();
			} else {
				$model->save();
			}
		}
		return $this->redirect(Yii::$app->request->referrer);
	}
}
