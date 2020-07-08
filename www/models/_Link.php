<?php


namespace app\models;


use yii\db\ActiveRecord;

class Link extends ActiveRecord
{

    public function generateShort()
    {
        return uniqid('localhost/s/',false);
    }

}