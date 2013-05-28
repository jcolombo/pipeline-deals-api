<?php
namespace PipelineDeals\Admin\PredefinedContactsTag;

/**
 * Container to hold data about note category
 *
 * @author Joel Colombo
 */
class PipelineDeals_Admin_PredefinedContactsTag {

    protected $id;
    protected $name;

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
    }

}

