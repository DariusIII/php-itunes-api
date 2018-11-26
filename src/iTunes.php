<?php
namespace DariusIII\ItunesApi;

use DariusIII\ItunesApi\Exceptions\InvalidProviderException;
use DariusIII\ItunesApi\Providers\AbstractProvider;
use DariusIII\ItunesApi\Providers\ProviderInterface;

class iTunes
{
    /**
     * @param string $provider
     * @return ProviderInterface
     * @throws InvalidProviderException
     */
    public static function load($provider)
    {
        return AbstractProvider::factory($provider);
    }
}
