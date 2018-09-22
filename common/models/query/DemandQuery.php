<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Demand]].
 *
 * @see \common\models\Demand
 */
class DemandQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Demand[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Demand|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
