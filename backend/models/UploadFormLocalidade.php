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
            [['imageFile'], 'required', 'message'=>'O campo Imagem não pode estar em branco!'],
        ];
    }

    public function upload()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');

        $this->imageFile->saveAs(Yii::getAlias('@webroot').'/imagens/img-localidade/' . $this->imageFile->name);

    }
}