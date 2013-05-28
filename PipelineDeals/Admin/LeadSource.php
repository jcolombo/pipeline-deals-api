<?php
namespace PipelineDeals\Admin\LeadSource;

/**
 * Container to hold data about lead source
 *
 * @author Joel Colombo
 */
class PipelineDeals_Admin_LeadSource {

    protected $id;
    protected $name;
    protected $people_count;
    protected $cost_per_lead_in_cents;
    protected $is_system_lead_source;
    protected $flat_fee_in_cents;

    public function __construct($data=null)
    {
        if (!is_null($data)) {
            $this->loadFromData($data);
        }
    }

    public function loadFromData($data)
    {
        //var_dump($data);

        $this->id = (isset($data['id']))?$data['id']:null;
        $this->name = (isset($data['name']))?$data['name']:null;
        $this->people_count = (isset($data['people_count']))?$data['people_count']:null;
        $this->cost_per_lead_in_cents = (isset($data['cost_per_lead_in_cents']))?$data['cost_per_lead_in_cents']:null;
        $this->is_system_lead_source = (isset($data['is_system_lead_source']))?$data['is_system_lead_source']:null;
        $this->flat_fee_in_cents = (isset($data['flat_fee_in_cents']))?$data['flat_fee_in_cents']:null;
    }

}

