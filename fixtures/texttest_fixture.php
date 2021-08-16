<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use HtgPhpExercise\AccommodationRentalScore\RatingScorer;
use HtgPhpExercise\AccommodationRentalScore\RentalObject;

echo 'START!' . PHP_EOL;

$items = [
    new RentalObject('Citycenter Motel', 10, 20),
    new RentalObject('Vintage Villa', 2, 0),
    new RentalObject('Grandmas Apartment', 5, 7),
    new RentalObject('Highcorner Castle', 0, 80),
    new RentalObject('Highcorner Castle', -1, 80),
    new RentalObject('Fishermans Boat', 15, 20),
    new RentalObject('Fishermans Boat', 10, 49),
    new RentalObject('Fishermans Boat', 5, 49),
    // this last property of `Homestead` category does not work properly yet
    new RentalObject('Forest Cabin', 3, 6),
];

$app = new RatingScorer($items);

$days = 2;
if (count($argv) > 1) {
    $days = (int) $argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo "-------- day ${i} --------" . PHP_EOL;
    echo 'name, rateIn, score' . PHP_EOL;
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->updateScore();
}
