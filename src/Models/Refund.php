<?php namespace GoCardless\Pro\Models;

use GoCardless\Pro\Models\Abstracts\Entity;
use GoCardless\Pro\Models\Traits\Factory;
use GoCardless\Pro\Models\Traits\Metadata;

class Refund extends Entity
{
    use Factory;
    use Metadata;

    /** @var string */
    private $amount;
    /** @var string */
    private $total_amount_confirmation;
    /** @var string */
    private $currency;
    /** @var Payment */
    private $payment;

    /**
     * @param Payment|null $payment
     * @param int $amount
     */
    public function __construct(Payment $payment = null, $amount = 0)
    {
        if ($payment !== null) {
            $this->setPayment($payment);
        }

        if ($amount) {
            $this->setAmount($amount);
        }

        if ($payment !== null && $amount) {
            $this->setTotalAmountConfirmation(
                $payment->getAmountRefunded() + $this->getAmount()
            );
        }
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = intval($amount);
        return $this;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setTotalAmountConfirmation($amount)
    {
        $this->total_amount_confirmation = intval($amount);
        return $this;
    }

    /**
     * @param Payment $payment
     * @return $this
     */
    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    public function toArrayForUpdating()
    {
        return [
            'metadata' => $this->getMetadata()
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $refund = array_filter(get_object_vars($this));

        if ($this->payment instanceof Payment) {
            unset($refund['payment']);
            $refund['links']['payment'] = $this->payment->getId();
        }

        return $refund;
    }
}