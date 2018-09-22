<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "demand_tag".
 *
 * @property int $id
 * @property int $fk_tag
 * @property int $fk_demand
 *
 * @property Demand $fkDemand
 * @property Tag $fkTag
 */
class DemandTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'demand_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fk_tag', 'fk_demand'], 'required'],
            [['id', 'fk_tag', 'fk_demand'], 'integer'],
            [['id'], 'unique'],
            [['fk_demand'], 'exist', 'skipOnError' => true, 'targetClass' => Demand::className(), 'targetAttribute' => ['fk_demand' => 'uid']],
            [['fk_tag'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['fk_tag' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_tag' => 'Fk Tag',
            'fk_demand' => 'Fk Demand',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkDemand()
    {
        return $this->hasOne(Demand::className(), ['uid' => 'fk_demand']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'fk_tag']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\DemandTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DemandTagQuery(get_called_class());
    }
}
