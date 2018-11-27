<?php

namespace DariusIII\ItunesApi\Mappers;

use DariusIII\ItunesApi\Entities\Movie;

class MovieMapper extends AbstractMapper
{
    /**
     * @return Movie
     * @throws \Exception
     */
    protected function getObject()
    {
        $movie = new Movie();
        // Some Movies are missing collectionId and collectionArtistId from JSON response
        if (isset($this->data->collectionId)) {
            $movie->setItunesId($this->data->collectionId);
        }
        if (isset($this->data->collectionArtistId)) {
            $movie->setArtistId($this->data->collectionArtistId);
        }
        $movie->setName($this->data->trackName);
        $movie->setDirector($this->data->artistName);

        if (isset($this->data->artworkUrl100)) {
            $movie->setCover($this->data->artworkUrl100);
        }
        if (isset($this->data->collectionViewUrl)) {
            $movie->setStoreUrl($this->data->collectionViewUrl);
        } elseif (isset($this->data->trackViewUrl)) {
            $movie->setStoreUrl($this->data->trackViewUrl);
        }
        if (isset($this->data->previewUrl)) {
            $movie->setTrailerUrl($this->data->previewUrl);
        }

        $movie->setExplicit($this->data->collectionExplicitness === self::IDENTIFER_EXPLICIT);
        $movie->setReleaseDate(new \DateTime($this->data->releaseDate));
        $movie->setDescription($this->data->longDescription);
        $movie->setTagLine($this->data->shortDescription);
        $movie->setGenre($this->data->primaryGenreName);

        return $movie;
    }
}
