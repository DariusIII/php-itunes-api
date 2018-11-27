<?php

namespace DariusIII\ItunesApi\Entities;

use DariusIII\ItunesApi\Utils\Collection;

class Artist implements EntityInterface, \JsonSerializable
{
    /**
     * @var integer
     */
    private $itunesId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection
     */
    private $albums;

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
     * @return Collection
     */
    public function getAlbums()
    {
        return $this->albums;
    }

    /**
     * @param Collection $albums
     */
    public function setAlbums(Collection $albums)
    {
        $this->albums = $albums;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'itunes_id' => $this->getItunesId(),
            'name' => $this->getName(),
            'albums' => $this->getAlbums(),
        ];
    }
}
