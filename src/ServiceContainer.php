<?php

namespace Framework;

class ServiceContainer
{
    /** @var object[] */
    private array $instances;

    public function set(string $id, object $object): void
    {

        $this->instances[$id] = $object;
    }

    public function get(string $id): object
    {

        return $this->instances[$id];
    }
}
