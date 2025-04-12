<?php
include("../Config/database.php");

function AddFilm($cnx, $data) {
    $title = addslashes($data['title']);
    $actors = addslashes($data['actors']);
    $genres = addslashes($data['genres']);
    $description = addslashes($data['description']);
    $url = addslashes($data['url']);

    $req = "INSERT INTO Film (Title, Actors, Genres, Description, url)
            VALUES ('$title', '$actors', '$genres', '$description', '$url');";
    $cnx->query($req);
}

$films = [
    [
        "title" => "Inception",
        "actors" => "Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page",
        "genres" => "Science-fiction, Action, Thriller",
        "description" => "Un voleur spécialisé dans l'extraction d'informations en infiltrant les rêves se voit confier une mission inverse : implanter une idée dans l'esprit d'une cible.",
        "url" => "https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg"
    ],
    [
        "title" => "The Dark Knight",
        "actors" => "Christian Bale, Heath Ledger, Aaron Eckhart",
        "genres" => "Action, Crime, Drame",
        "description" => "Batman affronte le Joker, un criminel anarchiste qui sème le chaos à Gotham, mettant à l'épreuve les limites du héros masqué.",
        "url" => "https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg"
    ],
    [
        "title" => "Pulp Fiction",
        "actors" => "John Travolta, Uma Thurman, Samuel L. Jackson",
        "genres" => "Crime, Drame, Comédie noire",
        "description" => "Une série d'histoires interconnectées mêlant gangsters, boxeurs et criminels dans un récit non linéaire emblématique.",
        "url" => "https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg"
    ],
  ];

  foreach ($films as $film) {
      AddFilm($cnx, $film);
      echo"a7a";
  }

  ?>