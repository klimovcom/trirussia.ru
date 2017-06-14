<?php

namespace seo\components;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use seo\models\Seo;
use Yii;
use yii\web\UploadedFile;

/**
 * Class SeoModelBehavior
 *
 * @property \yii\base\Model $owner
 */
class SeoModelBehavior extends Behavior
{
	public function events()
	{
		return [
			ActiveRecord::EVENT_AFTER_INSERT => 'setSeo',
			ActiveRecord::EVENT_AFTER_UPDATE => 'updateSeo',
			ActiveRecord::EVENT_AFTER_DELETE => 'deleteSeo',
		];
	}

	public function setSeo() {
		$model = new Seo();

		$model->model_name = Seo::getModelName($this->owner);
		$model->model_id = $this->owner->id;

		$image = UploadedFile::getInstance($model, 'og_image_id');

		if ($model->load(Yii::$app->request->post())) {
			if (strlen($model->title) || strlen($model->keywords) || strlen($model->description) || $image) {
				$model->save();
			}
		}
	}

	public function updateSeo() {
		$model = Seo::findOne(['model_name' => Seo::getModelName($this->owner),'model_id' => $this->owner->id]);

		if (!$model) {
			$model = new Seo();
			$model->model_name = Seo::getModelName($this->owner);
			$model->model_id = $this->owner->id;
		}

		$image = UploadedFile::getInstance($model, 'og_image_id');

		if ($model->load(Yii::$app->request->post())) {
			if (strlen($model->title) || strlen($model->keywords) || strlen($model->description) || $image || $model->og_image_id) {
				$model->save();
			}
		}
	}

	public function deleteSeo() {
		$model = Seo::findOne(['model_name' => Seo::getModelName($this->owner),'model_id' => $this->owner->id]);
		if ($model) {
			$model->delete();
		}
	}

}
