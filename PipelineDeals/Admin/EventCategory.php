<?php
namespace PipelineDeals\Admin\EventCategory;

/**
 * Container to hold data about an event category
 *
 * @author Joel Colombo
 */
class PipelineDeals_Admin_EventCategory {

    protected $id;
    protected $name;
    protected $position;
    protected $account_id;
    protected $is_system_category;

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
        $this->account_id = (isset($data['account_id']))?$data['account_id']:null;
        $this->is_system_category = (isset($data['is_system_category']))?$data['is_system_category']:null;

    }

}

