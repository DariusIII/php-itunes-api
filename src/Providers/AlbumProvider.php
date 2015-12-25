<?php
namespace Jacoz\ItunesApi\Providers;

use Jacoz\ItunesApi\Entities\Album;
use Jacoz\ItunesApi\Exceptions\AlbumNotFoundException;
use Jacoz\ItunesApi\Exceptions\SearchNoResultsException;
use Jacoz\ItunesApi\Mappers\AlbumMapper;
use Jacoz\ItunesApi\Mappers\TrackMapper;
use Jacoz\ItunesApi\Utils\Collection;
use Jacoz\ItunesApi\Utils\SearchResults;

class AlbumProvider extends AbstractProvider
{
    const ALBUM_QUERY = 'entity=album&id=%d&country=%s';

    const ALBUM_TRACKS_QUERY = 'entity=song&id=%d&country=%s';

    const ALBUM_SEARCH_QUERY = 'entity=album&media=music&term=%s&country=%s';

    /**
     * @param integer $id
     * @param string $country
     * @param bool $includeTracks
     * @return Album|null
     * @throws AlbumNotFoundException
     */
    public function fetchById($id, $country = self::DEFAULT_COUNTRY, $includeTracks = null)
    {
        $results = $this->lookup(sprintf($includeTracks ? self::ALBUM_TRACKS_QUERY : self::ALBUM_QUERY, (int)$id, $country));
        if ($results === false) {
            throw new AlbumNotFoundException($id);
        }

        $album = null;
        $tracks = [];

        foreach($results as $result) {
            switch($result->wrapperType) {
                case self::IDENTIFIER_ALBUM:
                    /** @var Album $album */
                    $album = AlbumMapper::map($result);
                    break;

                case self::IDENTIFIER_TRACK:
                    $tracks[] = TrackMapper::map($result);
                    break;
            }
        }

        if ($album) {
            if (!empty($tracks)) {
                $album->setTracks(new Collection($tracks));
            }
        }

        return $album;
    }

    /**
     * @param string $name
     * @param string $country
     * @return Album[]
     * @throws SearchNoResultsException
     */
    public function fetchByName($name, $country = self::DEFAULT_COUNTRY)
    {
        $results = $this->search(sprintf(self::ALBUM_SEARCH_QUERY, urlencode($name), $country));
        if ($results === false) {
            throw new SearchNoResultsException($name);
        }

        $albums = [];
        foreach($results as $result) {
            $albums[] = AlbumMapper::map($result);
        }

        return new SearchResults($albums);
    }

    /**
     * @param string $name
     * @param string $country
     * @param bool $includeTracks
     * @return Album|null
     * @throws AlbumNotFoundException
     * @throws SearchNoResultsException
     */
    public function fetchOneByName($name, $country = self::DEFAULT_COUNTRY, $includeTracks = null)
    {
        /** @var Album[] $albums */
        $albums = $this->fetchByName($name, $country);
        $album = $albums[0];

        return $includeTracks ? $this->fetchById($album->getItunesId(), $country, $includeTracks) : $album;
    }
}
