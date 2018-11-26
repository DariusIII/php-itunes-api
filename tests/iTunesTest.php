<?php
use DariusIII\ItunesApi\iTunes;

class iTunesTest extends PHPUnit_Framework_TestCase
{
    public function testValidProviderLoader()
    {
        iTunes::load('artist');
    }
}
