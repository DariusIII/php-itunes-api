<?php
namespace DariusIII\ItunesApi\Providers;

use DariusIII\ItunesApi\Entities\Movie;
use DariusIII\ItunesApi\Exceptions\MovieNotFoundException;
use DariusIII\ItunesApi\Exceptions\SearchNoResultsException;
use DariusIII\ItunesApi\Mappers\MovieMapper;
use DariusIII\ItunesApi\Utils\SearchResults;

class MovieProvider extends AbstractProvider
{
	protected const MOVIE_QUERY = 'entity=movie&id=%d&country=%s';

	protected const MOVIE_SEARCH_QUERY = 'entity=movie&media=movie&term=%s&country=%s';

	/**
	 * @param string $id
	 * @param string $country
	 *
	 * @return \DariusIII\ItunesApi\Entities\Movie|\DariusIII\ItunesApi\Entities\EntityInterface|null
	 * @throws \DariusIII\ItunesApi\Exceptions\MovieNotFoundException
     */
	public function fetchById($id, $country = self::DEFAULT_COUNTRY)
	{
		$results = $this->lookup(sprintf(self::MOVIE_QUERY, (int)$id, $country));
		if ($results === false) {
			throw new MovieNotFoundException($id);
		}

		$movie = null;
		$tracks = [];

		foreach($results as $result) {
			$i = $result->wrapperType;
			if ($i === self::IDENTIFIER_MOVIE) {
				/** @var Movie $movie */
				$movie = MovieMapper::map($result);
			}
		}

		return $movie;
	}

	/**
	 * @param string $name
	 * @param string $country
	 *
	 * @return \DariusIII\ItunesApi\Utils\SearchResults
     * @throws \DariusIII\ItunesApi\Exceptions\SearchNoResultsException
	 */
	public function fetchByName($name, $country = self::DEFAULT_COUNTRY)
	{
		$results = $this->search(sprintf(self::MOVIE_SEARCH_QUERY, urlencode($name), $country));
		if ($results === false) {
			throw new SearchNoResultsException($name);
		}

		$movies = [];
		foreach($results as $result) {
			$movies[] = MovieMapper::map($result);
		}

		return new SearchResults($movies);
	}

	/**
	 * @param string $name
	 * @param string $country
	 *
	 * @return \DariusIII\ItunesApi\Entities\Movie|\DariusIII\ItunesApi\Entities\EntityInterface|null
     * @throws \DariusIII\ItunesApi\Exceptions\SearchNoResultsException
	 */
	public function fetchOneByName($name, $country = self::DEFAULT_COUNTRY)
	{
		/** @var Movie[] $movies */
		$movies = $this->fetchByName($name, $country);

		return $movies[0];
	}
}
