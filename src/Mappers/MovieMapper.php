<?php
namespace DariusIII\ItunesApi\Mappers;

use DariusIII\ItunesApi\Entities\Movie;

class MovieMapper extends AbstractMapper
{
	/**
	 * @return Movie
	 * @throws \Exception
	 */
	protected function getObject()
	{
		$movie = new Movie();
		$movie->setItunesId($this->data->collectionId);
		$movie->setArtistId($this->data->collectionArtistId);
		$movie->setName($this->data->collectionName);
		
		if (isset($this->data->artworkUrl100)) {
			$movie->setCover($this->data->artworkUrl100);
		}
		$movie->setStoreUrl($this->data->collectionViewUrl);
		$movie->setTrailerUrl($this->data->previewUrl);
		
		$movie->setExplicit($this->data->collectionExplicitness === self::IDENTIFER_EXPLICIT);
		$movie->setReleaseDate(new \DateTime($this->data->releaseDate));
		$movie->setDescription($this->data->longDescription);
		$movie->setGenre($this->data->primaryGenreName);
		
		return $movie;
	}
}
