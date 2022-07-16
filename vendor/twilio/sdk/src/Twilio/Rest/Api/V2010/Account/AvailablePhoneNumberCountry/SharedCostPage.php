<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountry;

use Twilio\Http\Response;
use Twilio\Page;
use Twilio\Version;

class SharedCostPage extends Page {
    /**
     * @param Version $version Version that contains the resource
     * @param Response $response Response from the API
     * @param array $solution The context solution
     */
    public function __construct(Version $version, Response $response, array $solution) {
        parent::__construct($version, $response);

        // Path Solution
        $this->solution = $solution;
    }

    /**
     * @param array $payload Payload response from the API
     * @return SharedCostInstance \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountry\SharedCostInstance
     */
    public function buildInstance(array $payload): SharedCostInstance {
        return new SharedCostInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['countryCode']
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Api.V2010.SharedCostPage]';
    }
}