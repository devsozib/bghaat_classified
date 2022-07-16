<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Conversations\V1\Service\Configuration;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string $accountSid
 * @property string $chatServiceSid
 * @property string $preWebhookUrl
 * @property string $postWebhookUrl
 * @property string[] $filters
 * @property string $method
 * @property string $url
 */
class WebhookInstance extends InstanceResource {
    /**
     * Initialize the WebhookInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $chatServiceSid The unique string that identifies the resource
     */
    public function __construct(Version $version, array $payload, string $chatServiceSid) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'chatServiceSid' => Values::array_get($payload, 'chat_service_sid'),
            'preWebhookUrl' => Values::array_get($payload, 'pre_webhook_url'),
            'postWebhookUrl' => Values::array_get($payload, 'post_webhook_url'),
            'filters' => Values::array_get($payload, 'filters'),
            'method' => Values::array_get($payload, 'method'),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['chatServiceSid' => $chatServiceSid, ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return WebhookContext Context for this WebhookInstance
     */
    protected function proxy(): WebhookContext {
        if (!$this->context) {
            $this->context = new WebhookContext($this->version, $this->solution['chatServiceSid']);
        }

        return $this->context;
    }

    /**
     * Update the WebhookInstance
     *
     * @param array|Options $options Optional Arguments
     * @return WebhookInstance Updated WebhookInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): WebhookInstance {
        return $this->proxy()->update($options);
    }

    /**
     * Fetch the WebhookInstance
     *
     * @return WebhookInstance Fetched WebhookInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): WebhookInstance {
        return $this->proxy()->fetch();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name) {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Conversations.V1.WebhookInstance ' . \implode(' ', $context) . ']';
    }
}