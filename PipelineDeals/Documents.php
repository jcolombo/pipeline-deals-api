<?php
namespace PipelineDeals\Documents;

use PipelineDeals\RequestAbstract\PipelineDeals_RequestAbstract;
use PipelineDeals\Document\PipelineDeals_Document;


/**
 * Document Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_Documents extends PipelineDeals_RequestAbstract
{
    protected $hydration_entity = 'PipelineDeals\Document\PipelineDeals_Document';
    protected $resource = 'documents';
}

