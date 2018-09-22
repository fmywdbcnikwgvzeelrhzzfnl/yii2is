<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project`.
 */
class m180826_141805_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Название'),
            'description'=>$this->text()->notNull()->comment('Описание'),
            'created_by'=>$this->integer()->notNull(),
            'updated_by'=>$this->integer(),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer(),
        ]);

        $this->addForeignKey('project-user-1', 'project', 'created_by', 'user', 'id');
        $this->addForeignKey('project-user-2', 'project', 'updated_by', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('project-user-1','project');
        $this->dropForeignKey('project-user-2','project');

        $this->dropTable('project');
    }
}
