## Poweradmin 3

[![Build Status](https://travis-ci.org/BlueManLine/poweradmin3.svg)](https://travis-ci.org/BlueManLine/poweradmin3) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/BlueManLine/poweradmin3/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/BlueManLine/poweradmin3/?branch=master)

Poweradmin 3 is a web-based DNS administration tool for PowerDNS server.
This is highly experimental branch to check feasibility of Laravel framework for the core of new version of Poweradmin.

## System Requirements

  - PHP >= 5.4
  - MCrypt PHP Extension

## Installation

After `git clone` & `composer install` command please do the following:

 1. Copy `bootstrap/environment.php.default` to `bootstrap/environment.php`
 2. Under `app/config/local/` directory you can copy and modify any config file (from `app/config/` you want. For basic setup just database.php is required to pass an DB credentials.
 - dev's should also copy `app.php` config file to enable debug mode and uncomment addition providers.
 3. Run the `php artisan migrate` command to setup Poweradmin3 database structure.

Remember that the Poweradmin3 must be installed/configured under existing powerdns database!

#### Credentials
Default admin account is:

- login: admin
- pass: admin

### License

The Poweradmin 3 is open-sourced software licensed under the [GPL-3.0 license](http://opensource.org/licenses/GPL-3.0)

