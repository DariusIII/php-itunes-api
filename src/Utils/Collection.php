<?php
namespace DariusIII\ItunesApi\Utils;

use DariusIII\ItunesApi\Entities\EntityInterface;

class Collection extends \ArrayObject implements \JsonSerializable
{
    /**
     * Gets record by index
     *
     * @param integer $index Record index
     *
     * @return EntityInterface
     */
    public function get($index)
    {
        return $this[$index];
    }

    /**
     * Gets first record
     *
     * @return EntityInterface
     */
    public function first()
    {
        return $this[0];
    }

    /**
     * Gets last record
     *
     * @return EntityInterface
     */
    public function last()
    {
        return $this[($this->count() - 1)];
    }

    /**
     * Retrieves only choosen attribute from the collection
     *
     * @param string $attribute The attribute to get
     * @param bool   $unique    By setting it to true, the returned array won't
     *                          contain duplicate items
     *
     * @return array
     */
    public function map($attribute, $unique = null)
    {
        $array = [];

        $iterator = $this->getIterator();
        while ($iterator->valid()) {
            /** @var EntityInterface $current */
            $current = $iterator->current();
            $array[] = $current->{'get' . ucfirst($attribute)}();

            $iterator->next();
        }

        if ($unique === true) {
            $array = array_unique($array);
        }

        return $array;
    }

    /**
     * @param string $attribute
     * @param int $direction
     * @return Collection
     */
    public function sort($attribute, $direction = SORT_ASC)
    {
        $cmp = function($a, $b) use ($attribute, $direction) {
            $a = $a->{'get' . ucfirst($attribute)}();
            $b = $b->{'get' . ucfirst($attribute)}();

            if ($a == $b) {
                return 0;
            }
            return (($direction === SORT_ASC && $a < $b) || ($direction === SORT_DESC && $a > $b))
                ? -1
                : 1;
        };

        $array = $this->getArrayCopy();
        usort($array, $cmp);

        return new static($array);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->getArrayCopy();
    }
}
