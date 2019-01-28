# PHP iTunes API
iTunes Query System

[![CircleCI](https://circleci.com/gh/DariusIII/php-itunes-api/tree/master.svg?style=svg)](https://circleci.com/gh/DariusIII/php-itunes-api/tree/master)

### Requirements:
- PHP >= 7.2

### Installation:

With [Composer](https://getcomposer.org/):
```json
{
    "require": {
        "dariusiii/php-itunes-api": "dev-master"
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
$moviesFinder = iTunes::load('movie');
$ebooksFinder = iTunes::load('ebook')
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

##### Movies Finder
Method | Return
--- | ---
`fetchById( int $id [, string $country ] )` | `Movie`
`fetchByName( string $name [, string $country ] )` | `SearchResults`
`fetchOneByName( int $id [, string $country ] )` | `Movie`

##### Ebooks Finder
Method | Return
--- | ---
`fetchById( int $id [, string $country ] )` | `Ebook`
`fetchByName( string $name [, string $country ] )` | `SearchResults`
`fetchOneByName( int $id [, string $country ] )` | `Ebook`

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
artistName | string | iTunes artist's name
preview | string | URL to track's audio preview
explicit | bool | -
trackNumber | integer | -
length | integer | Track's lenght in milliseconds

##### Movie Entity
Attribute | Type | Description
--- | --- | ---
itunesId | integer | -
artistId | integer | iTunes artist's ID
name | string | -
director | string | Movie director(s)
cover | string | URL to movie's cover
storeUrl | string | URL to movie's page
trailer | string | URL to movie's trailer
explicit | bool | -
description | string | Movie description
tagline | string | Movie tagline
releaseDate | DateTime | Movie release date
genre | string | Movie genre

##### Ebook Entity
Attribute | Type | Description
--- | --- | ---
itunesId | integer | -
artistId | integer | iTunes artist's ID
name | string | -
author | string | Book author
cover | string | URL to ebook cover
storeUrl | string | URL to book's page
description | string | Book description
releaseDate | DateTime | Book release date
genre | array | Boook genre


#### Collections

##### `Collection`
A `Collection` is an `ArrayObject`

##### `SearchResults`
A `SearchResults` is an `ArrayObject`

