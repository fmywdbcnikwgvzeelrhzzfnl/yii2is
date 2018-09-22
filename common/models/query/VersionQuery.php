<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Version]].
 *
 * @see \common\models\Version
 */
class VersionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Version[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Version|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
