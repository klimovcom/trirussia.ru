<?php

namespace seo\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "seo".
 *
 * @property integer $id
 * @property string $model_name
 * @property integer $model_id
 * @property string $title
 * @property string $keywords
 * @property string $description
 */
class Seo extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'seo';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['model_name', 'model_id'], 'required'],
			[['model_id'], 'integer'],
			[['description'], 'string'],
			[['model_name', 'title', 'keywords', 'title', 'keywords', 'description'], 'trim'],
			[['model_name', 'title', 'keywords', 'title', 'keywords', 'description'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'model_name' => 'Имя модели',
			'model_id' => 'ID модели',
			'title' => 'Заголовок',
			'keywords' => 'Ключевые слова',
			'description' => 'Описание',
		];
	}

	/**
	 * @param \yii\web\View $view
	 *
	 * */
	public static function RegisterMetaTags($view, $model) {
		$seo = self::findOne(['model_name' => Seo::getModelName($model),'model_id' => $model->id ? $model->id : 0]);
		if ($seo) {
			$view->title = Html::encode($seo->title);
			$view->registerMetaTag(['name' => 'keywords', 'content' => $seo->keywords], 'keywords');
			$view->registerMetaTag(['name' => 'description', 'content' => $seo->description], 'description');
		}
	}

	public static function getModelName($model) {
		$reflect = new \ReflectionClass($model);
		return $reflect->getShortName();
	}
}
