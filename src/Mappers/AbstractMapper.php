<?php
namespace DariusIII\ItunesApi\Mappers;

use DariusIII\ItunesApi\Entities\EntityInterface;

abstract class AbstractMapper
{
    protected const IDENTIFER_EXPLICIT = 'explicit';

    /**
     * @var object
     */
    protected $data;

    /**
     * @param $data
     * @return EntityInterface
     */
    final public static function map($data)
    {
	    return (new static($data))->getObject();
    }

    /**
     * @param $data
     */
    private function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return EntityInterface
     */
    abstract protected function getObject();
}
