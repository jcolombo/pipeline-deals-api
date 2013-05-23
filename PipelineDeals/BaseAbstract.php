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

    /*
     * fetch the list of attributes that will come back in a request or entity retreival call. If empty, all attributes are returned
     */
    public function getAttributes()
    {
        return array_keys($this->attributes);
    }

    /*
     * Takes an array of attributes from the API documentation to return for this request or entity pull
     */
    public function includeAttributes($attrib_list)
    {
        foreach($attrib_list as $i => $attrib) {
            $this->includeAttribute($attrib);
        }
    }

    /*
     * Adds a single attribute to the list of attributes pulled back from this request
     */
    public function includeAttribute($attrib)
    {
        $this->attributes[$attrib] = true;
    }

    /*
     * Remove an array attributes from the list that was already added. Cannot be used on attributes not allready "included" by the object
     */
    public function removeAttributes($attrib_list)
    {
        foreach($attrib_list as $i => $attrib) {
            $this->removeAttribute($attrib);
        }
    }

    /*
     * Remove a single attribute from the array of already "included" attributes
     */
    public function removeAttribute($attrib)
    {
        unset($this->attributes[$attrib]);
    }

    /*
     * Clear all included attributes, this essentially tells the object to select all again.
     */
    public function clearAttributes()
    {
        $this->attributes = array();
    }

}
