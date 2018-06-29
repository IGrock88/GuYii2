<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Event]].
 *
 * @see \app\models\Event
 */
class EventQuery extends \yii\db\ActiveQuery
{
    public function byCreator($userId)
    {
        return $this->andWhere(['=', 'creator_id', $userId]);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Event[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Event|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
