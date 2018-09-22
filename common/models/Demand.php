<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "demand".
 *
 * @property int $id
 * @property int $uid
 * @property string $name Формулировка требования
 * @property string $comment Комментарий
 * @property int $ord Порядковый номер
 * @property int $level
 * @property int $fk_version
 * @property int $fk_language
 * @property int $fk_document
 * @property int $is_complex
 * @property int $fk_parent
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property Document $fkDocument
 * @property Language $fkLanguage
 * @property Demand $fkParent
 * @property Demand[] $demands
 * @property User $updatedBy
 * @property Version $fkVersion
 * @property DemandTag[] $demandTags
 */
class Demand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'demand';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'uid'], 'required'],
            [['id', 'uid', 'ord', 'level', 'fk_version', 'fk_language', 'fk_document', 'is_complex', 'fk_parent', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'comment'], 'string', 'max' => 1000],
            [['id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['fk_document'], 'exist', 'skipOnError' => true, 'targetClass' => Document::className(), 'targetAttribute' => ['fk_document' => 'id']],
            [['fk_language'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['fk_language' => 'id']],
            [['fk_parent'], 'exist', 'skipOnError' => true, 'targetClass' => Demand::className(), 'targetAttribute' => ['fk_parent' => 'uid']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['fk_version'], 'exist', 'skipOnError' => true, 'targetClass' => Version::className(), 'targetAttribute' => ['fk_version' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'name' => 'Name',
            'comment' => 'Comment',
            'ord' => 'Ord',
            'level' => 'Level',
            'fk_version' => 'Fk Version',
            'fk_language' => 'Fk Language',
            'fk_document' => 'Fk Document',
            'is_complex' => 'Is Complex',
            'fk_parent' => 'Fk Parent',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
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
    public function getFkDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'fk_document']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'fk_language']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkParent()
    {
        return $this->hasOne(Demand::className(), ['uid' => 'fk_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDemands()
    {
        return $this->hasMany(Demand::className(), ['fk_parent' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkVersion()
    {
        return $this->hasOne(Version::className(), ['id' => 'fk_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDemandTags()
    {
        return $this->hasMany(DemandTag::className(), ['fk_demand' => 'uid']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\DemandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DemandQuery(get_called_class());
    }
}
