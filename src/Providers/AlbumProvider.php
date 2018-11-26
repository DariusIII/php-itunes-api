<?php
namespace DariusIII\ItunesApi\Providers;

use DariusIII\ItunesApi\Entities\Album;
use DariusIII\ItunesApi\Exceptions\AlbumNotFoundException;
use DariusIII\ItunesApi\Exceptions\SearchNoResultsException;
use DariusIII\ItunesApi\Mappers\AlbumMapper;
use DariusIII\ItunesApi\Mappers\TrackMapper;
use DariusIII\ItunesApi\Utils\Collection;
use DariusIII\ItunesApi\Utils\SearchResults;

class AlbumProvider extends AbstractProvider
{
    protected const ALBUM_QUERY = 'entity=album&id=%d&country=%s';

    protected const ALBUM_TRACKS_QUERY = 'entity=song&id=%d&country=%s';

    protected const ALBUM_SEARCH_QUERY = 'entity=album&media=music&term=%s&country=%s';
	
	/**
	 * @param string $id
	 * @param string $country
	 * @param null   $includeTracks
	 *
	 * @return \DariusIII\ItunesApi\Entities\Album|\DariusIII\ItunesApi\Entities\EntityInterface|null
	 * @throws \DariusIII\ItunesApi\Exceptions\AlbumNotFoundException
	 * @throws \DariusIII\ItunesApi\Exceptions\InvalidEndpointException
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

        if ($album && !empty($tracks)) {
            $album->setTracks(new Collection($tracks));
        }

        return $album;
    }
	
	/**
	 * @param string $name
	 * @param string $country
	 *
	 * @return \DariusIII\ItunesApi\Utils\SearchResults
	 * @throws \DariusIII\ItunesApi\Exceptions\InvalidEndpointException
	 * @throws \DariusIII\ItunesApi\Exceptions\SearchNoResultsException
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
	 * @param null   $includeTracks
	 *
	 * @return \DariusIII\ItunesApi\Entities\Album|\DariusIII\ItunesApi\Entities\EntityInterface|null
	 * @throws \DariusIII\ItunesApi\Exceptions\AlbumNotFoundException
	 * @throws \DariusIII\ItunesApi\Exceptions\InvalidEndpointException
	 * @throws \DariusIII\ItunesApi\Exceptions\SearchNoResultsException
	 */
    public function fetchOneByName($name, $country = self::DEFAULT_COUNTRY, $includeTracks = null)
    {
        /** @var Album[] $albums */
        $albums = $this->fetchByName($name, $country);
        $album = $albums[0];

        return $includeTracks ? $this->fetchById($album->getItunesId(), $country, $includeTracks) : $album;
    }
}
