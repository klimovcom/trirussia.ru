<?php

namespace backend\extensions;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;
use vova07\imperavi\Widget;
use yii\base\Action;
use yii\base\DynamicModel;
use yii\base\InvalidCallException;
use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use Yii;


class UploadAction extends \vova07\imperavi\actions\UploadAction {

    public $width;
    public $height;

    /**
     * @var string Model validator name
     */
    private $_validator = 'image';

    public function init() {
        parent::init();

        if (!$this->width || !$this->height) {
            throw new InvalidCallException("Image size must be set");
        }

    }

    public function run()
    {
        if (Yii::$app->request->isPost) {
            $file = UploadedFile::getInstanceByName($this->uploadParam);
            $model = new DynamicModel(compact('file'));
            $model->addRule('file', $this->_validator, $this->validatorOptions)->validate();

            if ($model->hasErrors()) {
                $result = [
                    'error' => $model->getFirstError('file')
                ];
            } else {
                if ($this->unique === true && $model->file->extension) {
                    $model->file->name = uniqid('', true) . '.' . $model->file->extension;
                }
                if ($model->file->saveAs($this->path . $model->file->name)) {

                    $this->resizeImage($this->path . $model->file->name);

                    $result = ['filelink' => $this->url . $model->file->name];
                    if ($this->uploadOnlyImage !== true) {
                        $result['filename'] = $model->file->name;
                    }
                } else {
                    $result = [
                        'error' => Yii::t('vova07/imperavi', 'ERROR_CAN_NOT_UPLOAD_FILE')
                    ];
                }
            }
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $result;
        } else {
            throw new BadRequestHttpException('Only POST is allowed');
        }
    }

    public function resizeImage($imagePath) {
        $imagine = new \Imagine\Imagick\Imagine();
        $image = $imagine->open($imagePath);
        $image->interlace(ImageInterface::INTERLACE_PLANE);

        //resize
        $size = $image->getSize()->widen($this->width);
        $image->resize($size, ImageInterface::FILTER_SINC);

        //crop to needed height

        if ($image->getSize()->getHeight() > $this->height) {
            $cropBox = new Box($this->width, $this->height);
            $cropPoint = new Point(0, ($image->getSize()->getHeight() - $this->height)/2);
            $image->crop($cropPoint, $cropBox);
        }
        $image->getImagick()->setImageCompressionQuality(70);
        $image->getImagick()->setImageFormat('jpg');
        $image->getImagick()->stripImage();

        $image->save($imagePath);
    }
}