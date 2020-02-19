<!--<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>-->
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVV5TKfP_rXeL_HmtTxNUvDo7EhwhWQXI&sensor=true"></script>
<script type="text/javascript">

var la = new google.maps.LatLng(34.0522, -118.2428);
//var user_location = new google.maps.LatLng(geoplugin_latitude(), geoplugin_longitude());
var marker;
var map;

////////////////////////////////////////////////////////////////////////
function initialize() {	
//This function Initializes the map with some default values.
//The geographical location is found and the map is centered 
//on the aquired location.
////////////////////////////////////////////////////////////////////////
	
	//Initialize The event Variables
  var mapOptions = {
    zoom: 12,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: la //user_location
  };
  
   var InfoWindowOptions = {
    content: "Hello",
	position: la //user_location
  };
  
  var goldStar = {
  path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
  fillColor: "red",
  fillOpacity: 0.9,
  scale: 10,
  strokeColor: "grey",
  strokeWeight: 5
  };
        
  map = new google.maps.Map(document.getElementById("map_canvas"),
      mapOptions);

  marker = new google.maps.Marker({
    map:map,
    icon:goldStar,
    draggable:true,
    animation: google.maps.Animation.DROP,
    position: la //user_location
  });
  
  google.maps.event.addListener(map, 'click', function(event) {
    createSpot(event.latLng);
  });
  
  google.maps.event.addListener(marker, 'click', toggleBounce);
  
  	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
		  var pos = new google.maps.LatLng(position.coords.latitude,
										   position.coords.longitude);
	
		  map.setCenter(pos);
		}, function() {
		  handleNoGeolocation(true);
		});
	  } else {
		// Browser doesn't support Geolocation
		handleNoGeolocation(false);
	  }
  
}

function createSpot(pos){
	var content_field = "Add a new spot?<br/>Spot Name:<form action='../functions/new_spot.php' method='post'><input type='text_field' name='spot_name'/></form>";
    info_window = new google.maps.InfoWindow({
    content: content_field,
	position: pos
  });
  info_window.open(map);
}

function toggleBounce() {

  if (marker.getAnimation() != null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
  alert(marker);
  alert(map.getBounds());      
}

function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
  } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
  };

  var infowindow = new google.maps.InfoWindow(options);
  map.setCenter(options.position);
}        
	</script>
