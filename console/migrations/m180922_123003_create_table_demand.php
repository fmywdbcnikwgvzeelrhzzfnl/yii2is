<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%demand}}`.
 */
class m180922_123003_create_table_demand extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%demand}}', [

            'id' => $this->primaryKey(),
            'uid' => $this->integer(11)->notNull(),
            'name' => $this->string(1000)->comment("Формулировка требования"),
            'comment' => $this->string(1000)->comment("Комментарий"),
            'ord' => $this->integer(11)->comment("Порядковый номер"),
            'level' => $this->integer(11),
            'fk_version' => $this->integer(11),
            'fk_language' => $this->integer(11),
            'fk_document' => $this->integer(11),
            'is_complex' => $this->tinyInteger(1),
            'fk_parent' => $this->integer(11),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),

        ]);
 
        // creates index for column `created_by`
        $this->createIndex(
            'demand_created_by',
            '{{%demand}}',
            'created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'demand_created_by',
            '{{%demand}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `fk_document`
        $this->createIndex(
            'demand_document',
            '{{%demand}}',
            'fk_document'
        );

        // add foreign key for table `document`
        $this->addForeignKey(
            'demand_document',
            '{{%demand}}',
            'fk_document',
            '{{%document}}',
            'id',
            'CASCADE'
        );

        // creates index for column `fk_language`
        $this->createIndex(
            'demand_language',
            '{{%demand}}',
            'fk_language'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            'demand_language',
            '{{%demand}}',
            'fk_language',
            '{{%language}}',
            'id'
        );

        // creates index for column `fk_parent`
        $this->createIndex(
            'demand_parent',
            '{{%demand}}',
            'fk_parent'
        );

        $this->createIndex(
            'uid',
            '{{%demand}}',
            'uid'
        );

        // add foreign key for table `demand`
        $this->addForeignKey(
            'demand_parent',
            '{{%demand}}',
            'fk_parent',
            '{{%demand}}',
            'uid'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'demand_updated_by',
            '{{%demand}}',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'demand_updated_by',
            '{{%demand}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `fk_version`
        $this->createIndex(
            'demand_version',
            '{{%demand}}',
            'fk_version'
        );

        // add foreign key for table `version`
        $this->addForeignKey(
            'demand_version',
            '{{%demand}}',
            'fk_version',
            '{{%version}}',
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
            'demand_created_by',
            '{{%demand}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            'demand_created_by',
            '{{%demand}}'
        );

        // drops foreign key for table `document`
        $this->dropForeignKey(
            'demand_document',
            '{{%demand}}'
        );

        // drops index for column `fk_document`
        $this->dropIndex(
            'demand_document',
            '{{%demand}}'
        );

        // drops foreign key for table `language`
        $this->dropForeignKey(
            'demand_language',
            '{{%demand}}'
        );

        // drops index for column `fk_language`
        $this->dropIndex(
            'demand_language',
            '{{%demand}}'
        );

        // drops foreign key for table `demand`
        $this->dropForeignKey(
            'demand_parent',
            '{{%demand}}'
        );

        // drops index for column `fk_parent`
        $this->dropIndex(
            'demand_parent',
            '{{%demand}}'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'demand_updated_by',
            '{{%demand}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            'demand_updated_by',
            '{{%demand}}'
        );

        // drops foreign key for table `version`
        $this->dropForeignKey(
            'demand_version',
            '{{%demand}}'
        );

        // drops index for column `fk_version`
        $this->dropIndex(
            'demand_version',
            '{{%demand}}'
        );

        $this->dropTable('{{%demand}}');
    }
}
