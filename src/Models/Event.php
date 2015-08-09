<?php namespace GoCardless\Pro\Models;

use GoCardless\Pro\Models\Abstracts\Entity;
use GoCardless\Pro\Models\Traits\Factory;
use GoCardless\Pro\Models\Traits\Metadata;

class Event extends Entity
{
    use Factory;
    use Metadata;

    /** @var string */
    private $action;

    /** @var string */
    private $details;

    /** @var string */
    private $resource_type;

    /** @var array */
    private $resources;

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @return string
     */
    public function getResourceType()
    {
        return $this->resource_type;
    }

    /**
     * @return array
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * @param array $resources
     * @return $this
     */
    public function setResources(array $resources)
    {
        $this->resources = $resources;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $event = array_filter(get_object_vars($this));

        if (!!$this->resources) {
            $event['resources'] = [];
            foreach ($this->resources as $name => $resource) {
                $event['resources'][$name] = $resource->toArray();
            }
        }

        return $event;
    }


}