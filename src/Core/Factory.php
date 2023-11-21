<?php

namespace App\Core;

use App\Api\ApiRepository;
use App\Api\ApiController;
use PDO;

class Factory
{

    private array $receipts;
    private array $instances;

    public function __construct()
    {

        require 'db-config.php';

        $this->receipts = [
            'ApiController' => function () {
                return new ApiController($this->make('ApiRepository'));
            },
            'ApiRepository' => function () {
                return new ApiRepository($this->make("pdo"));
            },
            'pdo' => function () {

                /** @var string $dbHost */
                /** @var string $dbUsername */
                /** @var string $dbPassword */
                /** @var string $dbName */
                require 'db-config.php';

                $pdo = new PDO(
                    "mysql:host={$dbHost};dbname={$dbName};charset=utf8",
                    $dbUsername,
                    $dbPassword
                );

                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                return $pdo;
            }
        ];
    }

    public function make(string $name)
    {

        if (isset($this->receipts[$name])) {
            $this->instances[$name] = $this->receipts[$name]();
        }

        return $this->instances[$name];

    }

}