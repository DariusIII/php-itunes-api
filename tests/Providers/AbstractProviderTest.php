<?php
use DariusIII\ItunesApi\Providers\AbstractProvider;

class AbstractProviderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Jacoz\ItunesApi\Exceptions\InvalidProviderException
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
        $this->assertInstanceOf('Jacoz\\ItunesApi\\Providers\\ProviderInterface', $obj);
    }

    public function getValidProviders()
    {
        return [
            ['artist', 'Jacoz\\ItunesApi\\Providers\\ArtistProvider'],
            ['album', 'Jacoz\\ItunesApi\\Providers\\AlbumProvider'],
            ['track', 'Jacoz\\ItunesApi\\Providers\\TrackProvider'],
        ];
    }
}
