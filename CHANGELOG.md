# Changelog

## [Unreleased](https://github.com/org/repo/compare/2.2.0...master)

## [2.2.0](https://github.com/org/repo/compare/2.1.1...2.2.0) - 2024-10-17

### Changed

- Slim down to be inline with Laravel 11 (#83)

## [2.1.1](https://github.com/org/repo/compare/2.1.0...2.1.1) - 2024-10-04

### Fixed

- Docker; disable modules without interaction (e99f44d)

## [2.1.0](https://github.com/org/repo/compare/2.0.0...2.1.0) - 2024-10-01

### Added

- Auto import styles from Rapidez composer packages (#80)

### Changed

- Sync with Laravel source (#74, #75, #77)
- Update Docker PHP and Magento versions (#76)
- Disable Magento_AdminAdobeImsTwoFactorAuth as well (#79)
- License change GPL-3.0 > GPL-3.0-or-later (ebb94c9)

## [2.0.0](https://github.com/org/repo/compare/1.0.0...2.0.0) - 2024-06-04

### Changed

- Laravel 11 and Rapidez v2 (#73)

## [1.0.0](https://github.com/org/repo/compare/0.6.0...1.0.0) - 2024-01-05

### Changed

- Rapidez v1 (a12da5c)
- Improve frontend (#51)

## [0.6.0](https://github.com/org/repo/compare/0.5.0...0.6.0) - 2023-08-30

### Added

- Laravel 10 support (6864552)
- Docker images
- Auto import all installed Rapidez packages and Vue files (#45)

### Changed

- Sync with Laravel source
- Moved the remote homepage images to the repo through the resizer (b44a373)
- Also load Vue components in directories automatically (#56)

### Fixed

- Ignore all JS and CSS files (c80eed9)

## [0.5.0](https://github.com/org/repo/compare/0.4.2...0.5.0) - 2022-12-16

### Changed

- Migrated from Laravel Mix to Vite (#35, 018c05c)
- Sync with Laravel source (e5ee248, #7, #8, #9, #10)
- Autoload dev core tests (a0c8411)
- Docker setup update (#36, #38)

## [0.4.2](https://github.com/org/repo/compare/0.4.1...0.4.2) - 2022-04-13

### Fixed

- Updated the Rapidez dependencies for Laravel 9 (392f3fe)

## [0.4.1](https://github.com/org/repo/compare/0.4.0...0.4.1) - 2022-04-13

### Fixed

- Removed the Sanctum config (685d4ec)

## [0.4.0](https://github.com/org/repo/compare/0.3.0...0.4.0) - 2022-04-11

### Changed

- Laravel 9 upgrade (c83e626, 15d595f)

## [0.3.0](https://github.com/org/repo/compare/0.2.0...0.3.0) - 2022-03-21

### Changed

- Sync with Laravel source (#4)
- Updated all Rapidez packages (3eba41c)

## [0.2.0](https://github.com/org/repo/compare/0.1.3...0.2.0) - 2022-01-13

### Added

- Stay in sync with the Laravel code (#2)

### Changed

- Sync with Laravel source (#3)
- Updated the `composer.json` with the latest changes from `laravel/laravel` (156e8d8)

### Fixed

- Possibility to run the workflow manually (803c88f)
- Schedule the indexation at midnight (276c7ac)
- Copy Laravel sources fix (f339baf)

## [0.1.3](https://github.com/org/repo/compare/0.1.2...0.1.3) - 2021-08-04

### Changed

- Changed the Rapidez packages version constraints (1d9d108)

## [0.1.2](https://github.com/org/repo/compare/0.1.1...0.1.2) - 2021-07-19

### Changed

- Updated rapidez/account (5399669)

## [0.1.1](https://github.com/org/repo/compare/0.1.0...0.1.1) - 2021-07-19

### Added

- Register the new account callbacks (321a8e8)

## [0.1.0](https://github.com/org/repo/compare/0.0.1...0.1.0) - 2021-06-30

Public beta release!

## [0.0.1](https://github.com/org/repo/compare/8a682db6476a7c60c0487375ee8708aaeed4ab15...0.0.1) - 2021-06-30

Experimental release
