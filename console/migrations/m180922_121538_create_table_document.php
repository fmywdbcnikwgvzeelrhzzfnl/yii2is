<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%document}}`.
 */
class m180922_121538_create_table_document extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%document}}', [

            'id' => $this->integer(11)->notNull(),
            'num' => $this->string(20),
            'date' => $this->datetime(),
            'name' => $this->string(1000),
            'fk_criticality' => $this->integer(11),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),

        ]);
 
        // creates index for column `created_by`
        $this->createIndex(
            'document_created_by',
            '{{%document}}',
            'created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'document_created_by',
            '{{%document}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `fk_criticality`
        $this->createIndex(
            'document_criticality',
            '{{%document}}',
            'fk_criticality'
        );

        // add foreign key for table `document_criticality`
        $this->addForeignKey(
            'document_criticality',
            '{{%document}}',
            'fk_criticality',
            '{{%document_criticality}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'document_updated_by',
            '{{%document}}',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'document_updated_by',
            '{{%document}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'document_created_by',
            '{{%document}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            'document_created_by',
            '{{%document}}'
        );

        // drops foreign key for table `document_criticality`
        $this->dropForeignKey(
            'document_criticality',
            '{{%document}}'
        );

        // drops index for column `fk_criticality`
        $this->dropIndex(
            'document_criticality',
            '{{%document}}'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'document_updated_by',
            '{{%document}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            'document_updated_by',
            '{{%document}}'
        );

        $this->dropTable('{{%document}}');
    }
}
