CREATE DATABASE IF NOT EXISTS movie_db;
USE movie_db;

-- Directors Table
CREATE TABLE IF NOT EXISTS directors (
    director_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    birthdate DATE
);

-- Studios Table
CREATE TABLE IF NOT EXISTS studios (
    studio_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255)
);

-- Genres Table
CREATE TABLE IF NOT EXISTS genres (
    genre_id INT AUTO_INCREMENT PRIMARY KEY,
    genre_name VARCHAR(100) NOT NULL
);

-- Movies Table
CREATE TABLE IF NOT EXISTS movies (
    movie_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    year YEAR NOT NULL,
    duration VARCHAR(50),
    director_id INT,
    studio_id INT,
    rating VARCHAR(50),
    imdb_rating DECIMAL(3,1),
    poster_url VARCHAR(255),
    FOREIGN KEY (director_id) REFERENCES directors(director_id),
    FOREIGN KEY (studio_id) REFERENCES studios(studio_id)
);

-- Movie Genres Relationship Table
CREATE TABLE IF NOT EXISTS movie_genres (
    movie_id INT,
    genre_id INT,
    PRIMARY KEY (movie_id, genre_id),
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id),
    FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
);

-- Reviews Table
CREATE TABLE IF NOT EXISTS reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    user_id INT, 
    review_text TEXT,
    rating DECIMAL(2,1),
    review_date DATE,
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id)
    -- FOREIGN KEY (user_id) REFERENCES users(user_id) 
);