<?php
namespace PipelineDeals\People;

use PipelineDeals\RequestAbstract\PipelineDeals_RequestAbstract;
use PipelineDeals\Person\PipelineDeals_Person;

/**
 * People Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_People extends PipelineDeals_RequestAbstract
{
    protected $hydration_entity = 'PipelineDeals\Person\PipelineDeals_Person';
    protected $resource = 'people';
}

