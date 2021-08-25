<?php

declare(strict_types=1);

namespace Tests;

use HtgPhpExercise\AccommodationRentalScore\RatingScorer;
use HtgPhpExercise\AccommodationRentalScore\RentalObject;
use PHPUnit\Framework\TestCase;

class RatingScorerTest extends TestCase
{

    private $days;

    public function setUp(): void
    {
        $file_name = "/usr/src/myapp/tests/approvals/ApprovalTest.testFixture.approved.txt";

        $rental_objects = [];
        $day = [];
        $properties = 9;

        $lines = [];
        try {
            $f = fopen($file_name, 'r');
            while (!feof($f)) {
                if ($properties == 0) {
                    $rental_objects[] = $day;
                    $day = [];
                    $properties = 9;
                }
                $line = fgets($f);
                $lines[] = $line;
                if (empty(trim($line)) || strpos($line, "name,") !== false || strpos($line, "day") !== false || strpos($line, "START!") !== false) {
                    continue;
                } else {
                    $day[] = $line;
                    $properties -= 1;
                }

            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        } finally {
            if ($f) {
                fclose($f);
            }
        }

        $this->days = $rental_objects;
    }

    public function testUpdateScore(): void
    {
        /*
        $objects = [new RentalObject('Awesome Apartment', 0, 0)];
        $priceCalculator = new RatingScorer($objects);
        $priceCalculator->updateScore();
        $this->assertSame('FixMe', $objects[0]->name);
        */

        for ($day = 0; $day < count($this->days) - 1; $day++) {
            $objects = [];
            foreach ($this->days[$day] as $property) {
                $parameters = explode(",", trim($property));
                $objects[] = new RentalObject($parameters[0], intval($parameters[1]), intval($parameters[2]));
            }
            
            $priceCalculator = new RatingScorer($objects);
            $priceCalculator->updateScore();
            for ($i = 0; $i < count($this->days[$day]); $i++) {
                $next_day = $this->days[$day + 1];
                $next_day_params = explode(",", $next_day[$i]);
                $this->assertSame(intval($next_day_params[2]), $objects[$i]->score);
            }
            
        }
    }
}
