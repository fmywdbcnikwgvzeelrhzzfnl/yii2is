<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\ProjectUserModel]].
 *
 * @see \common\models\ProjectUserModel
 */
class ProjectUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\ProjectUserModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\ProjectUserModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byUser($userId, $role = null)
    {
        $this->andWhere(['user_id' => $userId]);
        if ($role) {
            $this->andWhere(['role' => $role]);
        }
        return $this;
    }
}
