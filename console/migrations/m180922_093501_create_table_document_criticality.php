<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%document_criticality}}`.
 */
class m180922_093501_create_table_document_criticality extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%document_criticality}}', [

            'id' => $this->integer(11)->notNull(),
            'name' => $this->string(20)->notNull(),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%document_criticality}}');
    }
}
