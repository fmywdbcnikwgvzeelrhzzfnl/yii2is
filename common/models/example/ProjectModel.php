<?php

namespace common\models;

use common\models\query\ProjectQuery;
use common\models\query\ProjectUserQuery;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsTrait;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\models\ProjectUserModel;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property boolean $active
 * @property string $title Название
 * @property string $description Описание
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property ProjectUserModel[] $projectUsers
 * @mixin SaveRelationsTrait
 */
class ProjectModel extends \yii\db\ActiveRecord
{
    use SaveRelationsTrait;

    const RELATION_PROJECT_USERS = 'projectUsers';

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUSES = [
        self::STATUS_DELETED => 'не активный',
        self::STATUS_ACTIVE => 'активный',
    ];


    /*    public function transactions()
        {
            return [
                self::SCENARIO_DEFAULT => self::OP_ALL,
            ];
        }*/
    //public $projectUsers;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'active'], 'required'],
            [['description'], 'string'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'active'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['active'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'active' => 'Is active',
        ];
    }

    /**
     * Устанавливает значения created_at, updated_at и created_by, updated_by информацией о времени и пользователе создавшем/изменившим строку
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
            'saveRelations' => [
                'class' => SaveRelationsBehavior::className(),
                'relations' => [self::RELATION_PROJECT_USERS],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return ProjectUserQuery|ActiveRecord
     */
    public function getProjectUsers()
    {
        //var_dump('relation');
        return $this->hasMany(ProjectUserModel::className(), ['project_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }

    /**
     * Выводит список пльзователей и применяется для редактирования связи юзеров и проектов
     * @return array
     */
    public function getUsers()
    {
        return User::find()->select('username')->indexBy('id')->column();
    }

    /**
     * Список пользователей и ролей в проекте
     * @return array
     */
    public function getUsersData()
    {
        return $this->getProjectUsers()->select('role')->indexBy('user_id')->column();
    }

}
