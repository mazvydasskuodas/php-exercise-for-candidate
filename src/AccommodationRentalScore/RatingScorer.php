<?php

declare(strict_types=1);

namespace HtgPhpExercise\AccommodationRentalScore;

final class RatingScorer
{
    /**
     * @var RentalObject[]
     */
    private $rentalObjects;

    /**
     * PriceCalculator constructor.
     * @param RentalObject[] $rentalObjects
     */
    public function __construct(array $rentalObjects)
    {
        $this->rentalObjects = $rentalObjects;
    }

    /** 
     * Degrades score normally.
     * 
     * @param RentalObject $object
     */
    private function normalStrategy(RentalObject $object): void
    {
        /*
            Scores are degraded by 1 each day and as well as rate In.
            Once the rateIn day clicks, we start degrading score by 2
            Score of a property is never 50 and never negative. 
        */
        if ($object->rateIn <= 0){
            // degrade twice
            $object->score -= 2;
        } else {
            $object->score -= 1;
        }

        if ($object->score < 0) $object->score = 0;
    }

    /**
     * Increases the score value.
     * 
     * @param RentalObject $object
     */
    private function reverseStrategy(RentalObject $object): void
    {
        if ($object->rateIn <= 0) {
            $object->score += 2;
        } else {
            $object->score += 1;
        }

        if ($object->score > 50) $object->score = 50;
    }

    /**
     * Increases the score with extra condition.
     * 
     * @param RentalObject $object
     */
    private function reverseWithTwistStrategy(RentalObject $object): void
    {
        /* 
            If rateIn is 10 days away, increase by 2. 
            If rateIn is 5 days away increase by 3.
            If rateIn is  0 score goes to zero.
        */
        if ($object->rateIn < 6) {
            $object->score += 3;
        } else if ($object->rateIn < 11) {
            $object->score += 2;
        } else {
            $object->score += 1;
        }

        if($object->rateIn <= 0) $object->score = 0;

        if($object->score > 50) $object->score = 50;
    }

    /**
     * Keeps score constant and ensures its not more than 80.
     * 
     * @param RentalObject $object
     */
    private function stationaryStrategy(RentalObject $object): void
    {
        
        if ($object->score > 80) $object->score = 80;
    }

    public function updateScore(): void
    {

        foreach ($this->rentalObjects as $object) {

            if ($object->name === 'Highcorner Castle') {
                $this->stationaryStrategy($object);
            } else if ($object->name === 'Vintage Villa') {
                $this->reverseStrategy($object);
            } else if ($object->name === 'Sailors boat' || $object->name === 'Fishermans Boat') {
                $this->reverseWithTwistStrategy($object);
            } else if ($object->name === 'Homestead' /*|| $object->name == "Forest Cabin"*/) {
                $this->normalStrategy($object);
                $this->normalStrategy($object);
            } else {
                $this->normalStrategy($object);
            }

        }

        // update RateIn
        $object->rateIn -= 1;
    }
}
