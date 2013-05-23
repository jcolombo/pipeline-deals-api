<?php
namespace PipelineDeals\Deal;

use PipelineDeals\EntityAbstract\PipelineDeals_EntityAbstract;

/**
 * Deals Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_Deal extends PipelineDeals_EntityAbstract
{

    protected $object_key = 'deal';

    /*
     * Load a deal from the API based on an ID property in the instance
     */
    public function load()
    {
        $this->data = $this->pdc->executeRequest("deals/{$this->id}", 'get');
    }

}