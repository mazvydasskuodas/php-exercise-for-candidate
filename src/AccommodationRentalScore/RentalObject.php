<?php

declare(strict_types=1);

namespace HtgPhpExercise\AccommodationRentalScore;

final class RentalObject
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $rateIn;

    /**
     * @var int
     */
    public $score;

    public function __construct(string $name, int $rateIn, int $score)
    {
        $this->name = $name;
        $this->rateIn = $rateIn;
        $this->score = $score;
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->rateIn}, {$this->score}";
    }
}
