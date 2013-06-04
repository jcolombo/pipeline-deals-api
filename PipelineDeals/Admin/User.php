<?php
namespace PipelineDeals\Admin\User;

/**
 * Container to hold data about a user
 *
 * @author Joel Colombo
 */
class PipelineDeals_Admin_User {

    protected $id;
    protected $name;
    protected $total_person_visibility_count;
    protected $is_allowed_to_delete;
    protected $is_account_admin;
    protected $date_format;
    protected $manager_id;
    protected $last_name;
    protected $email;
    protected $time_format;
    protected $time_zone;
    protected $first_name;
    protected $commission_rate;
    protected $is_allowed_to_export;
    protected $level;
    protected $account_id;
    protected $total_deal_visibility_count;


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
        $this->total_person_visibility_count = (isset($data['total_person_visibility_count']))?$data['total_person_visibility_count']:null;
        $this->is_allowed_to_delete = (isset($data['is_allowed_to_delete']))?$data['is_allowed_to_delete']:null;
        $this->is_account_admin = (isset($data['is_account_admin']))?$data['is_account_admin']:null;
        $this->date_format = (isset($data['date_format']))?$data['date_format']:null;
        $this->manager_id = (isset($data['manager_id']))?$data['manager_id']:null;
        $this->last_name = (isset($data['last_name']))?$data['last_name']:null;
        $this->email = (isset($data['email']))?$data['email']:null;
        $this->time_format = (isset($data['time_format']))?$data['time_format']:null;
        $this->time_zone = (isset($data['time_zone']))?$data['time_zone']:null;
        $this->first_name = (isset($data['first_name']))?$data['first_name']:null;
        $this->commission_rate = (isset($data['commission_rate']))?$data['commission_rate']:null;
        $this->is_allowed_to_export = (isset($data['is_allowed_to_export']))?$data['is_allowed_to_export']:null;
        $this->level = (isset($data['level']))?$data['level']:null;
        $this->account_id = (isset($data['account_id']))?$data['account_id']:null;
        $this->total_deal_visibility_count = (isset($data['total_deal_visibility_count']))?$data['total_deal_visibility_count']:null;

    }

}

