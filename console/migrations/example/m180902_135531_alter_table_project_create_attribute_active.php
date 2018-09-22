<?php

use yii\db\Migration;

/**
 * Class m180902_135531_alter_table_project_create_attribute_active
 */
class m180902_135531_alter_table_project_create_attribute_active extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('project', 'active', $this->boolean()->defaultValue(false)->after('description'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('project', 'active');
    }


    /* public function up()
      {
          $this->alterColumn();
      }

      public function down()
      {
          echo "m180902_135531_alter_table_project_create_attribute_active cannot be reverted.\n";

          return false;
      }*/
}
