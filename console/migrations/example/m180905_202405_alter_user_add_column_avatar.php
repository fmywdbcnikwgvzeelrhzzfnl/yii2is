<?php

use yii\db\Migration;

/**
 * Class m180905_202405_alter_user_add_column_avatar
 */
class m180905_202405_alter_user_add_column_avatar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'avatar', $this->string()->after('status'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'avatar');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180905_202405_alter_user_add_column_avatar cannot be reverted.\n";

        return false;
    }
    */
}
