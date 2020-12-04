<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

class UploadForm extends Model
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

    public function upload()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');

        $this->imageFile->saveAs(Yii::getAlias('@webroot').'/imagens/img-pt/' . $this->imageFile->name);
/*
        if ($this->validate()) {
            $this->imageFile->saveAs('@web/imagens/img-pt/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }*/
    }
}