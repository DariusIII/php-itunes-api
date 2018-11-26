<?php
namespace DariusIII\ItunesApi\Mappers;

use DariusIII\ItunesApi\Entities\Artist;

class ArtistMapper extends AbstractMapper
{
    /**
     * @return Artist
     */
    protected function getObject()
    {
        $album = new Artist();
        $album->setItunesId($this->data->artistId);
        $album->setName($this->data->artistName);

        return $album;
    }
}
