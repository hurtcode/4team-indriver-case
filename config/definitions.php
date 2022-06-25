<?php

use Cycle\ORM\ORM;
use OutDriver\Yii\Db\OrmFactory;
use OutDriver\Yii\Db\SchemaGenerator;

return [
    'definitions' => [
        ORM::class => function (\yii\di\Container $c) {
            return (new OrmFactory(
                $dbal = Yii::$app->params['db']['dbal'],
                (new SchemaGenerator($dbal, Yii::getAlias('@app/src')))()
            ))();
        }
    ],
    'singletons' => []
];