<?php

namespace Framework;

interface ServiceProviderInterface
{
    public function register(ServiceContainer $serviceContainer): void;
}
