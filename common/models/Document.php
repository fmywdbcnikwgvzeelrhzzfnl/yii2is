<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property int $id
 * @property string $num
 * @property string $date
 * @property string $name
 * @property int $fk_criticality
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Demand[] $demands
 * @property User $createdBy
 * @property DocumentCriticality $fkCriticality
 * @property User $updatedBy
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'fk_criticality', 'created_by', 'updated_by'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['num'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 1000],
            [['id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['fk_criticality'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentCriticality::className(), 'targetAttribute' => ['fk_criticality' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num' => 'Num',
            'date' => 'Date',
            'name' => 'Name',
            'fk_criticality' => 'Fk Criticality',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDemands()
    {
        return $this->hasMany(Demand::className(), ['fk_document' => 'id']);
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
    public function getFkCriticality()
    {
        return $this->hasOne(DocumentCriticality::className(), ['id' => 'fk_criticality']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\DocumentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DocumentQuery(get_called_class());
    }
}
