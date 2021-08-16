# HomeToGo PHP Refactoring Exercise - AccommodationRentalScore

## Intro

As you may already know, HomeToGo allows you to book the finest Accommodation Rentals out there for your dream stay.
This is HomeToGo's exercise for Accommodation Rental Rating score calculation in PHP.

#### Some Terminology

- `Property` or `RentalObject` is an accommodation rental object in our inventory (e.g. apartment) that can be rented
to a customer. The inventory is provided by one of our suppliers (partners).
- `Score` is a rating value assigned to the property that indicates how attractive the property is.

### Requirements & specifications

Consider the following scenario. We have a system in place that has a knowledge of the inventory provided by our 
partners. Each property has a dynamic rating score that indicates how good the property is
and this information can be used in various contexts (e.g. when calculating the rental object's nightly price).
To simulate the dynamic lifecycle of the score this exercise assumes that the properties degrade in rating score
as hey approach the inspection (rating) day.

The exercise has the `RatingScorer` class which represents the system that updates our inventory.
Your task is to add the new feature to our system so that
we can begin renting a new category of properties. Here is an introduction to our system:

	- All properties have a 'rateIn' value which denotes the number of days we have to rate the property;
	- All properties have a 'score' value which denotes how attractive the property is;
	- At the end of each day our system lowers both values for every property.

Sounds pretty simple so far? Well this is where it gets more interesting:
	
```
- Once the rate by date has passed, 'score' degrades twice as fast;
- The 'score' of a property is never negative;
- "Vintage Villa" actually increases in 'score' the older it gets;
- The 'score' of a property is never higher than 50;
- "Highcorner Castle", being a unique property, never has to be rated or decreases in 'score';
- "Sailors boat" also increases in 'score' as its 'rateIn' value approaches;
Additionally 'score' increases by 2 when there are 10 days or less and by 3 when there are 5 days or less but
'score' drops to 0 after the inspection day.
```
We have recently signed a supplier of homestead category of properties. This requires an update to our system:

	- "Homestead" properties degrade in 'score' twice as fast as normal properties.

Feel free to make any changes to the `updateScore` method and add any new code as long as everything
still works correctly. However, do not alter the `RentalObject` class or `rentalObjects` property as those are the core
of the functionality (you can make the `updateScore` method and `RentalObject` property static if you like).

Just for clarification, a property can never have its `score` increase above 50, however "Highcorner Castle" is an
exceptional one and its `score` is 80, and it never changes.

## Installation

The exercise uses:

- [PHP 7.3 or 7.4 or 8.0+](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org)

Recommended:

- [Git](https://git-scm.com/downloads)

Clone the repository

```sh
git clone git@github.com: # TODO
```

or

```shell script
git clone https://github.com/ #TODO
```

Install all the dependencies using composer

```shell script
cd ./HtgPhpExercise
composer install
```

## Dependencies

The project uses composer to install:

- [PHPUnit](https://phpunit.de/)
- [ApprovalTests.PHP](https://github.com/approvals/ApprovalTests.php)
- [PHPStan](https://github.com/phpstan/phpstan)
- [Easy Coding Standard (ECS)](https://github.com/symplify/easy-coding-standard)
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/wiki)

## Code structure

- `src/RatingScore` - contains the two classes:
    - `RentalObject.php` - this class should not be changed
    - `RatingScorer.php` - this class needs to be refactored, and the new feature added
- `tests` - contains the tests
    - `RatingScorerTest.php` - starter test.
        - Tip: ApprovalTests has been included as a dev dependency. For more info [PHP Approval Tests](https://github.com/approvals/ApprovalTests.php)
- `Fixture`
    - `texttest_fixture.php` this could be used by an ApprovalTests, or run from the command line (e.g. `php fixtures/texttest_fixture.php 30` )

## Testing

PHPUnit is configured for testing, a composer script has been provided. To run the unit tests, from the root of the PHP
project run:

```shell script
composer test
```

A Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias pu="composer test"`), the same
PHPUnit `composer test` can be run:

```shell script
pu
```

### Tests with Coverage Report

To run all test and generate a html coverage report run:

```shell script
composer test-coverage
```

The test-coverage report will be created in /builds, it is best viewed by opening /builds/**index.html** in your
browser.

## Code Standard

Easy Coding Standard (ECS) is configured for style and code standards, **PSR-12** is used. The current code is not upto
standard!

### Check Code

To check code, but not fix errors:

```shell script
composer check-cs
``` 

On Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias cc="composer check-cs"`), the same
PHPUnit `composer check-cs` can be run:

```shell script
cc
```

### Fix Code

ECS provides may code fixes, automatically, if advised to run --fix, the following script can be run:

```shell script
composer fix-cs
```

On Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias fc="composer fix-cs"`), the same
PHPUnit `composer fix-cs` can be run:

```shell script
fc
```

## Static Analysis

PHPStan is used to run static analysis checks:

```shell script
composer phpstan
```

On Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias ps="composer phpstan"`), the same
PHPUnit `composer phpstan` can be run:

```shell script
ps
```

**Good luck**!
