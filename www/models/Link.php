<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "link".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $origin
 * @property string|null $short
 * @property date|null $create_date
 * @property date|null $expire_date
 * @property int|null $count
 *
 * @property User $user
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'count'], 'integer'],
            [['create_date', 'expire_date'], 'safe'],
            [['origin'], 'string', 'max' => 1024],
            [['short'], 'unique','targetClass' => 'app\models\Link','targetAttribute'=> 'short'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'origin' => 'Origin',
            'short' => 'Short',
            'create_date' => 'Create Date',
            'expire_date' => 'Expire Date',
            'count' => 'Count',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
