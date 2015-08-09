<?php namespace GoCardless\Pro;

use GoCardless\Pro\Models\Event;

class Webhook
{
    /** @var  string */
    protected $secret;

    /** @var  string */
    protected $body;

    /**
     * @param $secret
     * @param $body
     */
    public function __construct($secret, $body)
    {
        $this->secret = $secret;
        $this->body = $body;
    }

    /**
     * @param $signature
     * @return bool
     */
    public function verify($signature)
    {
        return $signature === hash_hmac('sha256', $this->body, $this->secret);
    }

    /**
     * @return array
     */
    public function events()
    {
        $events = [];
        $webhookEvents = json_decode($this->body, true);

        foreach ($webhookEvents['events'] as $event) {
            $events[] = Event::fromArray($event);
        }

        return $events;
    }

}