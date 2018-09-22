<?php

namespace frontend\modules\api\models;

use common\models\ProjectModel;
use common\models\ProjectUserModel;
use Yii;

/**
 * This is the model class for table "User".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property string $avatar
 * @property int $created_at
 * @property int $updated_at
 */
class User extends \common\models\User
{
    /**
     * Говорит о том, какие поля будут возвращены при запросе через API
     * @return array
     */
    /*public function fields()
    {
        return ['id',
            'nameTEST' => 'username',
            'mixed' => function (User $model) {
                return $model->username . ': ' . User::STATUSES[$model->status];
            }];
    }*/

    /**
     * @return array
     */
    public function extraFields()
    {
        return [
            'projectUsers',
            'projects',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectUsers()
    {
        return $this->hasMany(ProjectUserModel::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(ProjectModel::className(), ['id' => 'project_id'])->via('projectUsers');
    }


}
