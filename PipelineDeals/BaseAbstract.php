<?php
namespace PipelineDeals\BaseAbstract;

/**
 * Description of BaseAbstract
 *
 * @author Joel Colombo
 */
class PipelineDeals_BaseAbstract {

    protected $pdc = null;

    protected $attributes = array();

    public function getAttributes()
    {
        return array_keys($this->attributes);
    }

    public function includeAttributes($attrib_list)
    {
        foreach($attrib_list as $i => $attrib) {
            $this->includeAttribute($attrib);
        }
    }

    public function includeAttribute($attrib)
    {
        $this->attributes[$attrib] = true;
    }

    public function removeAttributes($attrib_list)
    {
        foreach($attrib_list as $i => $attrib) {
            $this->removeAttribute($attrib);
        }
    }

    public function removeAttribute($attrib)
    {
        unset($this->attributes[$attrib]);
    }

    public function clearAttributes()
    {
        $this->attributes = array();
    }

}
