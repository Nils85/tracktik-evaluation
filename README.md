# TrackTik evaluation

Challenge for the PHP position.

## How to test?

You can test this project interactively or with unit testing.  
The only requirement is to have PHP 7.1 or newer.

### Command Line Interface

You can directly try this project in an interactive shell with PHP CLI:

`php cli.php`

### PHPUnit

Download PHPUnit: https://phar.phpunit.de/phpunit-7.phar  
Move it at the root of the project directory and open a terminal.  
Then type:

`php phpunit-7.5.20.phar test/ElectronicItemsTest.php` To test a specific class  
or  
`php phpunit-7.5.20.phar tests` To test the whole project

The scenario o fthe question 1 is tested in ElectronicItemsTest.php