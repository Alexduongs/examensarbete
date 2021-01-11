<script>
<?php
include '../map-icons-master/dist/js/map-icons.js';
?>

// GOOGLE MAPS SEARCH BOX

function myMap() {
  const map = new google.maps.Map(document.getElementById('googleMap'), {
    center: {lat: 59.3411845, lng: 18.0646734},
    zoom: 15,
    mapTypeId: 'roadmap',
    disableDefaultUI: true,
    zoomControl: true,
  })
  // Create the search box and link it to the UI element.
  const input = document.getElementById('pac-input')
  const searchBox = new google.maps.places.SearchBox(input)
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input)
  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', () => {
    searchBox.setBounds(map.getBounds())
  })
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', () => {
    const places = searchBox.getPlaces()

    if (places.length == 0) {
      return
    }
    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds()
    places.forEach((place) => {
      if (!place.geometry) {
        console.log('Returned place contains no geometry')
        return
      }
      const icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
      }
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport)
      } else {
        bounds.extend(place.geometry.location)
      }
    })
    map.fitBounds(bounds)
  })

  
  


    var markers = [
      <?php foreach ($office_specs as $key => $office_spec) { ?>
        lat = "<?=($office_spec['lat'])?>",
      lng = "<?=($office_spec['lng'])?>",
        {
        coords:{lat:parseFloat(lat),lng:parseFloat(lng)},
        content:'<?=($office_spec['conf_kvm'])?>'
      },
      <?php } ?>
    ];

    for(var i = 0;i < markers.length;i++){
      // Add marker
      addMarker(markers[i]);
    }
    // var marker = new google.maps.Marker({
      // position:new google.maps.LatLng(props.coords),
    // Add Marker Function
    function addMarker(props){
      var marker = new mapIcons.Marker({
        position:new google.maps.LatLng(props.coords),
        map:map,
        icon: {
            path: mapIcons.shapes.MAP_PIN,
            fillColor: '#f29a01',
            fillOpacity: 1,
            strokeColor: '',
            strokeWeight: 0
          },
          map_icon_label: '<span class="map-icon map-icon-political"></span>'
      });

      // Check for customicon
      // if(props.icon){
      //   // Set icon 
      //   marker.setIcon(props.icon);
      // }

      // Check content
      if(props.content){
        var infoWindow = new google.maps.InfoWindow({
          content:props.content,
          
        });

        marker.addListener('click', function(){
          infoWindow.open(map, marker);
        });
      }
    }




}



</script>