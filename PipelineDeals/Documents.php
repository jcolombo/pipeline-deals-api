<?php
namespace PipelineDeals\Documents;

use PipelineDeals\RequestAbstract\PipelineDeals_RequestAbstract;
use PipelineDeals\Deal\PipelineDeals_Document;

/**
 * Document Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_Documents extends PipelineDeals_RequestAbstract
{
    protected $hydration_entity = 'PipelineDeals\Deal\PipelineDeals_Document';
    protected $resource = 'documents';
}

