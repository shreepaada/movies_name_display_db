<?php
require_once 'config/db.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $movie_id = mysqli_real_escape_string($con, $_POST['movie_id']);
    $review_text = mysqli_real_escape_string($con, $_POST['review_text']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    $review_date = date('Y-m-d'); // Current date

    // Validate inputs
    if (empty($movie_id) || empty($review_text) || empty($rating)) {
        die('Movie ID, Review, and Rating are required.');
    }

    // SQL query to insert review data
    $query = "INSERT INTO reviews (movie_id, review_text, rating, review_date) VALUES ('$movie_id', '$review_text', '$rating', '$review_date')";

    // Execute the query
    if (mysqli_query($con, $query)) {
        echo "Review submitted successfully!";
        // Redirect or display a success message
    } else {
        die("Error submitting review: " . mysqli_error($con));
    }
}
?>
