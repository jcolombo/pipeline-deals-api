<?php
namespace PipelineDeals\Note;

use PipelineDeals\EntityAbstract\PipelineDeals_EntityAbstract;

/**
 * Note Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_Note extends PipelineDeals_EntityAbstract
{

    protected $object_key = 'note';

    /*
     * Load a person from the API based on an ID property in the instance
     */
    public function load()
    {
        $this->data = $this->pdc->executeRequest("notes/{$this->id}", 'get');
    }

}