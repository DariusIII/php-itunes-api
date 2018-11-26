# PHP iTunes API
iTunes Query System

### Requirements:
- PHP >= 5.4

### Installation:

With [Composer](https://getcomposer.org/):
```json
{
    "require": {
        "jacoz/php-itunes-api": "dev-master"
    }
}
```
### Usage:
You can search artists, albums and tracks (by now)
```php
<?php
use DariusIII\ItunesApi\iTunes;

$artistsFinder = iTunes::load('artist');
$albumsFinder = iTunes::load('album');
$tracksFinder = iTunes::load('track');
```

#### Finders' methods

##### Artists Finder
Method | Return
--- | ---
`fetchById( int $id [, string $country [, bool $includeAlbums ] ] )` | `Artist`
`fetchByName( string $name [, string $country ] )` | `SearchResults`
`fetchOneByName( int $id [, string $country [, bool $includeAlbums ] ] )` | `Artist`

##### Albums Finder
Method | Return
--- | ---
`fetchById( int $id [, string $country [, bool $includeTracks ] ] )` | `Album`
`fetchByName( string $name [, string $country ] )` | `SearchResults`
`fetchOneByName( int $id [, string $country [, bool $includeTracks ] ] )` | `Album`

##### Tracks Finder
Method | Return
--- | ---
`fetchById( int $id [, string $country ] )` | `Track`
`fetchByName( string $name [, string $country ] )` | `SearchResults`
`fetchOneByName( int $id [, string $country ] )` | `Track`

#### Entities

##### Artist Entity
Attribute | Type | Description
--- | --- | ---
itunesId | integer | -
name | string | -
albums | Collection | -

##### Album Entity
Attribute | Type | Description
--- | --- | ---
itunesId | integer | -
artistId | integer | iTunes artist's ID
name | string | -
cover | string | URL to image
explicit | bool | -
tracksCount | integer | -
releaseDate | DateTime | -
tracks | Collection | -

##### Track Entity
Attribute | Type | Description
--- | --- | ---
itunesId | integer | -
artistId | integer | iTunes artist's ID
albumId | integer | iTunes album's ID
name | string | -
preview | string | URL to track's audio preview
explicit | bool | -
trackNumber | integer | -
length | integer | Track's lenght in milliseconds

#### Collections

##### `Collection`
A `Collection` is an `ArrayObject` 

##### `SearchResults`
A `SearchResults` is an `ArrayObject`

