<?php

namespace common\models\query;

use common\models\ProjectUserModel;

/**
 * This is the ActiveQuery class for [[\common\models\ProjectModel]].
 *
 * @see \common\models\ProjectModel
 */
class ProjectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\ProjectModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\ProjectModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byUser($userId, $role = null)
    {
        $query = ProjectUserModel::find()->select('project_id')->byUser($userId, $role);
        //$query = ProjectUserModel::find()->select('project_id')->andWhere(['user_id' => $userId]);
        return $this->andWhere(['id' => $query]);
    }
}
