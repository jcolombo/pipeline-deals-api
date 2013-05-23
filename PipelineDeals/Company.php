<?php
namespace PipelineDeals\Company;

use PipelineDeals\EntityAbstract\PipelineDeals_EntityAbstract;

/**
 * Company Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_Company extends PipelineDeals_EntityAbstract
{

    protected $object_key = 'company';

    /*
     * Load a company from the API based on an ID property in the instance
     */
    public function load()
    {
        $this->data = $this->pdc->executeRequest("companies/{$this->id}", 'get');
    }

}