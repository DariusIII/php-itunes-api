<?php

use DariusIII\ItunesApi\Providers\TrackProvider;
use DariusIII\ItunesApi\Providers\AlbumProvider;
use DariusIII\ItunesApi\Providers\ArtistProvider;
use DariusIII\ItunesApi\Providers\ProviderInterface;
use DariusIII\ItunesApi\Providers\AbstractProvider;
use DariusIII\ItunesApi\Providers\MovieProvider;
use DariusIII\ItunesApi\Providers\EbookProvider;

class AbstractProviderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException DariusIII\ItunesApi\Exceptions\InvalidProviderException
     */
    public function testInvalidProviderLoader()
    {
        AbstractProvider::factory('foo');
    }

    /**
     * @dataProvider getValidProviders
     */
    public function testValidProviderLoader($provider, $class)
    {
        $obj = AbstractProvider::factory($provider);

        $this->assertInstanceOf($class, $obj);
        $this->assertInstanceOf(ProviderInterface::class, $obj);
    }

    public function getValidProviders()
    {
        return [
            ['artist', ArtistProvider::class],
            ['album', AlbumProvider::class],
            ['track', TrackProvider::class],
            ['movie', MovieProvider::class],
            ['ebook', EbookProvider::class],
        ];
    }
}
