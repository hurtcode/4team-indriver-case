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
            'price' => $this->float()->notNull(),
            'gasConsumption' => $this->float()->notNull(),
            'category' => $this->string(3)->notNull(),
            'preferableFuel' => $this->integer()->null(),
            'startExploitationDate' => $this->date()->null(),
            'accidentsHistory' => $this->json()->null(),
            'startMileage' => $this->float()->null(),
            'averageFixPrice' => $this->float()->null(),
            'fixInterval' => $this->float()->null(),
            'history' => $this->json(),
            'repairHistory' => $this->json(),
            'driverId' => $this->integer(),
        ]);

        $this->addForeignKey('driverId', $this->table, 'driverId', 'driver', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
