alert("Ceci est un test");


Vue.createApp({
    data() {
      return {
        message: '',
      };
    },

  }).mount('#app');


  var map = L.map('map').setView([48.8589, 2.3469], 13);
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);