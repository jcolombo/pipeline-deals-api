<?php
namespace PipelineDeals\Companies;

use PipelineDeals\RequestAbstract\PipelineDeals_RequestAbstract;
use PipelineDeals\Company\PipelineDeals_Company;

/**
 * Companies Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_Companies extends PipelineDeals_RequestAbstract
{
    protected $hydration_entity = 'PipelineDeals\Company\PipelineDeals_Company';
    protected $resource = 'companies';
}

