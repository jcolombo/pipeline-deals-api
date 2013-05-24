# Pipeline Deals API Wrapper Library

This is a PHP Library for wrapping the PipelineDeals.com API

## Installation

Include the library loader file into your project.

REQUIRES PHP 5.3.0 or HIGHER as the package uses namespaces.

```php
<?php

    // To manually include the library in any PHP app.

    // 1. Copy the library to any place in your codebase
    // 2. "Require" the pre-built loader to include the classes
    require 'pipeline-deals-api/loader.php';

    // The library is also built using the ZEND Naming conventions
    // This allows you to include the package with any pre-built autoloaders

?>
```

## Basic Usage Example

A simple example to load and display the names of DEALS belonging to a user.

```php
<?php

    require 'pipeline-deals-api/loader.php';

    //Establish the connection to Pipeline Deals
    $pdc = PipelineDeals_Connection::getConnection('YourApiKeyForDesiredUser');

    //Retrieve the list of all details for the first 200 deals assigned to this user
    $deals = new PipelineDeals_Deals($pdc);
    $deal_objects = $deals->find(); // Returns an array of PipelineDeals_Deal objects

    foreach($deal_objects as $deal) {
        echo "Deal[".$deal->get('id')."] with name : ".$deal->get('name')."<br/>";
    }

?>
```

