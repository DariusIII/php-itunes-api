<?php

namespace DariusIII\ItunesApi\Providers;

use DariusIII\ItunesApi\Entities\Ebook;
use DariusIII\ItunesApi\Exceptions\EbookNotFoundException;
use DariusIII\ItunesApi\Exceptions\SearchNoResultsException;
use DariusIII\ItunesApi\Mappers\EbookMapper;
use DariusIII\ItunesApi\Utils\SearchResults;

class EbookProvider extends AbstractProvider
{
    protected const EBOOK_QUERY = 'entity=ebook&id=%d&country=%s';

    protected const EBOOK_SEARCH_QUERY = 'entity=ebook&media=ebook&term=%s&country=%s';

    /**
     * @param string $id
     * @param string $country
     *
     * @return \DariusIII\ItunesApi\Entities\Ebook|\DariusIII\ItunesApi\Entities\EntityInterface|null
     * @throws \DariusIII\ItunesApi\Exceptions\EbookNotFoundException
     */
    public function fetchById($id, $country = self::DEFAULT_COUNTRY)
    {
        $results = $this->lookup(sprintf(self::EBOOK_QUERY, (int) $id, $country));
        if ($results === false) {
            throw new EbookNotFoundException($id);
        }

        $ebook = null;

        foreach ($results as $result) {
            $i = $result->wrapperType;
            if ($i === self::IDENTIFIER_EBOOK) {
                /** @var Ebook $ebook */
                $ebook = EbookMapper::map($result);
            }
        }

        return $ebook;
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
        $results = $this->search(sprintf(self::EBOOK_SEARCH_QUERY, urlencode($name), $country));
        if ($results === false) {
            throw new SearchNoResultsException($name);
        }

        $ebooks = [];
        foreach ($results as $result) {
            $ebooks[] = EbookMapper::map($result);
        }

        return new SearchResults($ebooks);
    }

    /**
     * @param string $name
     * @param string $country
     *
     * @return \DariusIII\ItunesApi\Entities\Ebook|\DariusIII\ItunesApi\Entities\EntityInterface|null
     * @throws \DariusIII\ItunesApi\Exceptions\SearchNoResultsException
     */
    public function fetchOneByName($name, $country = self::DEFAULT_COUNTRY)
    {
        /** @var Ebook[] $ebooks */
        $ebooks = $this->fetchByName($name, $country);

        return $ebooks[0];
    }
}
