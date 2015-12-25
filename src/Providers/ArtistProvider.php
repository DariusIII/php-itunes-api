<?php
namespace Jacoz\ItunesApi\Providers;

use Jacoz\ItunesApi\Entities\Artist;
use Jacoz\ItunesApi\Exceptions\ArtistNotFoundException;
use Jacoz\ItunesApi\Exceptions\SearchNoResultsException;
use Jacoz\ItunesApi\Mappers\AlbumMapper;
use Jacoz\ItunesApi\Mappers\ArtistMapper;
use Jacoz\ItunesApi\Utils\Collection;
use Jacoz\ItunesApi\Utils\SearchResults;

class ArtistProvider extends AbstractProvider
{
    const ARTIST_QUERY = 'entity=musicArtist&id=%d&country=%s';

    const ARTIST_ALBUMS_QUERY = 'entity=album&id=%d&country=%s';

    const ARTIST_SEARCH_QUERY = 'entity=musicArtist&media=music&term=%s&country=%s';

    /**
     * @param integer $id
     * @param string $country
     * @param bool $includeAlbums
     * @return Artist|null
     * @throws ArtistNotFoundException
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

        if ($artist) {
            if (!empty($albums)) {
                $artist->setAlbums(new Collection($albums));
            }
        }

        return $artist;
    }

    /**
     * @param string $name
     * @param string $country
     * @return Artist[]
     * @throws SearchNoResultsException
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
     * @param bool $includeAlbums
     * @return Artist|null
     * @throws ArtistNotFoundException
     * @throws SearchNoResultsException
     */
    public function fetchOneByName($name, $country = self::DEFAULT_COUNTRY, $includeAlbums = null)
    {
        /** @var Artist[] $albums */
        $artists = $this->fetchByName($name, $country);
        $artist = $artists[0];

        return $includeAlbums ? $this->fetchById($artist->getItunesId(), $country, $includeAlbums) : $artist;
    }
}
