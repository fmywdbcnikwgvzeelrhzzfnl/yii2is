<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%migration}}`.
 */
class m180922_122853_create_table_migration extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%migration}}', [

            'version' => $this->string(180)->notNull(),
            'apply_time' => $this->integer(11),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%migration}}');
    }
}
