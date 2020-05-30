<?php


namespace app\models;


use yii\db\ActiveRecord;

class Link extends ActiveRecord
{

    public function generateShort()
    {
        //$short = preg_replace("(^https?://www.)", "", $link );
//        $rem =  array('http://','https://','www.');
//        $short = str_replace($rem,$link,1);
//        $short = sha1($link);
//        $short = substr($short,-10);
//        $result = 'localhost/';
//        $result.= $short;

        return uniqid('localhost/s/',false);
    }

}