<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>scores</title>
        <link rel="stylesheet" href="/assets/style.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <link rel ="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    </head>

    <body id="scores">
        
        <div id="map" style="display : none"></div>

        <div id="app">

            <div id="titre1"> 
                <h1>Escape game géographique</h1>
            </div>     

            <div id="identification">
                <p><h2>S'identifier : </h2></p>
                <form  method="post" @submit.prevent="enregistrer_nom(nomJoueur)">                
                    <input id="nomJoueur" type="text" name="nomJoueur" placeholder="Nom" v-model="nomJoueur" required="required">
                    <input @click="init_chronometre" type="submit" name="envoi" value="OK">                
                </form>
            </div>

            <div id="consignes" v-if="!fin"> <!-- rajouter v-if si c'est la fin du jeu ou pas -->
                <p>Voici les consignes du jeu : Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do 
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
                esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                deserunt mollit anim id est laborum.</p>
            </div>
            

            <div id="resultats">
                <h1>RÉSULTATS</h1>          

                <table class="table">

                    <thead>
                        <tr>
                        <th scope="col">NOM</th>
                        <th scope="col">TEMPS</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for = "joueur in listeJoueurs">
                        <td>{{joueur.nom}}</td>
                        <td>{{joueur.temps}}</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

    <footer>
        <p>Escape game géographique, projet WEB ingénieur 2<sup>ème</sup> année ENSG</p>
        <p>Augustin-Pierre HOSTEIN, Mélanie LANCHA</p>
    </footer>

    <script src="assets/javascript.js"></script>

    </body>

    

</html>