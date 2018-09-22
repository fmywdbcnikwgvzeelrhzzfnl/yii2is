<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project_user`.
 */
class m180826_141821_create_project_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project_user', [
            'project_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'role' => "ENUM('manager', 'developer','tester')",
        ]);

        $this->addForeignKey('project_user-project', 'project_user', 'project_id', 'project', 'id', 'cascade');
        $this->addForeignKey('project_user-user', 'project_user', 'user_id', 'user', 'id', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('project_user-project', 'project_user');
        $this->dropForeignKey('project_user-user', 'project_user');

        $this->dropTable('project_user');
    }
}
