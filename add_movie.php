<?php
require_once 'config/db.php'; // Include the database connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data and sanitize it
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $director_id = mysqli_real_escape_string($con, $_POST['director_id']);
    $studio_id = mysqli_real_escape_string($con, $_POST['studio_id']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    $imdb_rating = mysqli_real_escape_string($con, $_POST['imdb_rating']);
    $poster_url = mysqli_real_escape_string($con, $_POST['poster_url']);

    // Validate inputs (basic validation)
    if (empty($name) || empty($year)) {
        die('Name and Year are required.');
    }

    // Prepare SQL query to insert data into the movies table
    $query = "INSERT INTO movies (name, year, duration, director_id, studio_id, rating, imdb_rating, poster_url) VALUES ('$name', '$year', '$duration', '$director_id', '$studio_id', '$rating', '$imdb_rating', '$poster_url')";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check for errors in the query execution
    if (!$result) {
        die("Database query failed: " . mysqli_error($con));
    } else {
        echo "Movie added successfully!";
        // Redirect to another page or display a success message
        // header("Location: success_page.php"); // Redirect to a success page
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <title>Add New Movie</title>
</head>
<body class="bg-dark">
    <div class="container mt-5">
        <h2 class="text-white mb-4">Add New Movie</h2>
        <form action="add_movie.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label text-white">Movie Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label text-white">Year</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label text-white">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration">
            </div>
            <div class="mb-3">
                <label for="director_id" class="form-label text-white">Director ID</label>
                <input type="number" class="form-control" id="director_id" name="director_id">
            </div>
            <div class="mb-3">
                <label for="studio_id" class="form-label text-white">Studio ID</label>
                <input type="number" class="form-control" id="studio_id" name="studio_id">
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label text-white">Rating</label>
                <input type="text" class="form-control" id="rating" name="rating">
            </div>
            <div class="mb-3">
                <label for="imdb_rating" class="form-label text-white">IMDb Rating</label>
                <input type="text" class="form-control" id="imdb_rating" name="imdb_rating">
            </div>
            <div class="mb-3">
                <label for="poster_url" class="form-label text-white">Poster URL</label>
                <input type="text" class="form-control" id="poster_url" name="poster_url">
            </div>
            <button type="submit" class="btn btn-primary">Add Movie</button>
        </form>
    </div>
   
