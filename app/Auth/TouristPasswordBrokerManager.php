<?php

namespace App\Auth;

use App\Auth\PasswordBroker as PasswordBroker;
use Illuminate\Contracts\Auth\PasswordBrokerFactory as FactoryContract;
use InvalidArgumentException;

class TouristPasswordBrokerManager extends \Illuminate\Auth\Passwords\PasswordBrokerManager implements FactoryContract
{
    protected function resolve($name)
    {
        $config = $this->getConfig($name);
        if (is_null($config)) {
            throw new InvalidArgumentException("Password resetter [{$name}] is not defined.");
        }

        return new TouristPasswordBroker(
            $this->createTokenRepository($config),
            $this->app['auth']->createUserProvider($config['provider'])
        );
    }

}