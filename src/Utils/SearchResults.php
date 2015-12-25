<?php
namespace Jacoz\ItunesApi\Utils;

class SearchResults extends Collection
{
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'count' => $this->count(),
            'results' => $this->getArrayCopy(),
        ];
    }
}
