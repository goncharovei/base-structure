# base-structure
Simple structure of PHP project

## How to use 

### Console

Execute command<br>
`php console`

See details here [The Console Symfony](https://symfony.com/doc/current/components/console.html#learn-more).

### Settings

Environment variables and configurations are supported.

Environment variables are in the ".env" file.<br>
Configuration is in the "config" folder.

### Query Builder

It is accessible globally through a static DB Instance.<br>
See details here [Using Illuminate Database](https://laravel.com/docs/11.x/queries).

### Mail Sender

Available via the "mailer" helper function.<br>
See details here [Using PHPMailer](https://github.com/PHPMailer/PHPMailer/tree/master/examples).

### Log

Available via the "logger" helper function.<br>
See details here [Using Monolog](https://github.com/Seldaek/monolog/blob/main/doc/01-usage.md).

### Tests
Execute command<br>
`php vendor/bin/phpunit --testsuite Unit --testdox --testdox-summary`

See details here [The Command-Line Test Runner](https://docs.phpunit.de/en/11.5/textui.html).

### PHPStan
Execute command<br>
`vendor/bin/phpstan analyse app`

See details here [Command Line Usage](https://phpstan.org/user-guide/command-line-usage).
