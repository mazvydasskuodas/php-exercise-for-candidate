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

    public function updateScore(): void
    {
        foreach ($this->rentalObjects as $object) {
            if ($object->name !== 'Vintage Villa' and $object->name !== 'Fishermans Boat') {
                if ($object->score > 0) {
                    if ($object->name !== 'Highcorner Castle') {
                        $object->score = $object->score - 1;
                    }
                }
            } else {
                if ($object->score < 50) {
                    $object->score = $object->score + 1;
                    if ($object->name === 'Fishermans Boat') {
                        if ($object->rateIn < 11) {
                            if ($object->score < 50) {
                                $object->score = $object->score + 1;
                            }
                        }
                        if ($object->rateIn < 6) {
                            if ($object->score < 50) {
                                $object->score = $object->score + 1;
                            }
                        }
                    }
                }
            }

            if ($object->name !== 'Highcorner Castle') {
                $object->rateIn = $object->rateIn - 1;
            }

            if ($object->rateIn < 0) {
                if ($object->name !== 'Vintage Villa') {
                    if ($object->name !== 'Fishermans Boat') {
                        if ($object->score > 0) {
                            if ($object->name !== 'Highcorner Castle') {
                                $object->score = $object->score - 1;
                            }
                        }
                    } else {
                        $object->score = $object->score - $object->score;
                    }
                } else {
                    if ($object->score < 50) {
                        $object->score = $object->score + 1;
                    }
                }
            }
        }
    }
}
