<?php

namespace app\Controllers;

use Dotenv\Dotenv;
use PDO;

class DbController extends PDO
{
    public function __construct()
    {
        $this->loadEnv();
        $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'] . ';port=' . $_ENV['DB_PORT'];
        parent::__construct($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    }

    /**
     * @return void
     */
    private function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
    }
}