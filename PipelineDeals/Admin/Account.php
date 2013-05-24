<?php
namespace PipelineDeals\Admin\Account;

use PipelineDeals\Connection\PipelineDeals_Connection;
use PipelineDeals\Admin\CustomFieldLabel\PipelineDeals_Admin_CustomFieldLabel;

/**
 * The loader class to pull in all the Account "Admin" resources
 *
 * @author Joel Colombo
 */
class PipelineDeals_Admin_Account {

    private static $instance = null;
    protected $pdc = null;

    protected $account_id = null;
    protected $total_company_count = 0;

    protected $company_custom_field_labels = array();
    protected $person_custom_field_labels = array();
    protected $deal_custom_field_labels = array();

    protected $note_categories = array();
    protected $predefined_contacts_tags = array();
    protected $deal_stages = array();
    protected $lead_sources = array();
    protected $users = array();
    protected $lead_statuses = array();
    protected $event_categories = array();

    /*
     * Called by the loadAdminResources static call to perform the execution and population
     */
    public function executeResourceLoader()
    {
        $admin_data = $this->pdc->executeRequest('account', 'get');

        if ($admin_data) {
            // Reset the containers to prepare for rehydration
            $this->account_id = null;
            $this->total_company_count = 0;

            $this->company_custom_field_labels = array();
            $this->person_custom_field_labels = array();
            $this->deal_custom_field_labels = array();

            $this->note_categories = array();
            $this->predefined_contacts_tags = array();
            $this->deal_stages = array();
            $this->lead_sources = array();
            $this->users = array();
            $this->lead_statuses = array();
            $this->event_categories = array();

            if (isset($admin_data['id'])) {
                $this->account_id = $admin_data['id'];
            }
            if (isset($admin_data['total_company_count'])) {
                $this->total_company_count = $admin_data['total_company_count'];
            }
            if (isset($admin_data['deal_custom_field_labels'])) {
                foreach($admin_data['deal_custom_field_labels'] as $label_data) {
                    $this->deal_custom_field_labels[$label_data['id']] = null;
                    $d =& $this->deal_custom_field_labels[$label_data['id']];
                    $d = new PipelineDeals_Admin_CustomFieldLabel($label_data);
                }
                //var_dump($admin_data['deal_custom_field_labels']);
            }

            var_dump($this);
            //var_dump($admin_data);

            return true;
        }
        return null;
    }

    /*
     * Singleton static method to create and load all admin resources
     */
    static public function loadAdminResources(PipelineDeals_Connection $pdc=null)
    {
        $a = PipelineDeals_Admin_Account::getInstance($pdc);
        $a -> executeResourceLoader();
    }

    /*
     * Singleton instance retriever
     */
    public static function getInstance(PipelineDeals_Connection $pdc=null) {
        if(!isset(self::$instance)) {
            self::$instance = new PipelineDeals_Admin_Account($pdc);
        }
        return self::$instance;
    }

    /*
     * Private constructor called by the singleton getInstance method
     */
    private function __construct(PipelineDeals_Connection $pdc=null)
    {
        if (is_null($pdc)) {
            $pdc = PipelineDeals_Connection::getConnection();
        }
        $this->pdc = $pdc;
    }

}

