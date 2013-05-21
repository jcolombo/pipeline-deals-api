<?php
namespace PipelineDeals\RequestAbstract;

use PipelineDeals\Connection\PipelineDeals_Connection;

/**
 * Generic Abstract Handler Class that Method objects extend
 *
 * @author Joel Colombo
 */
abstract class PipelineDeals_RequestAbstract {

    protected $pdc = null;
    protected $entries = null;

    protected $filters = array();

    public function __construct(PipelineDeals_Connection $pdc = null)
    {
        if (is_null($pdc)) {
            $pdc = PipelineDeals_Connection::getConnection();
        }
        $this->pdc = $pdc;
    }

    public function setPerPage($per_page)
    {
        $this->filters['per_page'] = $per_page;
    }

    public function setPage($page)
    {
        $this->filters['page'] = $page;
    }

    public function setConditionRange($key, $from=null, $to=null)
    {
        if (!isset($this->filters['conditions']) || !is_array($this->filters['conditions'])) {
            $this->filters['conditions'] = array();
        }
        if (is_null($from) && is_null($to)) {
            return false;
        }
        if (!is_null($from)) {
            $k1 = $key."][from_date";
            $this->filters['conditions'][$k1] = $from;
        }
        if (!is_null($to)) {
            $k2 = $key."][to_date";
            $this->filters['conditions'][$k2] = $to;
        }
    }

    public function setCondition($key, $value)
    {
        if (!isset($this->filters['conditions']) || !is_array($this->filters['conditions'])) {
            $this->filters['conditions'] = array();
        }
        $key = str_replace('.', '][', $key);
        $this->filters['conditions'][$key] = $value;
    }

    protected function hydrate($result_set, $entity_type)
    {
        if (is_null($result_set)) { return; }
        $entries =& $result_set['entries'];
        foreach ($entries as $i => $data) {
            $id = $data['id'];
            $this->entries[$id] = new $entity_type();
            $this->entries[$id]->loadFromEntry($data);
        }
    }

}
