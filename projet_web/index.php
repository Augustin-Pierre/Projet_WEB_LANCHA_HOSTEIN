<?php
require 'flight/Flight.php';

$link = mysqli_connect('localhost', 'root', 'root','geobase');

Flight::route('/', function() {
    
    // Flight::set('db', $link);
    // // récupérer la variable
    // Flight::get('db');
    // $results = mysqli_query($link, "SELECT nom FROM communes LIMIT 1")
    Flight::render('accueil');

});




Flight::start();
