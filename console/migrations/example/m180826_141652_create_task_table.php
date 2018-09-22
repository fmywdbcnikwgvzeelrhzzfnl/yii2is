<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m180826_141652_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Название'),
            'description'=>$this->text()->notNull()->comment('Описание'),
            'estimation'=>$this->integer()->notNull(),
            'executor_id'=>$this->integer(),
            'started_at'=>$this->integer(),
            'completed_at'=>$this->integer(),
            'created_by'=>$this->integer()->notNull(),
            'updated_by'=>$this->integer(),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer(),
        ]);

        $this->addForeignKey('task-user-1', 'task', 'executor_id', 'user', 'id');
        $this->addForeignKey('task-user-2', 'task', 'created_by', 'user', 'id');
        $this->addForeignKey('task-user-3', 'task', 'updated_by', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('task-user-1','task');
        $this->dropForeignKey('task-user-2','task');
        $this->dropForeignKey('task-user-3','task');

        $this->dropTable('task');
    }
}
