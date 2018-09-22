<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property int $ord
 * @property int $fk_parent
 *
 * @property DemandTag[] $demandTags
 * @property Tag $fkParent
 * @property Tag[] $tags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'ord', 'fk_parent'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['color'], 'string', 'max' => 6],
            [['id'], 'unique'],
            [['fk_parent'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['fk_parent' => 'id']],
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
            'color' => 'Color',
            'ord' => 'Ord',
            'fk_parent' => 'Fk Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDemandTags()
    {
        return $this->hasMany(DemandTag::className(), ['fk_tag' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkParent()
    {
        return $this->hasOne(Tag::className(), ['id' => 'fk_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['fk_parent' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TagQuery(get_called_class());
    }
}
