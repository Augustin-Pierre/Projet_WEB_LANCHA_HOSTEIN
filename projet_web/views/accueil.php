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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/assets/style.css">
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    </head>

    <body>

        <div id="titre"> 
            <h1>Escape game géographique</h1>
        </div>

        <div id="map"></div>

        <div id="app">

            <div id="code_html" ref="html">
                <p>{{indice_code}}</p>
                <form @submit.prevent="verifier_code()"><input type="txt" v-model="code_entre"></form> 
            </div>

            <div id="inventaire">
                <label>Triche <input v-model="triche" @change="tricher" type="checkbox" name="triche" ></label>
                <p>INVENTAIRE</p>
                <ul id='objets_inventaire'>
                    <li style="list-style:none" v-for="item in inventaire" @click="sel_obj_inv(item)" :class="{'selected': objet_selectionne === item}"><img :src="item.img" alt="test"  width="100" height="100" ></li>
                 </ul>
            </div>

            <div id = "timer">
                <p>{{minutes}}:{{secondes}}</p>
            </div>    

        </div>       

        <footer>
            <p>Escape game géographique, projet WEB ingénieur 2<sup>ème</sup> année ENSG</p>
            <p>Augustin-Pierre HOSTEIN, Mélanie LANCHA</p>
        </footer>

         <script src="assets/javascript.js"></script>

    </body>    

</html>