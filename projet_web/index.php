<?php
require 'flight/Flight.php';


Flight::route('/accueil', function() {
    Flight::render('accueil'); 
});


Flight::route('/api/objets', function() {
    $link =   pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres");

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $reponse = pg_query($link,"SELECT nom, ST_AsGeoJson(point),minzoom,popup,type_objet,icone,objet_depend,numero,code,objet_final FROM objet WHERE numero ='". $_GET['id']."'");
        $resultats = pg_fetch_all($reponse, PGSQL_ASSOC)[0];
    }

    else{
        $reponse = pg_query($link, "SELECT nom, ST_AsGeoJson(point),minzoom,popup,type_objet,icone,objet_depend,numero,code,objet_final  FROM objet WHERE depart=true");
        $resultats = pg_fetch_all($reponse, PGSQL_ASSOC);
    }

    Flight::json($resultats);
});


Flight::route('/api/classement', function() {
    $link = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres");      
    $reponse = pg_query($link, "SELECT * FROM joueurs ORDER BY temps LIMIT 10"); // récupérer que les 10 premiers, classés par ordre décroissant
    $test = pg_fetch_all($reponse, PGSQL_ASSOC); // pour faire un tableau (pour organiser les réponses)

   Flight::json($test);
});


Flight::route('/api/ajout', function(){
    $link = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres");

    if (isset($_GET['nom']) && isset($_GET['temps'])){
        $reponse = pg_query($link, "INSERT INTO joueurs VALUES ('".$_GET['nom']."', '".$_GET['temps']."')");
        $test = pg_fetch_all($reponse, PGSQL_ASSOC);
    }
    Flight::json($test);   
});


Flight::route('/', function() { // remettre le POST quand ça voudra bien marcher :(
    Flight::render('scores');
});


Flight::start();