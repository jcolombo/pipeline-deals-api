<?php
namespace PipelineDeals\EntityAbstract;

use PipelineDeals\BaseAbstract\PipelineDeals_BaseAbstract;
use PipelineDeals\Connection\PipelineDeals_Connection;

/**
 * Generic Abstract Handler Class that Method objects extend
 *
 * @author Joel Colombo
 */
abstract class PipelineDeals_EntityAbstract extends PipelineDeals_BaseAbstract {

    protected $id = null;
    protected $data = null;
    protected $object_key = null;

    /*
     * Load an entity object if an ID is passed, if not an empty instance of the entity is created
     */
    public function __construct($id = null, PipelineDeals_Connection $pdc = null)
    {
        $this->id = $id;

        if (is_null($pdc)) {
            $pdc = PipelineDeals_Connection::getConnection();
        }
        $this->pdc = $pdc;
        if (!is_null($id)) {
            $this->load();
        }
    }

    /*
     * Retrieve a property of the entity. To reference multi-dimensional elements, use a period (.) for depth
     */
    public function get($data_key)
    {
        $dkeys = explode('.', $data_key);
        $d = $this->data;
        $keycount = count($dkeys)-1;
        foreach ($dkeys as $i => $k) {
            if(is_array($d) && isset($d[$k])) {
                if ($i<$keycount) {
                    $d = $d[$k];
                } else {
                    return $d[$k];
                }
            } else {
                return null;
            }
        }
        return null;
    }

    /*
     * Takes in the raw entity array returned from the connection and populates the object
     */
    public function loadFromEntry($entry_data)
    {
        $this->id = $entry_data['id'];
        $this->data = $entry_data;
    }

    /*
     * Return a boolean true if there is data in the object
     */
    public function hasData()
    {
        if (is_null($this->data) || !is_array($this->data) || count($this->data)==0) {
            return false;
        }
        return true;
    }

    /*
     * Required method for all child objects to understand how to execute the connection request, path, etc
     */
    abstract public function load();

}
