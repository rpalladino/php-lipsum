# php-lipsum

[ ![Codeship Status for rpalladino/php-lipsum](https://img.shields.io/codeship/2b6077f0-d8ab-0132-f585-769405cfda59.svg)](https://codeship.com/projects/78908)

CLI and PHP class for generating lorem ipsum text using www.lipsum.com

## Install

Via Composer

``` bash
$ composer require rpalladino/php-lipsum
```

## Usage

### CLI

```bash
$ ./vendor/bin/lipsum 
```
#### Options
```bash
Usage:
 lipsum [-w|--what="..."] [-a|--amount="..."] [-s|--start-with-lipsum]

Options:
 --what (-w)              The kind of text to generate: paras, words, bytes, lists (default: "paras")
 --amount (-a)            The amount of text to generate (default: 5)
 --start-with-lipsum (-s) Start generated text with "Lorem ipsum dolor sit amet."
```

#### Examples
```bash
# get 1 paragraph of text
$ ./vendor/bin/lipsum -a 1

# get 25 words of text beginning with "lorem ipsum"
$ ./vendor/bin/lipsum -w words -a 25 -s

# get 3 list items
$ ./vendor/bin/lipsum -w lists -a 3
```

### PHP Class

``` php
require "vendor/autoload.php";

$lipsum = new Rpalladino\Lipsum\Lipsum();

// get 1 paragraph of text
$lipsum->getParagraphs(1);

// get 25 words of text beginning with "lorem ipsum"
$lipsum->getWords(25, true);

// get 3 list items
$lipsum->getLists(3);

```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
