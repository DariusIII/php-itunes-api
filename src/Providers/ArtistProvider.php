<?php
namespace DariusIII\ItunesApi\Providers;

use DariusIII\ItunesApi\Entities\Artist;
use DariusIII\ItunesApi\Exceptions\ArtistNotFoundException;
use DariusIII\ItunesApi\Exceptions\SearchNoResultsException;
use DariusIII\ItunesApi\Mappers\AlbumMapper;
use DariusIII\ItunesApi\Mappers\ArtistMapper;
use DariusIII\ItunesApi\Utils\Collection;
use DariusIII\ItunesApi\Utils\SearchResults;

class ArtistProvider extends AbstractProvider
{
    protected const ARTIST_QUERY = 'entity=musicArtist&id=%d&country=%s';

    protected const ARTIST_ALBUMS_QUERY = 'entity=album&id=%d&country=%s';

    protected const ARTIST_SEARCH_QUERY = 'entity=musicArtist&media=music&term=%s&country=%s';
	
	/**
	 * @param string $id
	 * @param string $country
	 * @param null   $includeAlbums
	 *
	 * @return \DariusIII\ItunesApi\Entities\Artist|\DariusIII\ItunesApi\Entities\EntityInterface|null
	 * @throws \DariusIII\ItunesApi\Exceptions\ArtistNotFoundException
	 * @throws \DariusIII\ItunesApi\Exceptions\InvalidEndpointException
	 */
    public function fetchById($id, $country = self::DEFAULT_COUNTRY, $includeAlbums = null)
    {
        $results = $this->lookup(sprintf($includeAlbums ? self::ARTIST_ALBUMS_QUERY : self::ARTIST_QUERY, (int)$id, $country));
        if ($results === false) {
            throw new ArtistNotFoundException($id);
        }

        $artist = null;
        $albums = [];

        foreach($results as $result) {
            switch($result->wrapperType) {
                case self::IDENTIFIER_ARTIST:
                    /** @var Artist $artist */
                    $artist = ArtistMapper::map($result);
                    break;

                case self::IDENTIFIER_ALBUM:
                    $albums[] = AlbumMapper::map($result);
                    break;
            }
        }

        if ($artist && !empty($albums)) {
            $artist->setAlbums(new Collection($albums));
        }

        return $artist;
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
        $results = $this->search(sprintf(self::ARTIST_SEARCH_QUERY, urlencode($name), $country));
        if ($results === false) {
            throw new SearchNoResultsException($name);
        }

        $albums = [];
        foreach($results as $result) {
            $albums[] = ArtistMapper::map($result);
        }

        return new SearchResults($albums);
    }
	
	/**
	 * @param string $name
	 * @param string $country
	 * @param null   $includeAlbums
	 *
	 * @return \DariusIII\ItunesApi\Entities\Artist|\DariusIII\ItunesApi\Entities\EntityInterface|mixed|null
	 * @throws \DariusIII\ItunesApi\Exceptions\ArtistNotFoundException
	 * @throws \DariusIII\ItunesApi\Exceptions\InvalidEndpointException
	 * @throws \DariusIII\ItunesApi\Exceptions\SearchNoResultsException
	 */
    public function fetchOneByName($name, $country = self::DEFAULT_COUNTRY, $includeAlbums = null)
    {
        /** @var Artist[] $albums */
        $artists = $this->fetchByName($name, $country);
        $artist = $artists[0];

        return $includeAlbums ? $this->fetchById($artist->getItunesId(), $country, $includeAlbums) : $artist;
    }
}
