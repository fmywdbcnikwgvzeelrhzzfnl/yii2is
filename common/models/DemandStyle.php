<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "demand_style".
 *
 * @property int $id
 * @property int $level
 * @property string $css_classes
 */
class DemandStyle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'demand_style';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'level'], 'required'],
            [['id', 'level'], 'integer'],
            [['css_classes'], 'string', 'max' => 100],
            [['level'], 'unique'],
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
            'level' => 'Level',
            'css_classes' => 'Css Classes',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\DemandStyleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DemandStyleQuery(get_called_class());
    }
}
