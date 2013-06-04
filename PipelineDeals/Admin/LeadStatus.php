<?php
namespace PipelineDeals\Admin\LeadStatus;

/**
 * Container to hold data about lead status
 *
 * @author Joel Colombo
 */
class PipelineDeals_Admin_LeadStatus {

    protected $id;
    protected $name;
    protected $position;
    protected $hex_color;

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
        $this->position = (isset($data['position']))?$data['position']:null;
        $this->hex_color = (isset($data['hex_color']))?$data['hex_color']:null;

    }

}

