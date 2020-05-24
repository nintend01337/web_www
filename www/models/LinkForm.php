<?php


namespace app\models;


use yii\base\Model;
use app\models\Link;

class LinkForm extends Model
{
    public $user_id;
    public $origin;
    public $short;
    public $create_date;
    public $expire_date;


    public function rules()
    {
       return [
           [['origin'],'required'],
//           ['origin','url']
       ];
    }
 public function  attributeLabels()
 {
     return [
         'origin' => 'Ссылка',
         'short' => 'Короткая Ссылка',
     ];
 }

    public function createLink()
    {
        $link = new Link();
        $link->origin = $this->origin;
        $link->short-> generateShort($this->origin);
        $link->create_date->getDate();
        $link->expire_date->getExpireDate($link->create_date);
     // return $link;
         return $link->save();
    }

    protected function getDate()
    {
        return date("d-m-y");
    }

    protected function getExpireDate($date)
    {
        $date_time = new DateTime();
        $date_time->add(new \DateInterval('P15D')); // прибавляем 15 дней к дате создания
        $date_time->format('d-m-y');

        return $date_time;
    }
}