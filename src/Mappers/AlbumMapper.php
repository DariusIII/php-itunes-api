<?php

namespace DariusIII\ItunesApi\Mappers;

use DariusIII\ItunesApi\Entities\Album;

class AlbumMapper extends AbstractMapper
{
    /**
     * @return Album
     * @throws \Exception
     */
    protected function getObject()
    {
        $album = new Album();
        $album->setItunesId($this->data->collectionId);
        $album->setArtistId($this->data->artistId);
        $album->setArtistName($this->data->artistName);
        $album->setName($this->data->collectionName);
        if (isset($this->data->copyright)) {
            $album->setPublisher($this->data->copyright);
        }

        if (isset($this->data->artworkUrl100)) {
            $album->setCover($this->data->artworkUrl100);
        }
        $album->setStoreUrl($this->data->collectionViewUrl);

        $album->setExplicit($this->data->collectionExplicitness === self::IDENTIFER_EXPLICIT);
        $album->setReleaseDate(new \DateTime($this->data->releaseDate));
        $album->setTracksCount($this->data->trackCount);
        $album->setGenre($this->data->primaryGenreName);

        return $album;
    }
}
