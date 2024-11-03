<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>test</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <link rel ="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/assets/style.css">
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    </head>

    <body>

        <div id="titre"> 
            <p><h1>Escape game géographique</h1></p>
            <!-- <p> (il est censé y avoir un alert) </p> -->
        </div>

        <div id="map"></div>
        
        <div id="inventaire">
            <label>Triche<input type="checkbox" name="triche"></label>
            <p><u>INVENTAIRE</u></p>
        </div>

        <div id="identification">
            <p><h2>S'identifier : </h2></p>
            <form action="" method="post">
                <!--<label>Nom<input type="text" name="prenom"></label> -->
                <input type="text" name="prenom" placeholder="Nom">
                <!--<label>Mot de passe<input type="password" name="password"></label>-->
                <input type="password" name="password" placeholder="Mot de passe">
                <input type="submit" name="envoi" value="OK">
            </form>
            
        </div>      
                        
        
       <!-- <form id="app">
            <input type="text" v-model="message">
            <p>{{message}}</p>
        </form> -->
        
        <?php
           // $link = mysqli_connect('localhost', 'root', 'root','geobase');

            // if (!$link) {
            // die('Erreur de connexion');
            // } else {
            // echo 'Succès... ';
            // };
            // $results = mysqli_query($link, "SELECT nom, insee FROM communes LIMIT 2");
           // foreach ($results as $result) {
                // $result est un tableau associatif
                //echo '<h3>'.$result["nom"].' , '.$result["insee"].'</h3>';
              //};
        ?>

        

        <script src="assets/javascript.js"></script>

        <!--<div id="fin">
            <p>Escape game géographique, projet WEB ingénieur 2<sup>ème</sup> année ENSG</p>
            <p>Augustin-Pierre HOSTEIN, Mélanie LANCHA</p>

        </div>-->
    </body>

    <footer>
        <p>Escape game géographique, projet WEB ingénieur 2<sup>ème</sup> année ENSG</p>
        <p>Augustin-Pierre HOSTEIN, Mélanie LANCHA</p>
    </footer>