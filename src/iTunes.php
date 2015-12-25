<?php
namespace Jacoz\ItunesApi;

use Jacoz\ItunesApi\Exceptions\InvalidProviderException;
use Jacoz\ItunesApi\Providers\AbstractProvider;
use Jacoz\ItunesApi\Providers\ProviderInterface;

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
