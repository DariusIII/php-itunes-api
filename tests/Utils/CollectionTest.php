<?php
use DariusIII\ItunesApi\Utils\Collection;

class CollectionTest extends AbstractCollectionTest
{
    public function setUp()
    {
        $this->data = new Collection($this->getData());
    }

    public function testGetByIndex()
    {
        $this->assertEquals(2, $this->data->get(1)->getItunesId());
    }

    public function testFirst()
    {
        $this->assertEquals(1, $this->data->first()->getItunesId());
    }

    public function testLast()
    {
        $this->assertEquals(3, $this->data->last()->getItunesId());
    }

    public function testMap()
    {
        $this->assertArraySubset([1, 2, 3], $this->data->map('itunesId'));
        $this->assertArraySubset(['Foo', 'Bar', 'Baz'], $this->data->map('name'));
    }

    public function testSort()
    {
        $sortAsc = $this->data->sort('name', SORT_ASC);
        $sortDesc = $this->data->sort('name', SORT_DESC);

        $this->assertEquals('Bar', $sortAsc->first()->getName());
        $this->assertEquals('Foo', $sortAsc->last()->getName());

        $this->assertEquals('Foo', $sortDesc->first()->getName());
        $this->assertEquals('Bar', $sortDesc->last()->getName());
    }

    public function testJsonSerialization()
    {
        $data = json_decode(json_encode($this->data), true);

        $this->assertCount(3, $data);
        $this->assertArrayHasKey('name', $data[0]);
    }
}
