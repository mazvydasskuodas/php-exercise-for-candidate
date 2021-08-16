<?php

declare(strict_types=1);

namespace Tests;

use HtgPhpExercise\AccommodationRentalScore\RatingScorer;
use HtgPhpExercise\AccommodationRentalScore\RentalObject;
use PHPUnit\Framework\TestCase;

class RatingScorerTest extends TestCase
{
    public function testUpdateScore(): void
    {
        $objects = [new RentalObject('Awesome Apartment', 0, 0)];
        $priceCalculator = new RatingScorer($objects);
        $priceCalculator->updateScore();
        $this->assertSame('FixMe', $objects[0]->name);
    }
}
