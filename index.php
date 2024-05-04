<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

$parkFilter = isset($_GET['park-filter']) && $_GET['park-filter'] === 'on' ? true : false;
$voteFilter = isset($_GET['vote']) ? intval($_GET['vote']) : 0;

$filteredHotels = $hotels;

if ($parkFilter) {
    $hotelsWithParking = [];
    foreach ($filteredHotels as $hotel) {
        if ($hotel['parking'] === true) {
            $hotelsWithParking[] = $hotel;
        }
    }
    $filteredHotels = $hotelsWithParking;
}

if ($voteFilter > 0) {
    $hotelsVoteFiltered = [];
    foreach ($filteredHotels as $hotel) {
        if ($hotel['vote'] >= $voteFilter) {
            $hotelsVoteFiltered[] = $hotel;
        }
    }
    $filteredHotels = $hotelsVoteFiltered;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <h1 class="mt text-center m-3">Hotels</h1>

        <form method="GET" class="ms-3">
            <div class="mb-3 form-check">
                <label class="form-check-label" for="park-filter">Parking</label>
                <input class="form-check-input" <?php echo $parkFilter ? 'checked' : ''; ?> type="checkbox" id="park-filter" name="park-filter">
            </div>
            <div class="w-25">
                <label class="mb-2">Rating Filter</label>
                <select aria-placeholder="Rating Filter" class="form-select w-50" name="vote">
                    <option <?php echo $voteFilter === 0 ? 'selected' : '' ?> value="0">All</option>
                    <option <?php echo $voteFilter === 1 ? 'selected' : '' ?> value="1">At least 1</option>
                    <option <?php echo $voteFilter === 2 ? 'selected' : '' ?> value="2">At least 2</option>
                    <option <?php echo $voteFilter === 3 ? 'selected' : '' ?> value="3">At least 3</option>
                    <option <?php echo $voteFilter === 4 ? 'selected' : '' ?> value="4">At least 4</option>
                    <option <?php echo $voteFilter === 5 ? 'selected' : '' ?> value="5">5</option>
                </select>
            </div>
            <button class="btn btn-primary d-block mt-4" type="submit">Done</button>
        </form>

        <table class="table text-center mt-5">
            <thead>
                <tr>
                    <?php foreach ($hotels as $hotel) ?>
                    <?php foreach ($hotel as $key => $value) { ?>
                        <th><?php echo $key ?></th>
                    <?php } ?>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($filteredHotels as $hotel) { ?>
                    <tr>
                        <?php foreach ($hotel as $value) { ?>
                            <td><?php echo $value ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

</body>

</html>