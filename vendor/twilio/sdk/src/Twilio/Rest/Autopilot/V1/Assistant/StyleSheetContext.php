<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Autopilot\V1\Assistant;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class StyleSheetContext extends InstanceContext {
    /**
     * Initialize the StyleSheetContext
     *
     * @param Version $version Version that contains the resource
     * @param string $assistantSid The SID of the Assistant with the StyleSheet
     *                             resource to fetch
     */
    public function __construct(Version $version, $assistantSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['assistantSid' => $assistantSid, ];

        $this->uri = '/Assistants/' . \rawurlencode($assistantSid) . '/StyleSheet';
    }

    /**
     * Fetch the StyleSheetInstance
     *
     * @return StyleSheetInstance Fetched StyleSheetInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): StyleSheetInstance {
        $payload = $this->version->fetch('GET', $this->uri);

        return new StyleSheetInstance($this->version, $payload, $this->solution['assistantSid']);
    }

    /**
     * Update the StyleSheetInstance
     *
     * @param array|Options $options Optional Arguments
     * @return StyleSheetInstance Updated StyleSheetInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): StyleSheetInstance {
        $options = new Values($options);

        $data = Values::of(['StyleSheet' => Serialize::jsonObject($options['styleSheet']), ]);

        $payload = $this->version->update('POST', $this->uri, [], $data);

        return new StyleSheetInstance($this->version, $payload, $this->solution['assistantSid']);
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
        return '[Twilio.Autopilot.V1.StyleSheetContext ' . \implode(' ', $context) . ']';
    }
}