<?php
namespace DariusIII\ItunesApi\Providers;

use DariusIII\ItunesApi\Exceptions\InvalidEndpointException;
use DariusIII\ItunesApi\Exceptions\InvalidProviderException;
use DariusIII\ItunesApi\Utils\Country;

abstract class AbstractProvider implements ProviderInterface
{
    const URL_SEARCH = 'https://itunes.apple.com/search';

    const URL_LOOKUP = 'https://itunes.apple.com/lookup';

    const DEFAULT_COUNTRY = Country::US;

    const IDENTIFIER_ARTIST = 'artist';

    const IDENTIFIER_ALBUM = 'collection';

    const IDENTIFIER_TRACK = 'track';

    private static $providers = [];

    /**
     * @param string $provider
     * @return ProviderInterface
     * @throws InvalidProviderException
     */
    public static function factory($provider)
    {
        if (!isset(self::$providers[$provider])) {
            $providerClass = '\\Jacoz\\ItunesApi\\Providers\\' . ucfirst($provider) . 'Provider';

            if (!class_exists($providerClass)) {
                throw new InvalidProviderException($provider);
            }

            self::$providers[$provider] = new $providerClass();
        }

        return self::$providers[$provider];
    }

    protected function __construct()
    {
    }

    /**
     * @param string|array $params
     * @return array|bool
     */
    protected function search($params)
    {
        return $this->fetchData(self::URL_SEARCH, $params);
    }

    /**
     * @param string|array $params
     * @return array|bool
     */
    protected function lookup($params)
    {
        return $this->fetchData(self::URL_LOOKUP, $params);
    }

    /**
     * @param string $url
     * @param string|array|null $params
     * @return object|bool
     * @throws InvalidEndpointException
     */
    private function fetchData($url, $params = null)
    {
        if ($params) {
            if (is_array($params)) {
                $url .= '?' . http_build_query($params);
            } elseif (is_string($params)) {
                $url .= '?' . $params;
            }
        }

        if (($data = @file_get_contents($url)) === false) {
            throw new InvalidEndpointException();
        }
        $data = json_decode($data);

        if ($data->resultCount === 0) {
            return false;
        }

        return $data->results;
    }
}
