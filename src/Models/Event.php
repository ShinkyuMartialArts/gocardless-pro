<?php namespace GoCardless\Pro\Models;

use GoCardless\Pro\Models\Abstracts\Entity;
use GoCardless\Pro\Models\Traits\Factory;
use GoCardless\Pro\Models\Traits\Metadata;

class Event extends Entity
{
    use Factory;
    use Metadata;

    /** @var $string */
    private $action;

    private $details;

    private $resource_type;

    private $resources;

    public function getAction()
    {
        return $this->action;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function getResourceType()
    {
        return $this->resource_type;
    }

    public function getResources()
    {
        return $this->resources;
    }

    public function setResources(array $resources)
    {
        $this->resources = $resources;
        return $this;
    }

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