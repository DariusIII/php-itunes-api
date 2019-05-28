<?php

namespace DariusIII\ItunesApi\Mappers;

use DariusIII\ItunesApi\Entities\Track;

class TrackMapper extends AbstractMapper
{
    /**
     * @return Track
     */
    protected function getObject()
    {
        $track = new Track();
        $track->setItunesId($this->data->trackId ?? '');
        $track->setArtistId($this->data->artistId);
        $track->setArtistName($this->data->artistName);
        $track->setAlbumId($this->data->collectionId);
        $track->setName($this->data->trackName ?? '');
        $track->setExplicit(! empty($this->data->trackExplicitness) ? $this->data->trackExplicitness === self::IDENTIFER_EXPLICIT : false);
        $track->setLength($this->data->trackTimeMillis ?? '');
        $track->setPreview($this->data->previewUrl ?? '');
        $track->setTrackNumber($this->data->trackNumber ?? '');
        $track->setGenre($this->data->primaryGenreName);
        if (isset($this->data->artworkUrl100)) {
            $track->setCover($this->data->artworkUrl100);
        }

        return $track;
    }
}
