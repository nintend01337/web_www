<?php


namespace app\models;


use yii\base\Model;
use Yii;
use app\models\Link;
use yii\helpers\VarDumper;

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

        $link->user_id = Yii::$app->getUser();
        $link->origin = $this->origin;
        $link->short = Link::generateShort();
        $link->create_date = getDate();
     //   $link->getExpireDate($this->expire_date);
     // return $link;
        // return $link->save();
        VarDumper::dump(Yii::$app->getUser(),10,true);
    }

    protected function getDate()
    {
        $this->create_date =  date("d-m-y");
    }

    protected function getExpireDate($create_date)
    {
        $date_time = new DateTime();
        $date_time->add(new \DateInterval('P15D')) ; // прибавляем 15 дней к дате создания
        $date_time->format('d-m-y');

        $this->expire_date =  $date_time;
    }
}