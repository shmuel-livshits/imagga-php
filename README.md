# Imagga API Client

[![Latest Stable Version](https://poser.pugx.org/fabriceclementz/imagga-php/v/stable)](https://packagist.org/packages/fabriceclementz/imagga-php)
[![Total Downloads](https://poser.pugx.org/fabriceclementz/imagga-php/downloads)](https://packagist.org/packages/fabriceclementz/imagga-php)
[![License](https://poser.pugx.org/fabriceclementz/imagga-php/license)](https://packagist.org/packages/fabriceclementz/imagga-php)
[![Build Status](https://travis-ci.org/fabriceclementz/imagga-php.svg?branch=master)](https://travis-ci.org/fabriceclementz/imagga-php)

A simple wrapper for the [Imagga API](https://docs.imagga.com).

## Installation

### Via composer

```
composer require fabriceclementz/imagga-php
```

## Usage

### Extract tags from an image

```
use GuzzleHttp\Client as HttpClient;
use Fab\Imagga\Client;

$client = new Client(new HttpClient(), 'IMAGGA_API_KEY', 'IMAGGA_API_SECRET');

$response = $client->tags('https://imagga.com/static/images/tagging/wind-farm-538576_640.jpg');
```

### Extract colors from an image

```
use GuzzleHttp\Client as HttpClient;
use Fab\Imagga\Client;

$client = new Client(new HttpClient(), 'IMAGGA_API_KEY', 'IMAGGA_API_SECRET');

$response = $client->extractColors('https://imagga.com/static/images/tagging/wind-farm-538576_640.jpg');
```

## Testing

```
composer test
```

