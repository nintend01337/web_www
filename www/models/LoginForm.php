<?php


namespace app\models;


class LoginForm extends Model
{
        public $username;
        public $password;

        public function rules()
        {
            return [
                [['username','password'],'required'],
                [['password'],'unique ' ],
            ];
        }
}