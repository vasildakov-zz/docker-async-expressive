<?php

declare(strict_types=1);

namespace Domain;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [],
            'factories'  => [],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                //'app'    => [__DIR__ . '/../templates/app'],
                //'error'  => [__DIR__ . '/../templates/error'],
                //'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
