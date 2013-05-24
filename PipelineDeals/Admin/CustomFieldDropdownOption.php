<?php
namespace PipelineDeals\Admin\CustomFieldDropdownOption;

/**
 * Container to hold dropdown option for a custom label
 *
 * @author Joel Colombo
 */
class PipelineDeals_Admin_CustomFieldDropdownOption {

    protected $id;
    protected $name;
    protected $position;
    protected $value;

    public function __construct($data=null)
    {
        if (!is_null($data)) {
            $this->loadFromData($data);
        }
    }

    public function loadFromData($data)
    {
        $this->id = (isset($data['id']))?$data['id']:null;
        $this->name = (isset($data['name']))?$data['name']:null;
        $this->position = (isset($data['position']))?$data['position']:null;
        $this->value = (isset($data['value']))?$data['value']:null;
    }

}

