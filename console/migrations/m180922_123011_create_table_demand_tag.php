<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%demand_tag}}`.
 */
class m180922_123011_create_table_demand_tag extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%demand_tag}}', [

            'id' => $this->integer(11)->notNull(),
            'fk_tag' => $this->integer(11)->notNull(),
            'fk_demand' => $this->integer(11)->notNull(),

        ]);
 
        // creates index for column `fk_demand`
        $this->createIndex(
            'demand_tag-demand',
            '{{%demand_tag}}',
            'fk_demand'
        );

        // add foreign key for table `demand`
        $this->addForeignKey(
            'demand_tag-demand',
            '{{%demand_tag}}',
            'fk_demand',
            '{{%demand}}',
            'uid',
            'CASCADE'
        );

        // creates index for column `fk_tag`
        $this->createIndex(
            'demand_tag-tag',
            '{{%demand_tag}}',
            'fk_tag'
        );

        // add foreign key for table `tag`
        $this->addForeignKey(
            'demand_tag-tag',
            '{{%demand_tag}}',
            'fk_tag',
            '{{%tag}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `demand`
        $this->dropForeignKey(
            'demand_tag-demand',
            '{{%demand_tag}}'
        );

        // drops index for column `fk_demand`
        $this->dropIndex(
            'demand_tag-demand',
            '{{%demand_tag}}'
        );

        // drops foreign key for table `tag`
        $this->dropForeignKey(
            'demand_tag-tag',
            '{{%demand_tag}}'
        );

        // drops index for column `fk_tag`
        $this->dropIndex(
            'demand_tag-tag',
            '{{%demand_tag}}'
        );

        $this->dropTable('{{%demand_tag}}');
    }
}
