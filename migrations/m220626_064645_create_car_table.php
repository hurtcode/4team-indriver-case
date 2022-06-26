<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car}}`.
 */
class m220626_064645_create_car_table extends Migration
{
	private string $table = 'car';

	public function safeUp()
	{
		$this->createTable($this->table, [
			'id' => $this->primaryKey(),
			'driverId' => $this->integer(),
			'gasConsumption' => $this->float()->notNull(),
			'category' => $this->string(3)->notNull(),
			'preferableFuel' => $this->integer(),
			'history' => $this->json(),
			'repairHistory' => $this->json()
		]);

		$this->addForeignKey('driverId', $this->table, 'driverId', 'driver', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
		$this->dropTable($this->table);
	}
}
