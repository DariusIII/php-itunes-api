<?php
use DariusIII\ItunesApi\Utils\Collection;
use DariusIII\ItunesApi\Entities\Artist;

abstract class AbstractCollectionTest extends PHPUnit_Framework_TestCase
{
    /** @var Collection */
    protected $data = [];

    protected function getData()
    {
        $items = [
            [1, 'Foo'],
            [2, 'Bar'],
            [3, 'Baz'],
        ];

        $data = [];
        foreach($items as $item) {
            $artist = new Artist();
            $artist->setItunesId($item[0]);
            $artist->setName($item[1]);

            $data[] = $artist;
        }

        return $data;
    }
}
