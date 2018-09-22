<?php /** @noinspection ALL */

namespace common\models;

use mohorev\file\UploadImageBehavior;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\validators\SafeValidator;
use yii\validators\UniqueValidator;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $avatar
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @mixin UploadImageBehavior
 */
class User extends ActiveRecord implements IdentityInterface
{
    private $password;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUSES = [
        self::STATUS_DELETED => 'удален',
        self::STATUS_ACTIVE => 'активен',
    ];

    const AVATAR_ICO = 'ico';
    const AVATAR_ICO_BIG = 'ico_big';
    const AVATAR_ICO_MIN = 'ico_min';
    const AVATAR_PREVIEW = 'preview';

    const SCENARIO_ADMIN_CREATE = 'admin_create';
    const SCENARIO_ADMIN_UPDATE = 'admin_update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => UploadImageBehavior::class,
                'attribute' => 'avatar',
                'scenarios' => [self::SCENARIO_ADMIN_CREATE, self::SCENARIO_ADMIN_UPDATE],
                //'placeholder' => '@frontend/web/upload/avatar/',
                'path' => '@frontend/web/upload/avatar/{id}',
                'url' => 'http://localhost/upload/avatar/{id}',
                'thumbs' => [
                    self::AVATAR_PREVIEW => ['width' => 400, 'quality' => 90],
                    self::AVATAR_ICO => ['width' => 30, 'height' => 30, 'bg_color' => '333'],
                    self::AVATAR_ICO_BIG => ['width' => 45, 'height' => 45, 'bg_color' => '333'],
                    self::AVATAR_ICO_MIN => ['width' => 22, 'height' => 22, 'bg_color' => '333'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['avatar', 'file', 'extensions' => 'jpeg, jpg, gif, png', 'minSize' => 1, 'maxSize' => 1000000],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            [['password', 'email', 'username',], 'required', 'on' => self::SCENARIO_ADMIN_CREATE],
            ['password', SafeValidator::className(), 'on' => self::SCENARIO_ADMIN_UPDATE],
            [['email', 'username',], 'required', 'on' => self::SCENARIO_ADMIN_UPDATE],

            ['email', 'email', 'on' => [self::SCENARIO_ADMIN_UPDATE, self::SCENARIO_ADMIN_CREATE]],
            ['username', UniqueValidator::class, 'on' => [self::SCENARIO_ADMIN_UPDATE, self::SCENARIO_ADMIN_CREATE]],
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->generateAuthKey();
        }

        return true;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Говорит о том, какие поля будут возвращены при запросе через API
     * @return array
     */
    /*public function fields()
    {
        return ['id',
            'name' => 'username',
            'mixed' => function (User $model) {
                return $model->username . ': ' . User::STATUSES[$model->status];
            }];
    }*/

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        //var_dump('set '.$password.'/');
        if ($password) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        }
        $this->password = $password;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getAvatar()
    {
        return $this->getThumbUploadUrl('avatar', User::AVATAR_ICO_BIG);
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\UserQuery(get_called_class());
    }
}
