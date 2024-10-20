<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>test</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <link rel ="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/style.css">
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    </head>
    <body>
        <p> Hello World ! </p>
        <button type="button" class="btn btn-primary">Ce bouton a un style</button>
        <p> il est censé y avoir un alert </p>
        
        <form id="app">
            <input type="text" v-model="message">
            <p>{{message}}</p>
        </form>
        
        <?php
            $link = mysqli_connect('localhost', 'root', 'root','geobase');

            // if (!$link) {
            // die('Erreur de connexion');
            // } else {
            // echo 'Succès... ';
            // };
            $results = mysqli_query($link, "SELECT nom, insee FROM communes LIMIT 2");
            foreach ($results as $result) {
                // $result est un tableau associatif
                echo '<h3>'.$result["nom"].' , '.$result["insee"].'</h3>';
              };
        ?>

        <div id="map"></div>

        <script src="assets/javascript.js"></script>
    </body>
