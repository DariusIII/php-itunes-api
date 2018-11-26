<?php
namespace DariusIII\ItunesApi\Providers;

use DariusIII\ItunesApi\Entities\Track;
use DariusIII\ItunesApi\Exceptions\TrackNotFoundException;
use DariusIII\ItunesApi\Exceptions\SearchNoResultsException;
use DariusIII\ItunesApi\Mappers\TrackMapper;
use DariusIII\ItunesApi\Utils\SearchResults;

class TrackProvider extends AbstractProvider
{
    protected const TRACK_QUERY = 'entity=song&id=%d&country=%s';

    protected const TRACK_SEARCH_QUERY = 'entity=song&media=music&term=%s&country=%s';
	
	/**
	 * @param string $id
	 * @param string $country
	 *
	 * @return \DariusIII\ItunesApi\Entities\EntityInterface
	 * @throws \DariusIII\ItunesApi\Exceptions\InvalidEndpointException
	 * @throws \DariusIII\ItunesApi\Exceptions\TrackNotFoundException
	 */
    public function fetchById($id, $country = self::DEFAULT_COUNTRY)
    {
        $results = $this->lookup(sprintf(self::TRACK_QUERY, (int)$id, $country));
        if ($results === false) {
            throw new TrackNotFoundException($id);
        }
	
	    return TrackMapper::map($results[0]);
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
	 *
	 * @return \DariusIII\ItunesApi\Entities\EntityInterface|\DariusIII\ItunesApi\Entities\Track
	 * @throws \DariusIII\ItunesApi\Exceptions\InvalidEndpointException
	 * @throws \DariusIII\ItunesApi\Exceptions\SearchNoResultsException
	 */
    public function fetchOneByName($name, $country = self::DEFAULT_COUNTRY)
    {
        /** @var Track[] $tracks */
        $tracks = $this->fetchByName($name, $country);

        return $tracks[0];
    }
}
