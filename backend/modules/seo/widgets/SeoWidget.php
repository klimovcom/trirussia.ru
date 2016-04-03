<?php
namespace seo\widgets;

use seo\models\Seo;
use yii\base\Widget;

/**
 * Class SeoWidget
 *
 * @property \yii\base\Model $model
 * @property boolean $form
 */
class SeoWidget extends Widget
{

	public $model = null;

	public $form = false;

	public $tab = false;

	public $style = 'btn btn-primary';

	public $onlyButton = false;

	public $onlyForm = false;

	public function run()
	{
		if ($this->onlyButton) {
			return $this->render('seo', ['class' => $this->style, 'onlyButton' => $this->onlyButton]);
		}

		$seo = new Seo();
		if ($this->model) {
			if ($this->form) {
				$seo = Seo::findOne(['model_name' => Seo::getModelName($this->model), 'model_id' => 0]);

				if(!$seo) {
					$seo = new Seo();
				}

				$seo->model_name = Seo::getModelName($this->model);
				$seo->model_id = 0;
			} elseif($this->model && !$this->model->isNewRecord) {
				$seo = Seo::findOne(['model_name' => Seo::getModelName($this->model), 'model_id' => $this->model->id]);
				if(!$seo) {
					$seo = new Seo();
				}
			}
		}

		if ($this->tab) {
			return $this->render('seo_tab', ['seo' => $seo, 'model' => $this->model]);
		} else {
			return $this->render('seo', ['seo' => $seo, 'model' => $this->model, 'isForm' => $this->form, 'class' => $this->style, 'onlyForm' => $this->onlyForm, 'onlyButton' => $this->onlyButton]);
		}

	}
}

?>
