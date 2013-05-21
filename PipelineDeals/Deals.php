<?php
namespace PipelineDeals\Deals;

use PipelineDeals\RequestAbstract\PipelineDeals_RequestAbstract;
use PipelineDeals\Deal\PipelineDeals_Deal;

/**
 * Deals Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_Deals extends PipelineDeals_RequestAbstract
{
    protected $hydration_entity = 'PipelineDeals\Deal\PipelineDeals_Deal';

    public function find()
    {
        $this->hydrate($this->pdc->executeRequest('deals', 'get', $this->filters), $this->hydration_entity);
    }

}

