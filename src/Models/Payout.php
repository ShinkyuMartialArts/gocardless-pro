<?php namespace GoCardless\Pro\Models;

use GoCardless\Pro\Models\Abstracts\Entity;
use GoCardless\Pro\Models\Traits\Factory;

class Payout extends Entity
{
    use Factory;

    /** @var string */
    private $amount;

    /** @var string */
    private $currency;

    /** @var string */
    private $reference;

    /** @var string */
    private $status;

    /**
     * @return int
     */
    public function getAmount()
    {
        return intval($this->amount);
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $payout = array_filter(get_object_vars($this));

        return $payout;
    }


}