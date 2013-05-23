# Pipeline Deals API Wrapper Library

This is a PHP Library for wrapping the PipelineDeals.com API

## Installation

Include the library loader file into your project.

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

