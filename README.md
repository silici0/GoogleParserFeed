# GoogleParserFeed



# splio api access via PHP

Parse google merchant feed to array  PHP

## Installation

```
composer require silici0/googleparserfeed:dev-master
```


## Usage example

```
require "vendor/autoload.php";
use silici0\GoogleParserFeed\ParserGoogleFeed;

$buffer = file_get_contents("http://www.domain.com/googleshopping.xml");

$feed = new ParserGoogleFeed($buffer, LIBXML_NOCDATA);
print_r($feed->toArray());

```


## Contribution

https://stackoverflow.com/questions/26400993/resolve-namespaces-with-simplexml-regardless-of-structure-or-namespace
https://hakre.wordpress.com/2013/07/10/simplexml-and-json-encode-in-php-part-iii-and-end/
