<?php
namespace Jacoz\ItunesApi\Mappers;

use Jacoz\ItunesApi\Entities\Track;

class TrackMapper extends AbstractMapper
{
    /**
     * @return Track
     */
    protected function getObject()
    {
        $track = new Track();
        $track->setItunesId($this->data->trackId);
        $track->setArtistId($this->data->artistId);
        $track->setAlbumId($this->data->collectionId);
        $track->setName($this->data->trackName);
        $track->setExplicit($this->data->trackExplicitness === self::IDENTIFER_EXPLICIT);
        $track->setLength($this->data->trackTimeMillis);

        if (isset($this->data->previewUrl)) {
            $track->setPreview($this->data->previewUrl);
        }

        $track->setTrackNumber($this->data->trackNumber);

        return $track;
    }
}
