<?php

namespace common\models\query;

use common\models\TaskModel;
use common\models\User;
use Yii;

/**
 * This is the ActiveQuery class for [[\common\models\TaskModel]].
 *
 * @see \common\models\TaskModel
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\TaskModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\TaskModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function onlyActive($userId, $role = null)
    {
        $this->andWhere(['status' => User::STATUS_ACTIVE]);
        return $this;
    }

    public function byTasks(User $user, $task_role)
    {
        $query = User::find()
            ->select('username')
            ->indexBy('id')
            ->andWhere(['id' => TaskModel::find()->byUser($user)->select($task_role)])
            ->column()
        ;
        return $query;
    }
}
