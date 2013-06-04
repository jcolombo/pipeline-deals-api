<?php
namespace PipelineDeals\Admin\Account;

use PipelineDeals\Connection\PipelineDeals_Connection;
use PipelineDeals\Admin\CustomFieldLabel\PipelineDeals_Admin_CustomFieldLabel;
use PipelineDeals\Admin\NoteCategory\PipelineDeals_Admin_NoteCategory;
use PipelineDeals\Admin\PredefinedContactsTag\PipelineDeals_Admin_PredefinedContactsTag;
use PipelineDeals\Admin\DealStage\PipelineDeals_Admin_DealStage;
use PipelineDeals\Admin\LeadSource\PipelineDeals_Admin_LeadSource;
use PipelineDeals\Admin\LeadStatus\PipelineDeals_Admin_LeadStatus;
use PipelineDeals\Admin\EventCategory\PipelineDeals_Admin_EventCategory;
use PipelineDeals\Admin\User\PipelineDeals_Admin_User;

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
            }
            if (isset($admin_data['person_custom_field_labels'])) {
                foreach($admin_data['person_custom_field_labels'] as $label_data) {
                    $this->person_custom_field_labels[$label_data['id']] = null;
                    $d =& $this->person_custom_field_labels[$label_data['id']];
                    $d = new PipelineDeals_Admin_CustomFieldLabel($label_data);
                }
            }
            if (isset($admin_data['company_custom_field_labels'])) {
                foreach($admin_data['company_custom_field_labels'] as $label_data) {
                    $this->company_custom_field_labels[$label_data['id']] = null;
                    $d =& $this->company_custom_field_labels[$label_data['id']];
                    $d = new PipelineDeals_Admin_CustomFieldLabel($label_data);
                }
            }
            if (isset($admin_data['note_categories'])) {
                foreach($admin_data['note_categories'] as $category_data) {
                    $this->note_categories[$category_data['id']] = null;
                    $d =& $this->note_categories[$category_data['id']];
                    $d = new PipelineDeals_Admin_NoteCategory($category_data);
                }
            }
            if (isset($admin_data['predefined_contacts_tags'])) {
                foreach($admin_data['predefined_contacts_tags'] as $tag_data) {
                    $this->predefined_contacts_tags[$tag_data['id']] = null;
                    $d =& $this->predefined_contacts_tags[$tag_data['id']];
                    $d = new PipelineDeals_Admin_PredefinedContactsTag($tag_data);
                }
            }
            if (isset($admin_data['deal_stages'])) {
                foreach($admin_data['deal_stages'] as $stage_data) {
                    $this->deal_stages[$stage_data['id']] = null;
                    $d =& $this->deal_stages[$stage_data['id']];
                    $d = new PipelineDeals_Admin_DealStage($stage_data);
                }
            }
            if (isset($admin_data['lead_sources'])) {
                foreach($admin_data['lead_sources'] as $source_data) {
                    $this->lead_sources[$source_data['id']] = null;
                    $d =& $this->lead_sources[$source_data['id']];
                    $d = new PipelineDeals_Admin_LeadSource($source_data);
                }
            }
            if (isset($admin_data['lead_statuses'])) {
                foreach($admin_data['lead_statuses'] as $status_data) {
                    $this->lead_statuses[$status_data['id']] = null;
                    $d =& $this->lead_statuses[$status_data['id']];
                    $d = new PipelineDeals_Admin_LeadStatus($status_data);
                }
            }
            if (isset($admin_data['event_categories'])) {
                foreach($admin_data['event_categories'] as $category_data) {
                    $this->event_categories[$category_data['id']] = null;
                    $d =& $this->event_categories[$category_data['id']];
                    $d = new PipelineDeals_Admin_EventCategory($category_data);
                }
            }
            if (isset($admin_data['users'])) {
                foreach($admin_data['users'] as $user_data) {
                    $this->users[$user_data['id']] = null;
                    $d =& $this->users[$user_data['id']];
                    $d = new PipelineDeals_Admin_User($user_data);
                }
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
    public static function getInstance(PipelineDeals_Connection $pdc=null, $load_now=true) {
        if(!isset(self::$instance)) {
            self::$instance = new PipelineDeals_Admin_Account($pdc, $load_now);
        }
        return self::$instance;
    }

    /*
     * Private constructor called by the singleton getInstance method
     */
    private function __construct(PipelineDeals_Connection $pdc=null, $load_now=true)
    {
        if (is_null($pdc)) {
            $pdc = PipelineDeals_Connection::getConnection();
        }
        $this->pdc = $pdc;
        if ($load_now) {
            $this->executeResourceLoader();
        }
    }

}

