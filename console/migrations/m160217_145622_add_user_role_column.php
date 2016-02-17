<?php

use yii\db\Migration;

class m160217_145622_add_user_role_column extends Migration
{
    protected $tableName = '{{%user}}';

    public function up()
    {
        $this->addColumn($this->tableName, 'role', $this->string(64)->notNull().' AFTER `username`');
    }

    public function down()
    {
        $this->dropColumn($this->tableName, 'role');
    }
}
