<?php 
require_once 'config/db.php';
require_once 'config/functions.php';

$sortByRating = isset($_GET['sortbyrating']) && $_GET['sortbyrating'] == 'true';
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$result = display_data($sortByRating, $searchTerm);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Movie Database</title>
</head>
<body class="bg-dark">
    <div class="container mt-5">

        <!-- Search and Sort Section -->
        <div class="row mb-4">
            <div class="col">
                <form action="index.php" method="get">
                    <input type="text" name="search" class="form-control" placeholder="Search for movies..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="btn btn-primary mt-2">Search</button>
                </form>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" onclick="window.location.href='?sortbyrating=true'">Sort by IMDb Rating</button>
            </div>
            <div class="col-auto">
                <button class="btn btn-info" onclick="location.href='add_movie.php'">Add New Movie</button>
            </div>
        </div>

        <!-- Movies Display Section -->
        <div class="row">
            <?php 
            while($row = mysqli_fetch_assoc($result)) { 
                // Correcting the image path
                $imgPath = '/movie_db/PICTURES/' . basename($row['poster_url']);
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo htmlspecialchars($imgPath); ?>" class="card-img-top" alt="Movie Poster">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <p class="card-text">Duration: <?php echo htmlspecialchars($row['duration']); ?></p>
                            <p class="card-text">Rating: <?php echo htmlspecialchars($row['rating']); ?></p>
                            <p class="card-text">IMDb Rating: <?php echo htmlspecialchars($row['imdb_rating']); ?></p>
                        </div>
                    </div>
                </div>
            <?php    
            }
            ?>
        </div>

        <!-- Review Submission Section -->
        <div class="row mt-4">
            <div class="col">
                <h2 class="text-white">Submit a Review</h2>
                <form action="submit_review.php" method="post">
                    <div class="mb-3">
                        <label for="movie_id" class="form-label text-white">Movie ID</label>
                        <input type="number" class="form-control" id="movie_id" name="movie_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="review_text" class="form-label text-white">Review</label>
                        <textarea class="form-control" id="review_text" name="review_text" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label text-white">Rating</label>
                        <input type="number" class="form-control" id="rating" name="rating" step="0.1" required>
                    </div>
                    <button type="submit" class="btn btn-success">Submit Review</button>
                </form>
            </div>
        </div>

    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>