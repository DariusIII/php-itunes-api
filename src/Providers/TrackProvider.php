<?php
namespace Jacoz\ItunesApi\Providers;

use Jacoz\ItunesApi\Entities\Track;
use Jacoz\ItunesApi\Exceptions\TrackNotFoundException;
use Jacoz\ItunesApi\Exceptions\SearchNoResultsException;
use Jacoz\ItunesApi\Mappers\TrackMapper;
use Jacoz\ItunesApi\Utils\SearchResults;

class TrackProvider extends AbstractProvider
{
    const TRACK_QUERY = 'entity=song&id=%d&country=%s';

    const TRACK_SEARCH_QUERY = 'entity=song&media=music&term=%s&country=%s';

    /**
     * @param integer $id
     * @param string $country
     * @return Track|null
     * @throws TrackNotFoundException
     */
    public function fetchById($id, $country = self::DEFAULT_COUNTRY)
    {
        $results = $this->lookup(sprintf(self::TRACK_QUERY, (int)$id, $country));
        if ($results === false) {
            throw new TrackNotFoundException($id);
        }

        $artist = TrackMapper::map($results[0]);

        return $artist;
    }

    /**
     * @param string $name
     * @param string $country
     * @return Track[]
     * @throws SearchNoResultsException
     */
    public function fetchByName($name, $country = self::DEFAULT_COUNTRY)
    {
        $results = $this->search(sprintf(self::TRACK_SEARCH_QUERY, urlencode($name), $country));
        if ($results === false) {
            throw new SearchNoResultsException($name);
        }

        $albums = [];
        foreach($results as $result) {
            $albums[] = TrackMapper::map($result);
        }

        return new SearchResults($albums);
    }

    /**
     * @param string $name
     * @param string $country
     * @return Track|null
     * @throws TrackNotFoundException
     * @throws SearchNoResultsException
     */
    public function fetchOneByName($name, $country = self::DEFAULT_COUNTRY)
    {
        /** @var Track[] $tracks */
        $tracks = $this->fetchByName($name, $country);

        return $tracks[0];
    }
}
