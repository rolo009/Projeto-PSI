<?php
namespace frontend\models;

use yii\base\Model;

class SearchModel extends Model
{
    public $procurar;

    public function rules()
    {
        return [
            [['procurar'], 'required', 'message'=>'O campo Procurar não pode estar em branco!'],
            [['procurar'], 'string', 'max' => 255],
        ];
    }

}