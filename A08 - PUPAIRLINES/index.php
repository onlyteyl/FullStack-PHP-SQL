<?php
include("connect.php");

$airlinenameFilter = $_GET["airlinenameFilter"] ?? "";
$sortTable = $_GET["sortTable"] ?? "";
$orderTable = $_GET["orderTable"] ?? "";

$flightLogsQuery = "SELECT * FROM flightlogs";

if ($airlinenameFilter != "") {
    $flightLogsQuery .= " WHERE airlineName = '$airlinenameFilter'";
}


if ($sortTable != "") {
    $flightLogsQuery .= " ORDER BY $sortTable";


    if ($orderTable != "") {
        $flightLogsQuery .= " $orderTable";
    }
}


$flightLogsResults = executeQuery($flightLogsQuery);


$airlinequery = "SELECT DISTINCT(airlineName) FROM flightlogs";
$airlineResult = executeQuery($airlinequery);
?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body data-bs-theme="dark">
    <div class="container-fluid p-0">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid d-flex justify-content-center nav-brand">
                PUP AIRLINES
            </div>
        </nav>
    </div>
<div class="container">
    <div class="row my-5">
        <div class="col">
            <form method="GET">
                <div class="card p-4 rounded-5 shadow">
                    <div class="h6 mb-4">Filter</div>

                    <div class="d-flex flex-wrap gap-3">

                        <!-- AirlineName -->
                        <div class="d-flex flex-column">
                            <label for="AirNameSelect" class="filter-label">Airline Name</label>
                            <select id="AirNameSelect" name="airlinenameFilter" class="form-control">
                                <option value="">Any</option>
                                <?php
                                if (mysqli_num_rows($airlineResult) > 0) {
                                    while ($airlineRow = mysqli_fetch_array($airlineResult)) {
                                        ?>
                                        <option <?php if ($airlinenameFilter == $airlineRow["airlineName"])
                                            echo "selected" ?>
                                                value="<?php echo $airlineRow["airlineName"] ?>">
                                            <?php echo $airlineRow["airlineName"] ?>
                                        </option>
                                        <?php
                                    }
                                } ?>
                            </select>
                        </div>

                        <!-- Sort by -->
                        <div class="d-flex flex-column">
                            <label for="sort" class="filter-label">Sort By</label>
                            <select id="sort" name="sortTable" class="form-control">
                                <option value="">None</option>
                                <option <?php if ($sortTable == "flightNumber")
                                    echo "selected"; ?> value="flightNumber">
                                    Flight Number</option>
                                <option <?php if ($sortTable == "passengerCount")
                                    echo "selected"; ?>
                                    value="passengerCount">Passenger Count</option>
                                <option <?php if ($sortTable == "pilotName")
                                    echo "selected"; ?> value="pilotName">Pilot
                                    Name</option>
                                <option <?php if ($sortTable == "airlineName")
                                    echo "selected"; ?> value="airlineName">
                                    Airline Name</option>
                                <option <?php if ($sortTable == "departureDateTime")
                                    echo "selected"; ?>
                                    value="departureDateTime">Departure Date</option>
                                <option <?php if ($sortTable == "arrivalDatetime")
                                    echo "selected"; ?>
                                    value="arrivalDatetime">Arrival Date</option>
                                <option <?php if ($sortTable == "flightDurationMinutes")
                                    echo "selected"; ?>
                                    value="flightDurationMinutes">Flight Duration</option>
                            </select>
                        </div>

                        <!-- Order -->
                        <div class="d-flex flex-column">
                            <label for="order" class="filter-label">Order</label>
                            <select id="order" name="orderTable" class="form-control">
                                <option <?php if ($orderTable == "ASC")
                                    echo "selected"; ?> value="ASC">Ascending</option>
                                <option <?php if ($orderTable == "DESC")
                                    echo "selected"; ?> value="DESC">Descending
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Filter Button -->
                    <div class="text-center mt-4">
                        <button class="btn btn-primary btnFilter" name="btnFilter">Filter</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="row my-5">
        <div class="col">
            <div class="card p-4 rounded-5 shadow table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Flight Number</th>
                            <th scope="col">Airline Name</th>
                            <th scope="col">Pilot Name</th>
                            <th scope="col">passengerCount</th>
                            <th scope="col">Departure</th>
                            <th scope="col">Arrival</th>
                            <th scope="col">Flight Duration</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($flightLogsResults) > 0) {
                            while ($flightLogsRow = mysqli_fetch_assoc($flightLogsResults)) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $flightLogsRow['flightNumber'] ?></th>
                                    <td><?php echo $flightLogsRow['airlineName'] ?></td>
                                    <td><?php echo $flightLogsRow['pilotName'] ?></td>
                                    <td><?php echo $flightLogsRow['passengerCount'] ?></td>
                                    <td><?php echo $flightLogsRow['departureDatetime'] ?></td>
                                    <td><?php echo $flightLogsRow['arrivalDatetime'] ?></td>
                                    <td><?php echo floor($flightLogsRow['flightDurationMinutes'] / 60) . "h" . ($flightLogsRow['flightDurationMinutes'] % 60) . "m" ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>