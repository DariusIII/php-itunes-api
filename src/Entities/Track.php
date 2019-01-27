<?php

namespace DariusIII\ItunesApi\Entities;

class Track implements EntityInterface, \JsonSerializable
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
    private $artistName;

    /**
     * @var integer
     */
    private $albumId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $preview;

    /**
     * @var bool
     */
    private $explicit;

    /**
     * @var integer
     */
    private $trackNumber;

    /**
     * @var integer
     */
    private $length;

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
     * @return string
     */
    public function getArtistName()
    {
        return $this->artistName;
    }

    /**
     * @param int $artistId
     */
    public function setArtistId($artistId)
    {
        $this->artistId = $artistId;
    }

    /**
     * @param string $artistName
     */
    public function setArtistName( $artistName)
    {
        $this->artistName = $artistName;
    }

    /**
     * @return int
     */
    public function getAlbumId()
    {
        return $this->albumId;
    }

    /**
     * @param int $albumId
     */
    public function setAlbumId($albumId)
    {
        $this->albumId = $albumId;
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
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * @param string $preview
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;
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
    public function getTrackNumber()
    {
        return $this->trackNumber;
    }

    /**
     * @param int $trackNumber
     */
    public function setTrackNumber($trackNumber)
    {
        $this->trackNumber = $trackNumber;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength($length)
    {
        $this->length = $length;
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
            'artist_name' => $this->getArtistName(),
            'album_id' => $this->getAlbumId(),
            'name' => $this->getName(),
            'explicit' => $this->isExplicit(),
            'track_number' => $this->getTrackNumber(),
            'preview' => $this->getPreview(),
            'length' => $this->getLength(),
            'genre' => $this->getGenre(),
        ];
    }
}
