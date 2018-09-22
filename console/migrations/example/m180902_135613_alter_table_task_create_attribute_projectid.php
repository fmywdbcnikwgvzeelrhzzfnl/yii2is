<?php

use yii\db\Migration;

/**
 * Class m180902_135613_alter_table_task_create_attribute_projectid
 */
class m180902_135613_alter_table_task_create_attribute_projectid extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'project_id', $this->integer()->notNull());

        $this->addForeignKey('task-project', 'task', 'project_id', 'project', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('task-project', 'task');

        $this->dropColumn('task', 'project_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180902_135613_alter_table_task_create_attribute_projectid cannot be reverted.\n";

        return false;
    }
    */
}
