# Symfony Console Command

## Requirements

* Let's imagine we have a game two teams, each team have 5 players, every player have drain (level to measure player strength). Below given numbers in brackets represent drain of each players.
* Team A [35, 100, 20, 50, 40]
* Team B [35, 10, 30, 20, 90]

* You need to assign team A player in a way where it exceed team B player’s drain. Even if one player loses the battle then team A will not win.
* The solution for the above result will be
* Team A [40, 20, 35, 50, 100]
* Team B [35, 10, 30, 20, 90]

* Input: should be from console command to collect all the players data comma separated. Example console command should promote
* Enter A Teams players: 30, 100, 20, 50, 40
* Enter B team players: 35, 10, 30, 20, 90

* If A team can win than the output will be: Win
* If A team lose than the output will be: Lose


## Basic Expectations :
- Code should be clean and documented wherever necessary
- Proper coding standards (including principles like DRY, SOLID, YAGNI, KISS) are followed. Also PSR-12 is followed
- Symfony (LTS version) framework should be used and OOPs concepts are properly followed.
- PHPUnit tests are written
- ReadMe to be provided for the setup of the project.


## Technical Requirements
Before creating your first Symfony application you must:

* Install PHP 7.2.5 or higher and these PHP extensions (which are installed and enabled by default in most PHP 7 installations): Ctype, iconv, JSON, PCRE, Session, SimpleXML, and Tokenizer;
* Install Composer, which is used to install PHP packages.

## Installation
* > `git clone git@github.com:smtlab/symfony-test.git`
* > `cd symfony-test && composer install`

## Example Usage
* > `php bin/console app:play-game`
* > Enter A team players: 2,3,5,6,7
* > Enter B team players: 3,4,2,6,6
* > Lose

## Testing
* > `php bin/phpunit`