<?php
namespace PipelineDeals\RequestAbstract;

use PipelineDeals\BaseAbstract\PipelineDeals_BaseAbstract;
use PipelineDeals\Connection\PipelineDeals_Connection;

/**
 * Generic Abstract Handler Class that Method objects extend
 *
 * @author Joel Colombo
 */
abstract class PipelineDeals_RequestAbstract extends PipelineDeals_BaseAbstract {

    protected $hydration_entity = null;
    protected $resource = null;

    protected $total_entries = null;
    protected $total_pages = null;
    protected $current_page = null;
    protected $current_per_page = null;
    protected $current_page_var = null;

    protected $filters = array();


    protected $entries = null;

    /*
     * Create a new instance of search request object
     */
    public function __construct(PipelineDeals_Connection $pdc = null)
    {
        if (is_null($pdc)) {
            $pdc = PipelineDeals_Connection::getConnection();
        }
        $this->pdc = $pdc;
    }

    /*
     * How many search results should come back per page. 200 is the default
     */
    public function setPerPage($per_page)
    {
        $this->filters['per_page'] = $per_page;
    }

    /*
     * Which page of results should be returned. Page 1 is the default
     */
    public function setPage($page)
    {
        $this->filters['page'] = $page;
    }

    /*
     * Use on datetime ranged "conditions" from the documentation.
     *
     * @param $key the conditional key to filter on (must be a field of type datetime range)
     * @param $from the earliest date to include in results. Format YYYY-MM-DD or YYYY-MM-DD HH:MM:SS
     * @param $to the latest date to include in results. Format YYYY-MM-DD or YYYY-MM-DD HH:MM:SS
     */
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

    /*
     * The filter condition and value requirement from the API documentation
     */
    public function setCondition($key, $value)
    {
        if (!isset($this->filters['conditions']) || !is_array($this->filters['conditions'])) {
            $this->filters['conditions'] = array();
        }
        $key = str_replace('.', '][', $key);
        $this->filters['conditions'][$key] = $value;
    }

    /*
     * Manually set a root level filter for the query
     */
    public function setFilter($key, $value)
    {
        $this->filters[$key] = $value;
    }

    /*
     * Clear an already set filter entry
     */
    public function removeFilter($key)
    {
        if(isset($this->filters[$key])) {
            unset($this->filters[$key]);
        }
    }

    /*
     * Check if a filter is set.
     *
     * @param $key The filter key to check for
     * @param $return_value If set to true, returns the actual filter value instead of a boolean
     * @param $not_empty_required If true, the filter value must not be "empty" (The integer 0 is considered valid)
     */
    public function hasFilter($key, $return_value=false, $not_empty_required=false)
    {
        if (isset($this->filters[$key])) {
            if (!$not_empty_required || ($not_empty_required && $this->filters[$key]!='' && !is_null($this->filters[$key]))) {
                return ($return_value)?$this->filters[$key]:true;
            }
            return null;
        }
        return null;
    }

    /*
     * Execute the search and populate the entries property with instances of the proper entity object
     */
    public function find()
    {
        if (is_null($this->resource) || is_null($this->hydration_entity)) {
            die('FIND method cannot be executed without a defined resource and hydration entity.');
        }
        $this->hydrate($this->pdc->executeRequest($this->resource, 'get', $this->filters, $this->getAttributes()), $this->hydration_entity);
        return $this->entries;
    }

    /*
     * Execute the search and only return the total number of results found
     */
    public function count()
    {
        if (is_null($this->resource) || is_null($this->hydration_entity)) {
            die('FIND method cannot be executed without a defined resource and hydration entity.');
        }
        $e = $this->pdc->executeRequest($this->resource, 'get', $this->filters, array('id'));
        $count = null;
        if (isset($e['pagination'])) {
            $count = $e['pagination']['total'];
        }
        return $count;
    }

    /*
     * Populate the entries property with the proper entity type objects from the raw search results
     */
    protected function hydrate($result_set, $entity_type=null)
    {
        if (is_null($result_set)) { return; }
        if (isset($result_set['pagination'])) {
            $this->total_entries = $result_set['pagination']['total'];
            $this->current_per_page = $result_set['pagination']['per_page'];
            $this->current_page = $result_set['pagination']['page'];
            $this->total_pages = $result_set['pagination']['pages'];
            $this->current_page_var = $result_set['pagination']['page_var'];
        }
        if (is_null($entity_type)) {
            $this->entries = $result_set['entries'];
        }
        $entries =& $result_set['entries'];
        foreach ($entries as $i => $data) {
            $id = $data['id'];
            $this->entries[$id] = new $entity_type();
            $this->entries[$id]->loadFromEntry($data);
        }
    }

}
