<?php

namespace App\Providers;

use App\Interfaces\OrderRepositoryInterface;

class RepositoryServiceProvider
{
    public array $bindings =[
        OrderRepositoryInterface::class => OrderRepository::class,
    ];

    public function register(): void
    {
        $this->bindRepositories();
    }

    private function bindRepositories(): void
    {
        foreach ($this->bindings as $interface => $repository)
        {
            $this->app->bind($interface, $repository);
        }
    }
}
