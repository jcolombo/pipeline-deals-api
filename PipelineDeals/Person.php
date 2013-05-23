<?php
namespace PipelineDeals\Person;

use PipelineDeals\EntityAbstract\PipelineDeals_EntityAbstract;

/**
 * Person Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_Person extends PipelineDeals_EntityAbstract
{

    protected $object_key = 'person';

    /*
     * Load a person from the API based on an ID property in the instance
     */
    public function load()
    {
        $this->data = $this->pdc->executeRequest("people/{$this->id}", 'get');
    }

}