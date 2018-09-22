<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "document_criticality".
 *
 * @property int $id
 * @property string $name
 *
 * @property Document[] $documents
 */
class DocumentCriticality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document_criticality';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 20],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['fk_criticality' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\DocumentCriticalityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DocumentCriticalityQuery(get_called_class());
    }
}
