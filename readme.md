## Requirements

* PHP >= 7.2
    * OpenSSL PHP Extension
    * PDO PHP Extension
    * Mbstring PHP Extension
    * Tokenizer PHP Extension
    * XML PHP Extension
    * Ctype PHP Extension
    * JSON PHP Extension
    * BCMath PHP Extension
* [Composer](https://getcomposer.org/download/)
- NPM >= 6.4
- Node >= 10.15


## Installation
On project root directory run the following commands:

* `composer install`
* [Laravel configuration](https://laravel.com/docs/5.7/installation#configuration)
* `php artisan migrate`
* `npm install`
* `npm run production`
* to run local development server use `php artisan serve` 
## Sync Commands
 * `php artisan sync:structure [job-seeker|firm|job-opening|match]` leaving this empty will result to sync all cases structure
 * `php artisan sync:users` 
 * `php artisan sync:data {job-seeker|firm|job-opening|match}`
 * `php artisan sync:activities {job-seeker-monthly-followup|firm-monthly-followup}`
 
## Data Sync Priorities
 some cases must be synced before others due to relationship between these cases and it must be exists on the database to ensure data are appearing on system.
 
 * users
 * job-seeker
 * job-opening
 * match
 * activities
 
 