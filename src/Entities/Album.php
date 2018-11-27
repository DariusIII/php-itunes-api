<?php

namespace DariusIII\ItunesApi\Entities;

use DariusIII\ItunesApi\Utils\Collection;

class Album implements EntityInterface, \JsonSerializable
{
    /**
     * @var integer
     */
    private $itunesId;

    /**
     * @var integer
     */
    private $artistId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cover;

    /**
     * @var bool
     */
    private $explicit;

    /**
     * @var integer
     */
    private $tracksCount;

    /**
     * @var \DateTime
     */
    private $releaseDate;

    /**
     * @var Collection[]
     */
    private $tracks;

    /**
     * @var string
     */
    private $storeUrl;

    /**
     * @var string
     */
    private $publisher;

    /**
     * @var string
     */
    private $genre;

    /**
     * @return int
     */
    public function getItunesId()
    {
        return $this->itunesId;
    }

    /**
     * @param int $itunesId
     */
    public function setItunesId($itunesId)
    {
        $this->itunesId = $itunesId;
    }

    /**
     * @return int
     */
    public function getArtistId()
    {
        return $this->artistId;
    }

    /**
     * @param int $artistId
     */
    public function setArtistId($artistId)
    {
        $this->artistId = $artistId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param string $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * @return boolean
     */
    public function isExplicit()
    {
        return $this->explicit;
    }

    /**
     * @param boolean $explicit
     */
    public function setExplicit($explicit)
    {
        $this->explicit = $explicit;
    }

    /**
     * @return int
     */
    public function getTracksCount()
    {
        return $this->tracksCount;
    }

    /**
     * @param int $tracksCount
     */
    public function setTracksCount($tracksCount)
    {
        $this->tracksCount = $tracksCount;
    }

    /**
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTime $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return \DariusIII\ItunesApi\Utils\Collection[]
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * @param Collection $tracks
     */
    public function setTracks(Collection $tracks)
    {
        $this->tracks = $tracks;
    }

    /**
     * @return string
     */
    public function getStoreUrl()
    {
        return $this->storeUrl;
    }

    /**
     * @param $storeUrl
     */
    public function setStoreUrl($storeUrl)
    {
        $this->storeUrl = $storeUrl;
    }

    /**
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param $publisher
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'itunes_id' => $this->getItunesId(),
            'artist_id' => $this->getArtistId(),
            'name' => $this->getName(),
            'cover' => $this->getCover(),
            'store_url' => $this->getStoreUrl(),
            'explicit' => $this->isExplicit(),
            'tracks_count' => $this->getTracksCount(),
            'release_date' => $this->getReleaseDate()->format('Y-m-d H:i:s'),
            'tracks' => $this->getTracks(),
            'publisher' => $this->getPublisher(),
            'genre' => $this->getGenre(),
        ];
    }
}
