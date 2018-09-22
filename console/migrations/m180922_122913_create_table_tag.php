<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%tag}}`.
 */
class m180922_122913_create_table_tag extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%tag}}', [

            'id' => $this->integer(11)->notNull(),
            'name' => $this->string(20),
            'color' => $this->string(6),
            'ord' => $this->integer(11),
            'fk_parent' => $this->integer(11),

        ]);
 
        // creates index for column `fk_parent`
        $this->createIndex(
            'parent_tag',
            '{{%tag}}',
            'fk_parent'
        );

        // add foreign key for table `tag`
        $this->addForeignKey(
            'parent_tag',
            '{{%tag}}',
            'fk_parent',
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
        // drops foreign key for table `tag`
        $this->dropForeignKey(
            'parent_tag',
            '{{%tag}}'
        );

        // drops index for column `fk_parent`
        $this->dropIndex(
            'parent_tag',
            '{{%tag}}'
        );

        $this->dropTable('{{%tag}}');
    }
}
