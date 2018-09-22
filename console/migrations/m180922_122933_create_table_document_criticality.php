<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%document_criticality}}`.
 */
class m180922_122933_create_table_document_criticality extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%document_criticality}}', [

            'id' => $this->primaryKey(),
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
