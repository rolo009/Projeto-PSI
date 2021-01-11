<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

class UploadFormLocalidade extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function uploadFrontend()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');

        $this->imageFile->saveAs(Yii::getAlias('@frontend').'/web/imagens/img-localidade/' . $this->imageFile->name);

    }
}