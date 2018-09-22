<?php

namespace common\models\query;

use common\models\ProjectModel;

/**
 * This is the ActiveQuery class for [[\common\models\TaskModel]].
 *
 * @see \common\models\TaskModel
 */
class TaskQuery extends \yii\db\ActiveQuery
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

    public function byUser($userId, $role = null)
    {
        $query = ProjectModel::find()->select('id')->byUser($userId);
        return $this->andWhere(['project_id' => $query]);
    }
}
