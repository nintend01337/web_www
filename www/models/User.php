<?php


namespace app\models;


use yii\db\ActiveRecord;

class User extends ActiveRecord
{
//    public $id;
//    public $username;
//    public $password;

    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

   /**  Мусорные функции которые необходимо убрать,

        пока что сделаю временную заглушку для них.
   */
/*    public function validateAuthKey($authKey)
    {
        return null ;
    }
    public function getAuthKey()
    {
        return null;
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }
*/

}