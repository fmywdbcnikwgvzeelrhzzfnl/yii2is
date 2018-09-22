<?php

namespace frontend\modules\api\models;

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
class Project extends \common\models\ProjectModel
{
    /**
     * Говорит о том, какие поля будут возвращены при запросе через API
     * @return array
     */
    public function fields()
    {
        return ['id','title',];
    }
}
