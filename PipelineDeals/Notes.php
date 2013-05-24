<?php
namespace PipelineDeals\Notes;

use PipelineDeals\RequestAbstract\PipelineDeals_RequestAbstract;
use PipelineDeals\Note\PipelineDeals_Note;

use PipelineDeals\Company\PipelineDeals_Company;
use PipelineDeals\Person\PipelineDeals_Person;
use PipelineDeals\Deal\PipelineDeals_Deal;

/**
 * People Lookup API Calls
 *
 * @author Joel Colombo
 */
class PipelineDeals_Notes extends PipelineDeals_RequestAbstract
{
    protected $hydration_entity = 'PipelineDeals\Note\PipelineDeals_Note';
    protected $resource = 'notes';

    public function findByCompany($company_id, $person_id=null, $deal_id=null)
    {
        $this->clearPrimaryFilters();
        $this->setFilter('company_id', $company_id);
        if (!is_null($person_id)) {
            $this->setFilter('person_id', $person_id);
        }
        if (!is_null($deal_id)) {
            $this->setFilter('deal_id', $deal_id);
        }
        return $this->find();
    }

    public function findByPerson($person_id, $deal_id=null)
    {
        $this->clearPrimaryFilters();
        $this->setFilter('person_id', $person_id);
        if (!is_null($deal_id)) {
            $this->setFilter('deal_id', $deal_id);
        }
        return $this->find();
    }

    public function findByDeal($deal_id)
    {
        $this->clearPrimaryFilters();
        $this->setFilter('deal_id', $deal_id);
        return $this->find();
    }

    /*
     * Overload default find method to insure at least one entity is being filtered on
     */
    public function find()
    {
        $hc = $this->hasFilter('company_id');
        $hp = $this->hasFilter('person_id');
        $hd = $this->hasFilter('deal_id');
        if ($hc || $hp || $hd) {
            return parent::find();
        }
        return false;
    }

    protected function clearPrimaryFilters()
    {
        $this->removeFilter('company_id');
        $this->removeFilter('person_id');
        $this->removeFilter('deal_id');
    }

}

