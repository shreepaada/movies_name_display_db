<?php 

require_once 'config/db.php'; // Include the database connection

function display_data($sortByRating = false, $searchTerm = '') {
    global $con;
    $query = "SELECT name, duration, rating, imdb_rating, poster_url FROM movies";

    if (!empty($searchTerm)) {
        $searchTerm = mysqli_real_escape_string($con, $searchTerm);
        $query .= " WHERE name LIKE '%$searchTerm%'";
    }

    if ($sortByRating) {
        $query .= " ORDER BY imdb_rating DESC";
    }

    $result = mysqli_query($con, $query);
  
    if (!$result) {
        die("Database query failed: " . mysqli_error($con));
    }

    return $result;
}

?>
