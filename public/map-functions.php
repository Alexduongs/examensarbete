<script>
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
  let markers = []
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', () => {
    const places = searchBox.getPlaces()

    if (places.length == 0) {
      return
    }
    // Clear out the old markers.
    markers.forEach((marker) => {
      marker.setMap(null)
    })
    markers = []
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

  
lat = [];
  <?php foreach ($office_specs as $key => $office_specs) { ?>
    lat = "<?=($office_specs['lat'])?>";
    lng = "<?=($office_specs['lng'])?>";
    <?php } ?> 

    console.log(typeof parseFloat(lat))

    markers = [
      {
        coords:{lat:parseFloat(lat),lng:parseFloat(lng)},
        iconImage:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
        content:'<h4>Norrsken</h4>'
      },
      {
        coords:{lat:42.8584,lng:-70.9300},
        content:'<h1>Amesbury MA</h1>'
      },
      {
        coords:{lat:42.7762,lng:-71.0773}
      }
    ];

    for(var i = 0;i < markers.length;i++){
      // Add marker
      addMarker(markers[i]);
    }

    // Add Marker Function
    function addMarker(props){
      var marker = new google.maps.Marker({
        position:props.coords,
        map:map,
        //icon:props.iconImage
      });

      // Check for customicon
      if(props.iconImage){
        // Set icon image
        marker.setIcon(props.iconImage);
      }

      // Check content
      if(props.content){
        var infoWindow = new google.maps.InfoWindow({
          content:props.content
        });

        marker.addListener('click', function(){
          infoWindow.open(map, marker);
        });
      }
    }




}



</script>