<?php

namespace DariusIII\ItunesApi\Mappers;

use DariusIII\ItunesApi\Entities\Ebook;

class EbookMapper extends AbstractMapper
{
    /**
     * @return Ebook
     * @throws \Exception
     */
    protected function getObject()
    {
        $ebook = new Ebook();
        // Some Movies are missing collectionId and collectionArtistId from JSON response
        if (isset($this->data->trackId)) {
            $ebook->setItunesId($this->data->trackId);
        }
        if (isset($this->data->artistId)) {
            $ebook->setArtistId($this->data->artistId);
        }
        $ebook->setName($this->data->trackName);
        $ebook->setAuthor($this->data->artistName);

        if (isset($this->data->artworkUrl100)) {
            $ebook->setCover($this->data->artworkUrl100);
        }
        if (isset($this->data->trackViewUrl)) {
            $ebook->setStoreUrl($this->data->trackViewUrl);
        }

        $ebook->setReleaseDate(new \DateTime($this->data->releaseDate));
        $ebook->setDescription($this->data->description);
        $ebook->setGenre($this->data->genres);

        return $ebook;
    }
}
