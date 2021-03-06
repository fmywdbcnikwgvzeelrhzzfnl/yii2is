<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%demand_style}}`.
 */
class m180922_122947_create_table_demand_style extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%demand_style}}', [

            'id' => $this->primaryKey(),
            'level' => $this->integer(11)->notNull(),
            'css_classes' => $this->string(100),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%demand_style}}');
    }
}
