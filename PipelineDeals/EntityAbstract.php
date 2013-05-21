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

    public function loadFromEntry($entry_data)
    {
        $this->id = $entry_data['id'];
        $this->data = $entry_data;
    }

    abstract public function load();

}
