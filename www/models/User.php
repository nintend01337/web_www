<?php


namespace app\models;


use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class User extends ActiveRecord implements IdentityInterface
{

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findByUsername($username)
    {
        return self::findOne($username);
    }

    public function getId()
    {
        return $this->id;
    }

    public function hashPassword($password)
    {
        //  $this->password = sha1($password);

        //  $this->password = sha1($password);
        //Вот здесь вылетает ошибка
        // Class 'app\models\Yii' not found
        // upd. Fixed
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    //Валидация не работает нужным образом т.к в базах хранится ша1 и
    // он отличается от хешей который генерирует фреймворк
    //
    //
    //

    public function validatePassword($password)
    {
        $hash = $this->hashPassword($password);

//        return $this->password === sha1($password);
        return Yii::$app->security->validatePassword($password, $this->hash);
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

}