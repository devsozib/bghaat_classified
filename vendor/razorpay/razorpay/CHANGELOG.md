# Change Log

Changelog for Razorpay-PHP SDK. Follows [keepachangelog.com](http://keepachangelog.com/en/0.3.0/) for formatting.

## [2.0.0] - 2017-03-07
### Added
- Support for custom Application header
- Support for card entity
- Support for Webhook and Order Signature verification
- Support for direct refund creation via Razorpay\Api\Refund::create()
- Support for Utility functions via Razorpay\Api\Utility::verifyPaymentSignature and Razorpay\Api\Utility::verifyWebhookSignature
- Support for case insensitive error codes
- Support for 2xx HTTP status codes

### Changed
- Razorpay\Api\Payment::refunds() now returns a Razorpay\Api\Collection object instead of Razorpay\Api\Refund object
- Razorpay\Api\Api::$baseUrl, Razorpay\Api\Api::$key and Razorpay\Api\Api::$secret are now `protected` instead of `public`


## [1.2.9] - 2017-01-03
### Added
- Support for creating and fetching Invoices

## [1.2.8] - 2016-10-12
### Added
- Support for Customer and Token entities

## [1.2.7] - 2016-09-21
### Added
- Increases the request timeout to 30 seconds for all requests.

## [1.2.6] - 2016-03-28
### Added
- Adds better tracing when client is not able to recognize server response.

## [1.2.5] - 2016-03-28
### Added
- Add support for overriding request headers via setHeader

## [1.2.3] - 2016-02-24
### Added
- Add support for Orders

## [1.2.2] - 2016-02-17
### Changed
- Razorpay\Api\Request::checkErrors is now `protected` instead of `private`
- The final build is now leaner and includes just requests, instead of entire vendor directory

## [1.2.1] - 2016-01-21
### Added
- Add version.txt in release with current git tag
- This changelog file
- `Api\Request::getHeaders()` method

## [1.2.0] - 2015-10-23
### Added
- Add version string to User Agent
### Changed
- New release process that pushes pre-packaged zip files to GitHub

## [1.0.0] - 2015-01-18
### Added
- Initial Release


[Unreleased]: https://github.com/razorpay/razorpay-php/compare/2.0.0...HEAD
[1.2.1]: https://github.com/razorpay/razorpay-php/compare/1.2.0...1.2.1
[1.2.0]: https://github.com/razorpay/razorpay-php/compare/1.1.0...1.2.0
[1.2.2]: https://github.com/razorpay/razorpay-php/compare/1.2.1...1.2.2
[1.2.3]: https://github.com/razorpay/razorpay-php/compare/1.2.2...1.2.3
[1.2.4]: https://github.com/razorpay/razorpay-php/compare/1.2.3...1.2.5
[1.2.6]: https://github.com/razorpay/razorpay-php/compare/1.2.5...1.2.6
[1.2.7]: https://github.com/razorpay/razorpay-php/compare/1.2.6...1.2.7
[1.2.8]: https://github.com/razorpay/razorpay-php/compare/1.2.7...1.2.8
[1.2.9]: https://github.com/razorpay/razorpay-php/compare/1.2.8...1.2.9
[2.0.0]: https://github.com/razorpay/razorpay-php/compare/1.2.9...2.0.0
