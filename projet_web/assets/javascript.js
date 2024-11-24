//alert("Ceci est un test");


Vue.createApp({
    data() {
      return {
        map : L.map('map',{zoomAnimation: false}).setView([48.872086, 2.331762 ], 15),
        heatmap : L.tileLayer.wms("http://localhost:8080/geoserver/escapegame/wms", {
          layers: 'objet',
          styles : 'heatmap',
          format: 'image/png',
          transparent: true,
          tiled: true,
          crs: L.CRS.EPSG4326
          }),
        markers_objets : new L.featureGroup(),
        emprise: L.geoJSON(),
        objets:[],
        objets_val:[],
        inventaire:[],  
        zoom: 0,
        objet_selectionne: null,
        code_entre : null,
        code_objet : "coucou",
        marker_code : L.popup(),
        objet_code : null,
        code_html : null,
        indice_code: null,
        bon_code : false,
        message:'',
        rang:0,
        listeJoueurs: [],
        temps:'',
        nomJoueur: localStorage.getItem('nomJoueur') || '',
        minutes : 0,
        second: 0,
        secondes : 0,
        intervalle : null,
        color: 'red',
        fin: false,
        triche: false,
      };
    },

    computed:{



    },

    mounted () {


      this.recupererClassement()
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
      }).addTo(this.map);

      


      this.markers_objets.addTo(this.map);
      this.objetsDepart();
      this.map.on('zoomend', this.visibilite);
      this.code_html = this.$refs.html;
      console.log(this.code_html);

      this.intervalle = setInterval(() => {
        this.secondes++;  // Incrémenter les secondes

        // Si les secondes atteignent 60, incrémenter les minutes et réinitialiser les secondes
        if (this.secondes === 60) {
            this.secondes = 0;
            this.minutes++;
        }
        // console.log(this.secondes)
    }, 1000);


    },


    methods:{



      visibilite() {
        console.log(this.nomJoueur)
        this.objets.forEach(element => {
        // console.log(element.nom)
        if (this.map.getZoom() >= element.zoom) {
          console.log(this.map.hasLayer(element))
          if (!this.markers_objets.hasLayer(element)) {
            element.addTo(this.markers_objets); 
          }
        } else {
          if (this.markers_objets.hasLayer(element)) {
            this.markers_objets.removeLayer(element); 
          }
        }
      });
      },


      tricher(){
        if(this.triche){
          this.map.addLayer(this.heatmap);
        }else{
          this.map.removeLayer(this.heatmap);
        }
      },
            

      sel_obj_inv(objet_invent) {
        console.log(objet_invent)
        this.objet_selectionne = objet_invent;
        console.log(this.objet_selectionne)
      },


      objetsDepart() {
        fetch('/api/objets')
        .then(result => result.json())
        .then (result => {
            result.forEach(element=>{
              console.log(element);
              this.creer_marker(element);
            })
        },)    
      },


      addObjet_i(i){
        let donnees = i;
        console.log(donnees)
        fetch('/api/objets?id='+ donnees)
        .then(result => result.json())
        .then (result => {
          console.log(result);
          this.creer_marker(result);
            },
          )
    },


    creer_marker(element){
      let coord = JSON.parse(element["st_asgeojson"]).coordinates;
      console.log("les coord" + coord);
      let zoom = parseInt(element["minzoom"]);
      let nom = element["nom"];
      let affiche_popup = element["popup"];
      let type_objet = element["type_objet"];
      let img = element["icone"];
      let objet_depend = element["objet_depend"];
      let numero = element["numero"];  // ou bien rajouter une colonne objet débloqué par cet objet
      let code = element["code"];
      let objet_final = parseInt(element["objet_final"]);

      let icone = this.creer_icone(img);
      let marker = L.marker([coord[1],coord[0]], {icon: icone});
      marker.nom = nom;
      marker.zoom = zoom;
      marker.type_objet = type_objet;
      marker.img= img;
      marker.objet_depend = objet_depend;
      marker.numero = numero;
      marker.code = code;
      marker.objet_final = objet_final;

      if (marker.type_objet == "indice" ){
        marker.bindPopup(affiche_popup)
      }

      else{
      if (marker.type_objet == "code") {
        console.log(marker.code);
        this.indice_code = affiche_popup;
        this.code_objet = marker.code;
        this.marker_code.setContent(this.code_html);
        marker.bindPopup(this.marker_code);
        this.objet_code = marker;


      } else{

      if (marker.type_objet == "recuperable" ){
        marker.bindPopup(affiche_popup);
        marker.on('click', () => {  
          this.inventaire.push(marker);
          marker.off('click');

          this.remove_marker(marker);


        });
      } else{
            if (marker.type_objet = "bloque"){
              console.log(marker.type_objet);
              marker.bindPopup(affiche_popup);
              marker.on('click', () => {
                // console.log(this.secondes)
              if (this.objet_selectionne && marker.objet_depend == this.objet_selectionne.numero){
                console.log(this.objet_selectionne.numero);
                console.log(this.objet_selectionne);
                let i = parseInt(marker.numero) + 1;
                console.log(i);
                this.remove_inventaire(this.objet_selectionne);
                this.remove_marker(marker);
                console.log("objet numero"+ i);
                this.addObjet_i(i);
                this.objet_selectionne = null;


                               
                

              }
            });

            
          };
      
    };
    };
    };

      marker.on('click',()=>{ this.fin_du_jeu(marker)})
      this.objets.push(marker);
      this.visibilite();

    },

    click_objet(objet){
      console.log(objet)
      if (objet.type_objet=="recuperable"){
        console.log("click")
        this.inventaire.push(objet)
        console.log(objet.img)
        this.remove_marker(objet)
      }

    },


    remove_marker(marker){
      if (this.markers_objets.hasLayer(marker)){
        this.markers_objets.removeLayer(marker);
        let index = this.objets.indexOf(marker);
        this.objets.splice(index,1)
        } 
    },

    remove_inventaire(objet_invent){
      let index = this.inventaire.indexOf(objet_invent);
      this.inventaire.splice(index,1)
    },

    creer_icone(image){
      return L.icon({
        iconUrl: image,
    
        iconSize:     [70, 70], // size of the icon
        // shadowSize:   [50, 64], // size of the shadow

        iconAnchor:   [35, 35], // point of the icon which will correspond to marker's location
        // shadowAnchor: [4, 62],  // the same for the shadow

        popupAnchor:  [0, -35] // point from which the popup should open relative to the iconAnchor
    });
    
    },

    verifier_code(){
      console.log(this.code_entre == this.code_objet);

      if (this.code_entre == this.code_objet){
        let i = parseInt(this.objet_code.numero) + 1;
        this.remove_marker(this.objet_code);
        this.addObjet_i(i);

      }

    },

    fin_du_jeu(objet){
      if (objet.objet_final == 1){
        console.log("fin du jeu");
        this.fin = true;
        this.ajouterNom();
        
        // window.location.href = '/';
      }
    },


    recupererClassement() {
        fetch('/api/classement')
        .then(r => r.json())
        .then(r => {
          r.forEach(joueur => {
            this.listeJoueurs.push(joueur);
          });
      })          
    },

    format_temps (value) {
      return value > 9 ? value : '0' + value;
    },

    async ajouterNom(){ 
      console.log(this.nomJoueur);
      this.temps = '00:'+this.format_temps(this.minutes) + ':' + this.format_temps(this.secondes);
      console.log(this.temps,this.nomJoueur);

      let reponse = await fetch("api/ajout?nom=" + this.nomJoueur + "&temps=" + this.temps) 
      //  .then(r => r.json())
      //  .then(r => console.log(r))

      window.location.href = '/';
      this.fin = true;
    },


    init_chronometre(){
        this.second = 0;
        this.secondes = 0;
        this.minutes = 0;
        console.log("le nom du joueur est" + this.nomJoueur)
    },
    
    enregistrer_nom(nom_entre){
      console.log(nom_entre);
      this.nom = nom_entre;
      this.nomJoueur = this.nom
      console.log(this.nom);

      localStorage.setItem('nomJoueur', this.nomJoueur);
      window.location.href = '/accueil';
      // this.nom = nom;   }

    },
  },

  }).mount('#app');

