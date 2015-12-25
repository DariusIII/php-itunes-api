<?php
namespace Jacoz\ItunesApi\Mappers;

use Jacoz\ItunesApi\Entities\Album;

class AlbumMapper extends AbstractMapper
{
    /**
     * @return Album
     */
    protected function getObject()
    {
        $album = new Album();
        $album->setItunesId($this->data->collectionId);
        $album->setArtistId($this->data->artistId);
        $album->setName($this->data->collectionName);

        if (isset($this->data->artworkUrl100)) {
            $album->setCover($this->data->artworkUrl100);
        }

        $album->setExplicit($this->data->collectionExplicitness === self::IDENTIFER_EXPLICIT);
        $album->setReleaseDate(new \DateTime($this->data->releaseDate));
        $album->setTracksCount($this->data->trackCount);

        return $album;
    }
}
