<?php
require 'flight/Flight.php';
// connexion


// // requete non sécurisée
// $reponse = pg_query($link, "SELECT * FROM Objet");

// // resultats en tableau associatif
// // $resultats = pg_fetch_all($reponse, PGSQL_ASSOC);



 Flight::route('/', function() {
    Flight::render('accueil');

});

Flight::route('/api/objets', function() {
    $link =   pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgress");
    $reponse = pg_query($link, "SELECT * FROM Objet");
    // $resultats = pg_fetch_all($reponse, PGSQL_ASSOC);
    Flight::json(['reponse' => $test]);

});




Flight::start();
