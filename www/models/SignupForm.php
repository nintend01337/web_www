<?php


namespace app\models;
use app\models\User;
use yii\base\Model;
class SignupForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username','password'],'required'],
            ['username','unique','targetClass' =>'app\models\User','targetAttribute' => 'username'],
            ['password','string','min'=>4,'max'=>8],
        ];
    }

    public function signup(){
         if ($this->validate())
         {
             $user = new User();
             $user->username = $this->username;
             $user->hashPassword($this->password);

             if (!$user->save(false)) {
                 return null;
             }
            return $user;
         }
            return false;
    }
}