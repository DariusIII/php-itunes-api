<?php
use Jacoz\ItunesApi\Utils\SearchResults;

class SearchResultsTest extends AbstractCollectionTest
{
    public function setUp()
    {
        $this->data = new SearchResults($this->getData());
    }

    public function testJsonSerialization()
    {
        $results = json_decode(json_encode($this->data), true);

        $this->assertArrayHasKey('count', $results);
        $this->assertArrayHasKey('results', $results);

        $this->assertEquals(3, $results['count']);
        $this->assertNotEmpty($results['results']);
    }
}
