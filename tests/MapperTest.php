<?php

use DariusIII\ItunesApi\Entities\Track;
use DariusIII\ItunesApi\Entities\Album;
use DariusIII\ItunesApi\Entities\Artist;
use DariusIII\ItunesApi\Entities\EntityInterface;
use DariusIII\ItunesApi\Mappers\ArtistMapper;
use DariusIII\ItunesApi\Mappers\AlbumMapper;
use DariusIII\ItunesApi\Mappers\TrackMapper;

class MapperTest extends \PHPUnit\Framework\TestCase
{
    const artistName = 'Remember Sports';

    private $data = [
        'artist' => [
            'artistId' => 1,
            'artistName' => 'Foo'
        ],
        'album' => [
            'collectionId' => 1,
            'artistId' => 2,
            'artistName' => self::artistName,
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
        $this->assertInstanceOf(EntityInterface::class, $obj);
    }

    /**
     * Check whether the artist name is loaded into the album.
     */
    public function testAlbumWithArtistName ()
    {
        $mapper = AlbumMapper::map($this->getDataObject('album'));

        $this->assertEquals(self::artistName, $mapper->getArtistName());
    }

    public function getMappers()
    {
        return [
            [ArtistMapper::map($this->getDataObject('artist')), Artist::class],
            [AlbumMapper::map($this->getDataObject('album')), Album::class],
            [TrackMapper::map($this->getDataObject('track')), Track::class],
        ];
    }

    private function getDataObject($item)
    {
        return (object)(object)$this->data[$item];
    }
}
