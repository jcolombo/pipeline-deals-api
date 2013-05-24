<?php
namespace PipelineDeals\Document;

use PipelineDeals\EntityAbstract\PipelineDeals_EntityAbstract;

/**
 * Document entity container
 *
 * @author Joel Colombo
 */
class PipelineDeals_Document extends PipelineDeals_EntityAbstract
{

    protected $object_key = 'document';

    /*
     * Documents cannot be loaded individually, only populated from request lists
     */
    public function load()
    {
        return false; // There is no API direct document loader
    }

}