<?php

namespace app\core;

use PDO;

class Database
{
    public PDO $pdo; // property, for PDO class example
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new PDO($dsn, $user, $password); //initialization of $pdo property
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Setting an atribbute on the database handle
    }
    //-----------------------------------------------------------------------------------------
    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $newMigrations = [];

        $files = \scandir(Application::$ROOT_DIR . '/migrations');
        $toApplyMigrations = \array_diff($files, $appliedMigrations);


        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            require Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = \pathinfo($migration, \PATHINFO_FILENAME);
            $instance = new $className();
            echo "Applying migration $migration" . \PHP_EOL;
            $instance->up() . \PHP_EOL;
            echo "Applyed migration $migration" . \PHP_EOL;
            $newMigrations[] = $migration;
        }
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            echo 'All migrations are applied';
        }
    }
    //-----------------------------------------------------------------------------------------

    public function createMigrationsTable()
    {
        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS migrations (id INT AUTO_INCREMENT PRIMARY KEY, 
            migration VARCHAR(255), 
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) ENGINE=INNODB;"
        );
    }
    //---------------------------------------------------------------------------------

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {

        $str = \implode(",", \array_map(fn ($m) => "('$m')", $migrations));

        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str ");

        $statement->execute();
    }
}
