<?php
namespace Jacoz\ItunesApi\Providers;

use Jacoz\ItunesApi\Entities\EntityInterface;
use Jacoz\ItunesApi\Utils\SearchResults;

interface ProviderInterface
{
    /**
     * @param string $id
     * @param string $country
     * @return EntityInterface
     */
    public function fetchById($id, $country);

    /**
     * @param string $name
     * @param string $country
     * @return SearchResults
     */
    public function fetchByName($name, $country);

    /**
     * @param string $name
     * @param string $country
     * @return EntityInterface
     */
    public function fetchOneByName($name, $country);
}
