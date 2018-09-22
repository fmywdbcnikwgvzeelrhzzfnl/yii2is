<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "version".
 *
 * @property int $id
 * @property string $num Номер
 * @property string $name Название
 * @property string $description Описание
 * @property int $is_accepted
 * @property int $created_at
 * @property int $updated_at
 * @property int $accepted_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $accepted_by
 *
 * @property Demand[] $demands
 */
class Version extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'version';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'is_accepted', 'created_at', 'updated_at', 'accepted_at', 'created_by', 'updated_by', 'accepted_by'], 'integer'],
            [['num'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1000],
            [['id'], 'unique'],
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
            'name' => 'Name',
            'description' => 'Description',
            'is_accepted' => 'Is Accepted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'accepted_at' => 'Accepted At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'accepted_by' => 'Accepted By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDemands()
    {
        return $this->hasMany(Demand::className(), ['fk_version' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\VersionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VersionQuery(get_called_class());
    }
}
