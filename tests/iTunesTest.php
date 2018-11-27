<?php
use DariusIII\ItunesApi\iTunes;

class iTunesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \DariusIII\ItunesApi\Exceptions\InvalidProviderException
     */
    public function testValidProviderLoader()
    {
        $this->assertInstanceOf(\DariusIII\ItunesApi\Providers\ArtistProvider::class, iTunes::load('artist'));
    }
}
