<?php

namespace app\models\query;
use app\models\User;

/**
 * This is the ActiveQuery class for [[\app\models\User]].
 *
 * @see \app\models\User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }


    public function acceptedUsers($idCurrentUser)
    {
        return $this
            ->where(['<>', 'id', $idCurrentUser])
            ->select('name')
            ->indexBy('id')
            ->column();
    }
}
