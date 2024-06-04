# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Station postcode test for the JSON parser.
- Station ticket office closing times tests for the JSON parser.

### Fixed

- Parser: some stations have 5 line addresses with only three lines. If so, return a null value for the missing lines, as done previously if they only have four lines.
- Enabled the Doctrine annotation reader when validating, as not having it was causing the tests to fail since upgrading to Symfony 6.

## [0.4.0] - 2023-09-18

### Added

- Parser: add a `getPostcode()` method to easily get the postcode for a station.
- Parser: add a `getClosingTime()` method to get the ticket office closing time for a specified day.

## [0.3.2] - 2023-06-01

### Fixed

- Parser: Airport text is within `Interchange`.
- Parser: WiFi text is within `StationFacilities`.
- Parser: not all station addresses have five lines. If so, return a null value for the missing line.

## [0.3.1] - 2023-05-23

### Changed

- Serializer: re-order methods alphabetically.
- Serializer: use consistent snake-case variable names for properties.
- Serializer: remove setter methods and rely on the serializer.

## [0.3.0] - 2023-05-19

### Added

- Serializer: return the ATM machine location text.
- Serializer: return the WiFi text.
- Serializer: return the accessibility helpline text.
- Serializer: return the airport text.
- Serializer: return the customer service text.
- Serializer: return the cycle storage annotation and location text.
- Serializer: return the first class lounge text.
- Serializer: return the information services open text.
- Serializer: return the name and operator name for a single car park.
- Serializer: return the national key toilets text.
- Serializer: return the onward travel text.
- Serializer: return the postbox text.
- Serializer: return the rail replacement services text.
- Serializer: return the shops text.
- Serializer: return the smartcard comments text.
- Serializer: return the staff help available text.
- Serializer: return the station alert text.
- Serializer: return the station buffet text.
- Serializer: return the step free access text.
- Serializer: return the taxi rank text.
- Serializer: return the ticket gates text.
- Serializer: return the ticket office location text.
- Serializer: return the toilets location text.
- Serializer: return the waiting room open and location text.

### Changed

- Return a `StationAddress` data transfer object instead of an array.

### Fixed

- PHP 8.0 compatibility.

### Removed

- PHP 7.4 support.

## [0.2.0] - 2022-06-15

### Changed

- Parser: return a `StationCollection` instead of a generic array.

## [0.1.5] - 2022-06-14

### Fixed

- `getAssistedTravelText()` can return a string or null.

## [0.1.4] - 2022-06-14

### Changed

- Serializer: remove unneeded method call and argument.

## [0.1.3] - 2022-06-14

### Changed

- Allow for using Symfony 4 components.

## [0.1.2] - 2022-06-14

### Added

- Parser: validation for CRS codes and station names.
- Serializer: re-add the `StationSerializer`.

## [0.1.1] - 2022-06-09

### Changed

- Parser: extract an abstract feed parser.

### Removed

- Serializer: remove the `StationSerializer`.

[unreleased]: https://github.com/opdavies/national-rail-enquiries-feed-parser/compare/0.4.0...HEAD
[0.4.0]: https://github.com/opdavies/national-rail-enquiries-feed-parser/compare/0.3.2...0.4.0
[0.3.2]: https://github.com/opdavies/national-rail-enquiries-feed-parser/compare/0.3.1...0.3.2
[0.3.1]: https://github.com/opdavies/national-rail-enquiries-feed-parser/compare/0.3.0...0.3.1
[0.3.0]: https://github.com/opdavies/national-rail-enquiries-feed-parser/compare/0.2.0...0.3.1
[0.2.0]: https://github.com/opdavies/national-rail-enquiries-feed-parser/compare/0.1.5...0.2.0
[0.1.5]: https://github.com/opdavies/national-rail-enquiries-feed-parser/compare/0.1.4...0.1.5
[0.1.4]: https://github.com/opdavies/national-rail-enquiries-feed-parser/compare/0.1.3...0.1.4
[0.1.3]: https://github.com/opdavies/national-rail-enquiries-feed-parser/compare/0.1.2...0.1.3
[0.1.2]: https://github.com/opdavies/national-rail-enquiries-feed-parser/compare/0.1.1...0.1.2
[0.1.1]: https://github.com/opdavies/national-rail-enquiries-feed-parser/compare/0.1.0...0.1.1
[0.1.0]: https://github.com/opdavies/national-rail-enquiries-feed-parser/releases/tag/0.1.0
