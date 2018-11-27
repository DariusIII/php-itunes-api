<?php
namespace DariusIII\ItunesApi\Providers;

use DariusIII\ItunesApi\Exceptions\InvalidProviderException;

abstract class AbstractProvider implements ProviderInterface
{
    protected const URL_SEARCH = 'https://itunes.apple.com/search';

    protected const URL_LOOKUP = 'https://itunes.apple.com/lookup';

    protected const IDENTIFIER_ARTIST = 'artist';

    protected const IDENTIFIER_ALBUM = 'collection';

    protected const IDENTIFIER_TRACK = 'track';

    protected const IDENTIFIER_MOVIE = 'movie';

    private static $providers = [];

    /**
     * @param string $provider
     * @return ProviderInterface
     * @throws InvalidProviderException
     */
    public static function factory($provider)
    {
        if (!isset(self::$providers[$provider])) {
            $providerClass = '\\DariusIII\\ItunesApi\\Providers\\' . ucfirst($provider) . 'Provider';

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
     * @param $params
     * @return bool|mixed
     */
    protected function search($params)
    {
        return $this->fetchData(self::URL_SEARCH, $params);
    }

    /**
     * @param $params
     * @return bool|mixed
     */
    protected function lookup($params)
    {
        return $this->fetchData(self::URL_LOOKUP, $params);
    }

    /**
     * @param $url
     * @param null $params
     * @return bool|mixed
     */
    private function fetchData($url, $params = null)
    {
        if ($params) {
            if (\is_array($params)) {
                $url .= '?' . http_build_query($params);
            } elseif (\is_string($params)) {
                $url .= '?' . $params;
            }
        }

        if (($data = @file_get_contents($url)) === false) {
            return false;
        }
        $data = json_decode($data);

        if ($data->resultCount === 0) {
            return false;
        }

        return $data->results;
    }
}
