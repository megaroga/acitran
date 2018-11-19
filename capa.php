<style type="text/css">
    #map-canvas {
        width: 100%;
        height: 100vh;
    }
</style>

<!-- Maps API Javascript -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzayBdWc4QVwOrL86SWzSmVJrI_KCYkwkLvf4&sensor=false&callback=initialize" async defer></script>


<script type="text/javascript">

    function getLocation()
      {
      if (navigator.geolocation)
        {
        navigator.geolocation.getCurrentPosition(showPosition,showError);
        }
      else{x.innerHTML="Geolocalização não é suportada nesse browser.";}
      }

    function showPosition(position)
      {
        var latA=position.coords.latitude;
        var lonB=position.coords.longitude;
        initialize(latA,lonB);
      }

    function showError(error)
      {
      switch(error.code)
        {
        case error.PERMISSION_DENIED:
          x.innerHTML="Usuário rejeitou a solicitação de Geolocalização."
          break;
        case error.POSITION_UNAVAILABLE:
          x.innerHTML="Localização indisponível."
          break;
        case error.TIMEOUT:
          x.innerHTML="O tempo da requisição expirou."
          break;
        case error.UNKNOWN_ERROR:
          x.innerHTML="Algum erro desconhecido aconteceu."
          break;
        }
      }


    var map;
    var infoWindow;

    // A variável markersData guarda a informação necessária a cada marcador
    // Para utilizar este código basta alterar a informação contida nesta variável
    var markersData = [
      <?php foreach ($tdsEnv as $key => $val) {?>
        <?php $darklregerg = explode(',', $val->coord);?>
        {
          lat: <?php echo $darklregerg[0];?>,
          lng: <?php echo $darklregerg[1]?>,
          nome: "<?php echo $val->titulo;?>",
          morada1:"<?php echo $val->endereco;?>",
          morada2: "<?php echo 'Nº envolvidos: '.$val->qtd_envolvidos;?>",
          codPostal: "<?php echo 'Data e hora: '.$Funcoes::daxCont($val->data_ocorrencia);?>" // não colocar virgula no último item de cada maracdor
        }<?php echo (($counttdsOco-1)==$key) ? '':','; ?>
      <?php } ?>
    ];


    function initialize(latA,lonB) {
        var laA = (latA=='undefined' || latA == null) ? -11.856624 : latA;
        var loB = (lonB=='undefined' || lonB == null) ? -55.503425 : lonB;
        var z = (lonB=='undefined' || lonB == null) ? 13: 15;
        

       var mapOptions = {
          center: new google.maps.LatLng(laA, loB),
          zoom: z,
          scrollwheel: false,
          mapTypeId: 'roadmap',
       };

       map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
       if(latA && lonB){
            latlon = new google.maps.LatLng(laA, loB);
            var marker=new google.maps.Marker({position:latlon,map:map,title:"Você está Aqui!"});
       }

       // cria a nova Info Window com referência à variável infowindow
       // o conteúdo da Info Window será atribuído mais tarde
       infoWindow = new google.maps.InfoWindow();

       // evento que fecha a infoWindow com click no mapa
       google.maps.event.addListener(map, 'click', function() {
          infoWindow.close();
       });

       // Chamada para a função que vai percorrer a informação
       // contida na variável markersData e criar os marcadores a mostrar no mapa
       displayMarkers();
    }
    //google.maps.event.addDomListener(window, 'load', initialize);

    // Esta função vai percorrer a informação contida na variável markersData
    // e cria os marcadores através da função createMarker
    function displayMarkers(){

       // esta variável vai definir a área de mapa a abranger e o nível do zoom
       // de acordo com as posições dos marcadores
       var bounds = new google.maps.LatLngBounds();
       
       // Loop que vai estruturar a informação contida em markersData
       // para que a função createMarker possa criar os marcadores 
       for (var i = 0; i < markersData.length; i++){

          var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
          var nome = markersData[i].nome;
          var morada1 = markersData[i].morada1;
          var morada2 = markersData[i].morada2;
          var codPostal = markersData[i].codPostal;

          createMarker(latlng, nome, morada1, morada2, codPostal);

          // Os valores de latitude e longitude do marcador são adicionados à
          // variável bounds
          bounds.extend(latlng);  
       }

       // Depois de criados todos os marcadores
       // a API através da sua função fitBounds vai redefinir o nível do zoom
       // e consequentemente a área do mapa abrangida.
       // map.fitBounds(bounds);
       map.setCenter(bounds.getCenter());
       var listener = google.maps.event.addListener(map, "idle", function() { 
         if (map.getZoom() > 16) map.setZoom(16); 
         google.maps.event.removeListener(listener); 
       });
    }

    // Função que cria os marcadores e define o conteúdo de cada Info Window.
    function createMarker(latlng, nome, morada1, morada2, codPostal){
       var image = 'img/marcador.png';
       var marker = new google.maps.Marker({
          map: map,
          position: latlng,
          title: nome,
          icon: image
       });

       // Evento que dá instrução à API para estar alerta ao click no marcador.
       // Define o conteúdo e abre a Info Window.
       google.maps.event.addListener(marker, 'click', function() {
          
          // Variável que define a estrutura do HTML a inserir na Info Window.
          var iwContent = '<div id="iw_container">' +
                '<div class="iw_title">' + nome + '</div>' +
             '<div class="iw_content">' + morada1 + '<br />' +
             morada2 + '<br />' +
             codPostal + '</div></div>';
          
          // O conteúdo da variável iwContent é inserido na Info Window.
          infoWindow.setContent(iwContent);

          // A Info Window é aberta.
          infoWindow.open(map, marker);
       });
    }

//     window.addEventListener('load', function() {
//   google.maps.event.addDomListener(window, 'load', initialize);
// });

</script>

<div id="map-canvas"></div>