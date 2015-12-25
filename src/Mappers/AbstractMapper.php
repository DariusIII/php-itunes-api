<?php
namespace Jacoz\ItunesApi\Mappers;

use Jacoz\ItunesApi\Entities\EntityInterface;

abstract class AbstractMapper
{
    const IDENTIFER_EXPLICIT = 'explicit';

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
        $mapper = new static($data);

        return $mapper->getObject();
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
