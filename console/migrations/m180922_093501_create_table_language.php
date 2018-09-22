<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%language}}`.
 */
class m180922_093501_create_table_language extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%language}}', [

            'id' => $this->integer(11)->notNull(),
            'name' => $this->string(45)->notNull(),
            'short_name' => $this->string(3)->notNull(),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%language}}');
    }
}
