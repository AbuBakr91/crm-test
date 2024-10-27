<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%translator}}`.
 */
class m241027_144047_create_translator_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%translator}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'working_days' => $this->string()->notNull(),
            'task_count' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%translator}}');
    }
}
