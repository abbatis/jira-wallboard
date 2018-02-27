### What is this repository for? ###

* Fetch JIRA issues and display them in a wallboard
* [Learn JIRA Rest](https://developer.atlassian.com/cloud/jira/platform/rest/)

### Main dependencies (included in composer) ###
* [Laravel > 5.4](https://laravel.com)
* [VueJS > 2.5](https://vuejs.org)
* PHP > 7.1
* [abbatis/laravel-jira-rest-client](https://github.com/abbatis/laravel-jira-rest-client) (fork of [rjvandoesburg/laravel-jira-rest-client](http://github.com/rjvandoesburg/laravel-jira-rest-client))

### How do I get set up? ###

* Create an empty database
* Set up `.env` file accordingly (`config/atlassian/jira.php`)
* Run `composer install`
* Run `php artisan key:generate`
* Run `php artisan migrate`
* Run `npm install`
* Run `npm build dev`

### Who do I talk to? ###

* Martijn Rijnja <martijn.r@me.com>
* Imad Kada <i.kada@me.com>