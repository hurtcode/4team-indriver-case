<?php

declare(strict_types=1);

namespace OutDriver\Yii\Db;

use Cycle\Annotated\Embeddings;
use Cycle\Annotated\Entities;
use Cycle\Annotated\MergeColumns;
use Cycle\Annotated\MergeIndexes;
use Cycle\Annotated\TableInheritance;
use Cycle\Database\DatabaseManager;
use Cycle\ORM\Schema;
use Cycle\Schema\Compiler;
use Cycle\Schema\Generator\GenerateModifiers;
use Cycle\Schema\Generator\GenerateRelations;
use Cycle\Schema\Generator\GenerateTypecast;
use Cycle\Schema\Generator\RenderModifiers;
use Cycle\Schema\Generator\RenderRelations;
use Cycle\Schema\Generator\RenderTables;
use Cycle\Schema\Generator\ResetTables;
use Cycle\Schema\Generator\ValidateEntities;
use Cycle\Schema\Registry;
use Spiral\Tokenizer\ClassLocator;
use Symfony\Component\Finder\Finder;

final class SchemaGenerator
{
    public function __construct(
        private DatabaseManager $dbal,
        private string $src
    ) {
    }

    public function __invoke(): Schema
    {
        $classLocator = $this->classLocator();
        return new Schema(
            (new Compiler())->compile(new Registry($this->dbal), [
                new ResetTables(),             // re-declared table schemas (remove columns)
                new Embeddings($classLocator),        // register embeddable entities
                new Entities($classLocator),          // register annotated entities
                new TableInheritance(),               // register STI/JTI
                new MergeColumns(),                   // add @Table column declarations
                new GenerateRelations(),       // generate entity relations
                new GenerateModifiers(),       // generate changes from schema modifiers
                new ValidateEntities(),        // make sure all entity schemas are correct
                new RenderTables(),            // declare table schemas
                new RenderRelations(),         // declare relation keys and indexes
                new RenderModifiers(),         // render all schema modifiers
                new MergeIndexes(),                   // add @Table column declarations
                new GenerateTypecast(),        // typecast non string columns
            ])
        );
    }

    private function classLocator(): ClassLocator
    {
        $finder = new Finder();
        $finder->files()
            ->in($this->src)
            ->contains([
                '#[Entity',
                '#[Embeddable'
            ]);
        return new ClassLocator($finder);
    }
}