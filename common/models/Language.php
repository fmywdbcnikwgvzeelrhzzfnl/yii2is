<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property int $id
 * @property string $name
 * @property string $short_name
 *
 * @property Demand[] $demands
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'short_name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['short_name'], 'string', 'max' => 3],
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
            'name' => 'Name',
            'short_name' => 'Short Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDemands()
    {
        return $this->hasMany(Demand::className(), ['fk_language' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\LanguageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\LanguageQuery(get_called_class());
    }
}
