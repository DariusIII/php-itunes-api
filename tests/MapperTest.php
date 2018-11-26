<?php
use DariusIII\ItunesApi\Mappers\ArtistMapper;
use DariusIII\ItunesApi\Mappers\AlbumMapper;
use DariusIII\ItunesApi\Mappers\TrackMapper;

class MapperTest extends PHPUnit_Framework_TestCase
{
    private $data = [
        'artist' => [
            'artistId' => 1,
            'artistName' => 'Foo'
        ],
        'album' => [
            'collectionId' => 1,
            'artistId' => 2,
            'collectionName' => 'Bar',
            'artworkUrl100' => 'http://www.example.com/image.jpg',
            'collectionExplicitness' => 'explicit',
            'releaseDate' => '2015-01-01 10:00:01',
            'trackCount' => 10,
        ],
        'track' => [
            'trackId' => 1,
            'artistId' => 2,
            'collectionId' => 3,
            'trackName' => 'Baz',
            'trackExplicitness' => 'explicit',
            'trackTimeMillis' => 123456,
            'previewUrl' => 'http://www.example.com/audio.m4a',
            'trackNumber' => 1,
        ],
    ];

    /**
     * @dataProvider getMappers
     */
    public function testMapper($obj, $class)
    {
        $this->assertInstanceOf($class, $obj);
        $this->assertInstanceOf('DariusIII\\ItunesApi\\Entities\\EntityInterface', $obj);
    }

    public function getMappers()
    {
        return [
            [ArtistMapper::map($this->getDataObject('artist')), 'Jacoz\ItunesApi\Entities\Artist'],
            [AlbumMapper::map($this->getDataObject('album')), 'Jacoz\ItunesApi\Entities\Album'],
            [TrackMapper::map($this->getDataObject('track')), 'Jacoz\ItunesApi\Entities\Track'],
        ];
    }

    private function getDataObject($item)
    {
        return (object)(object)$this->data[$item];
    }
}
