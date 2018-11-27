<?php

namespace DariusIII\ItunesApi\Entities;

class Movie implements EntityInterface, \JsonSerializable
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
     * @var \DateTime
     */
    private $releaseDate;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $storeUrl;

    /**
     * @var string
     */
    private $trailerUrl;

    /**
     * @var string
     */
    private $genre;

    /**
     * @var string
     */
    private $director;

    /**
     * @var string
     */
    private $tagLine;

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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    public function getTrailerUrl()
    {
        return $this->trailerUrl;
    }

    /**
     * @param $trailerUrl
     */
    public function setTrailerUrl($trailerUrl)
    {
        $this->trailerUrl = $trailerUrl;
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
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param string $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * @return string
     */
    public function getTagLine()
    {
        return $this->tagLine;
    }

    /**
     * @param string $tagLine
     */
    public function setTagLine($tagLine)
    {
        $this->tagLine = $tagLine;
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
            'director' => $this->getDirector(),
            'cover' => $this->getCover(),
            'store_url' => $this->getStoreUrl(),
            'trailer' => $this->getTrailerUrl(),
            'explicit' => $this->isExplicit(),
            'release_date' => $this->getReleaseDate()->format('Y-m-d H:i:s'),
            'tag_line' => $this->getTagLine(),
            'description' => $this->getDescription(),
            'genre' => $this->getGenre(),
        ];
    }
}
