<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%version}}`.
 */
class m180922_093501_create_table_version extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%version}}', [

            'id' => $this->integer(11)->notNull(),
            'num' => $this->string(10)->comment("Номер"),
            'name' => $this->string(100)->comment("Название"),
            'description' => $this->string(1000)->comment("Описание"),
            'is_accepted' => $this->tinyInteger(1),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'accepted_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
            'accepted_by' => $this->integer(11),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%version}}');
    }
}
