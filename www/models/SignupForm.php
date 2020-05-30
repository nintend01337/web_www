<?php


namespace app\models;
use yii\base\Model;
use yii\base\Security;
use app\models\User;
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
            $user = new User();
            $user->username = $this->username;
            $user->hashPassword($this->password);

            return $user->save();
    }
}