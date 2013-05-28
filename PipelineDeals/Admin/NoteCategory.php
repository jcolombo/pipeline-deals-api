<?php
namespace PipelineDeals\Admin\NoteCategory;

/**
 * Container to hold data about note category
 *
 * @author Joel Colombo
 */
class PipelineDeals_Admin_NoteCategory {

    protected $id;
    protected $name;
    protected $position;
    protected $account_id;
    protected $system_category;

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
        $this->system_category = (isset($data['system_category']))?$data['system_category']:null;
    }

}

