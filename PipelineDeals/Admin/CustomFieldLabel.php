<?php
namespace PipelineDeals\Admin\CustomFieldLabel;

use PipelineDeals\Admin\CustomFieldDropdownOption\PipelineDeals_Admin_CustomFieldDropdownOption as Option;

/**
 * Container to hold data about custom field labels
 *
 * @author Joel Colombo
 */
class PipelineDeals_Admin_CustomFieldLabel {

    protected $id;
    protected $name;
    protected $field_type;
    protected $is_required;
    protected $dropdown_entries;

    public function __construct($data=null)
    {
        $this->dropdown_entries = array();
        if (!is_null($data)) {
            $this->loadFromData($data);
        }
    }

    public function loadFromData($data)
    {
        //var_dump($data);

        $this->id = (isset($data['id']))?$data['id']:null;
        $this->name = (isset($data['name']))?$data['name']:null;
        $this->field_type = (isset($data['field_type']))?$data['field_type']:null;
        $this->is_required = (isset($data['is_required']))?$data['is_required']:null;
        $this->dropdown_entries = array();
        if (isset($data['custom_field_label_dropdown_entries'])
                && is_array($data['custom_field_label_dropdown_entries'])
                && count($data['custom_field_label_dropdown_entries']) > 0) {
            foreach($data['custom_field_label_dropdown_entries'] as $entry) {
                $this->dropdown_entries[$entry['id']] = new Option($entry);
            }
        }
    }

}

