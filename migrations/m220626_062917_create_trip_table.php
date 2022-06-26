<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trip}}`.
 */
class m220626_062917_create_trip_table extends Migration
{
	public string $table = 'trip';

	public function safeUp()
	{
		$this->createTable($this->table, [
			'id' => $this->primaryKey(),
			'driverId' => $this->integer(),
			'cost' => $this->float(),
			'distance' => $this->float(),
			'spentTime' => $this->time(),
			'date' => $this->date()
		]);

		$this->addForeignKey('trip_driver_foreign_key', $this->table, 'driverId', 'driver', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
		$this->dropTable($this->table);
	}
}
