<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $text
 * @property string $dt
 * @property int $creator_id
 * @property int $created_at
 *
 * @property Access[] $accesses
 * @property User[] $accessedUsers
 * @property Users $creator
 */
class Event extends \yii\db\ActiveRecord
{

    const RELATION_ACCESSES = 'accesses';
    const RELATION_CREATOR = 'creator';
    const RELATION_ACCESSES_USERS = 'accessedUsers';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'dt', 'creator_id'], 'required'],
            [['text'], 'string'],
            [['dt'], 'safe'],
            [['creator_id', 'created_at'], 'integer'],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['creator_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'dt' => 'Dt',
            'creator_id' => 'Creator ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesses()
    {
        return $this->hasMany(Access::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    public function getAccessedUsers()
    {
        return $this->hasMany(User::class, ['id' =>'user_id'])->via(self::RELATION_ACCESSES);
    }
    /**
     * {@inheritdoc}
     * @return \app\models\query\EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\EventQuery(get_called_class());
    }
}
