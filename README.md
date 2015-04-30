# YML Parser
Parser for yml(yandex.market.ru) files. YMLParser out of box uses two types of parsing:
* XMLReader - for medium and large xml files
* SimpleXML - for small xml files

## Installation
---
via Composer:

```
composer require serkin/ymlparser ~1.1
```

## Usage
---
### Getting all offers from file

```php
include 'vendor/autoload.php';

$filename = '/path/to/file/file.xml';

//   XMLReader driver - for medium and large xml files
//   SimpleXML driver - for small xml files

$parser = new \YMLParser\YMLParser(new \YMLParser\Driver\XMLReader);
$parser->open($filename); // throws \Exception if $filename doesn't exist or empty
foreach($parser->getOffers() as $offer): // YMLParser::getOffers() returns \Generator
    echo $offer['url'];
endforeach;
```
### Getting all offers from file with applied filter
YMLParser::getOffers() can take filter function as an argument. Filter should be an anonymous function which returns true or false
```php
include 'vendor/autoload.php';

$filename = '/path/to/file/file.xml';

$parser = new \YMLParser\YMLParser(new \YMLParser\Driver\SimpleXML);
$parser->open($filename);

// We want offers only with not empty url subelements
$filter = function($element) { return !empty($element['url']); }; 
$offers = iterator_to_array($parser->getOffers($filter));

// Let's get all params from first offer if they are exist
foreach($offers[0]['params'] as $param):
	echo $param['name'] . ' - ' . $param['value'];
endforeach;

```

## Dependencies
* PHP: >= 5.5
* xmlrpc extension
* mbstring extension

## Contribution
* Send a pull request

## Licence
* MIT

## TODO
* countOffers()
* getCurrencies()
* setDefaultCurrency()
* Offers price according set defaultCurrency

## Tests
```
phpunit
```

## It is extensible
You can create your own Driver. All you have to do is to implement YMLParser\Driver\DriverInterface interface in your class

