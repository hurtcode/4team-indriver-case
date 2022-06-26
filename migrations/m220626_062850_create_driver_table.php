<?php

use yii\db\Migration;

class m220626_062850_create_driver_table extends Migration
{
	private string $table = 'driver';

	public function safeUp()
	{
		$this->createTable($this->table, [
			'id' => $this->primaryKey(),
			'phone' => $this->string(11),
			'password' => $this->string(50),
			'paymentGoal' => $this->string(),
			'minimalAdditionalPayment' => $this->string()
		]);
	}

	public function safeDown()
	{
		$this->dropTable($this->table);
	}
}
