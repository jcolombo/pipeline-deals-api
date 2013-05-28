<?php
namespace PipelineDeals\Admin\DealStage;

/**
 * Container to hold data about deal stage
 *
 * @author Joel Colombo
 */
class PipelineDeals_Admin_DealStage {

    protected $id;
    protected $name;
    protected $percent;
    protected $probability_low;
    protected $probability_high;

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
        $this->percent = (isset($data['percent']))?$data['percent']:null;
        $this->probability_low = (isset($data['probability_low']))?$data['probability_low']:null;
        $this->probability_high = (isset($data['probability_high']))?$data['probability_high']:null;
    }

}

