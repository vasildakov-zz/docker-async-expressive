<?php
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'driver'   => 'pdo_mysql',
                    'host'     => 'WhiskyMysql',
                    'port'     => '3306',
                    'dbname'   => 'whisky',
                    'user'     => 'root',
                    'password' => '1',
                    'charset'  => 'UTF8',
                ],
            ],
        ],
        'driver' => [
            'annotations' => [
                'class' => \Doctrine\ORM\Mapping\Driver\DoctrineAnnotations::class,
                'cache' => 'array',
                'paths' => [
                    'src/Domain/src/Entity'
                ],
            ],
            'orm_default' => [
                'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    'Domain\src\Entity' => __NAMESPACE__,
                ],
            ],
            __NAMESPACE__ => [
                'class' => \Doctrine\ORM\Mapping\Driver\XmlDriver::class,
                'cache' => 'array',
                'paths' => __DIR__ . '/../../src/Infrastructure/src/Doctrine/Mapping',
            ],
        ],
        'cache'      => [
            'redis' => [
                'host' => 'redis',
                'port' => 6379,
            ],
        ],
        'migrations' => [
            'migrations_table' => 'migrations',
            'migrations_namespace' => 'Tms',
            'migrations_directory' => 'src/Infrastructure/src/Doctrine/Migrations',
        ],
        'fixtures' => [
            'paths' => [
                'src/Infrastructure/src/Doctrine/Fixtures'
            ]
        ],
    ],
];
