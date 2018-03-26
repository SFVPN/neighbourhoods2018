
map.markers = [];
var leisureMarkers = [];
var retailMarkers = [];
var el = document.getElementById('stirling_north');
var elDF = document.getElementById('test7');
var elDF = elDF.checked;
var stirling_north = null;
var catChecked = [];
var checkArray = ['retail', 'leisure'];
var retailCluster = null;
var leisureCluster = null;
var dfCluster = null;




function contains (word) {
	if($.inArray(word, checkArray) == -1) {
			 //console.log("Does not contain value");
				return false;
		 } else {
			 //console.log("Contains value");
			 return true;
		 }
}

function containsAll(el, checkArray){
	for(var i = 0 , len = el.length; i < len; i++){
		 if($.inArray(el[i], checkArray) == -1) return false;
	}
	return true;
}

(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {

	// var
	var $markers = $el.find('.marker');


	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};


	// create map
	var map = new google.maps.Map( $el[0], args);

  var infowindow = new google.maps.InfoWindow();

	// add a markers reference
	map.markers = [];


	// add markers
	$markers.each(function(){

    	add_marker( $(this), map );

	});


	// center map
	center_map( map );


	// return
	return map;

}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});


	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

	});

});

})(jQuery);
/*
 * @constructor
 */
var ClickEventHandler = function(map, origin) {
  this.origin = origin;
  this.map = map;
  // this.directionsService = new google.maps.DirectionsService;
  // this.directionsDisplay = new google.maps.DirectionsRenderer;
  // this.directionsDisplay.setMap(map);
  this.placesService = new google.maps.places.PlacesService(map);
  this.infowindow = new google.maps.InfoWindow;
  this.infowindowContent = document.getElementById('infowindow-content');
  this.infowindow.setContent(this.infowindowContent);

  // Listen for clicks on the map.
  this.map.addListener('click', this.handleClick.bind(this));
};

var killInfo = null;

ClickEventHandler.prototype.handleClick = function(event) {
  //console.log('You clicked on: ' + event.latLng);
  // If the event has a placeId, use it.
  if(event.placeId) {
    //console.log('You clicked on place: ' + event.placeId);
  }
  if (event.placeId) {
    //console.log('You clicked on place:' + event.placeId);
    //console.log(markers);
    for (i = 0; i < markers.length; i++) {
      if( markers[i].key === event.placeId ) {
        killInfo = event.placeId;//event.stop();
        //console.log(killInfo);
         Materialize.toast('This location has already been audited. Click on the circular icon to view the audit data', 4000);

      } else {



      }
}
event.stop();
  this.getPlaceInformation(event.placeId);  // Calling e.stop() on the event prevents the default info window from
    // showing.
    // If you call stop here when there is no placeId you will prevent some
    // other map click event handlers from receiving the event.

    //this.calculateAndDisplayRoute(event.placeId);

  }
};

// ClickEventHandler.prototype.calculateAndDisplayRoute = function(placeId) {
//   var me = this;
//   this.directionsService.route({
//     origin: this.origin,
//     destination: {placeId: placeId},
//     travelMode: 'WALKING'
//   }, function(response, status) {
//     if (status === 'OK') {
//       me.directionsDisplay.setDirections(response);
//     } else {
//       window.alert('Directions request failed due to ' + status);
//     }
//   });
// };

ClickEventHandler.prototype.getPlaceInformation = function(placeId) {
  var me = this;
  this.placesService.getDetails({placeId: placeId}, function(place, status) {
    if ((status === 'OK') && (killInfo != placeId)) {
            me.infowindow.close();
            me.infowindow.setPosition(place.geometry.location);
            //me.infowindowContent.children['place-icon'].src = place.icon;
            me.infowindowContent.children['place-name'].textContent = place.name;
            //me.infowindowContent.children['place-id'].textContent = place.place_id;
            me.infowindowContent.children['place-address'].innerHTML =
                place.formatted_address + '<br><div class="center"><a class="chip purple darken-1 white-text" href="https://neighbourhoods.dev/form/submit-location-audit/?placename=' + place.name + '&placeaddress=' + place.formatted_address + '&ID=' + placeId + '">Submit an Audit</a></div>';
            me.infowindow.open(me.map);
          }

  });
};

// map.markers = [];
// map.leisureMarkers = [];
// map.retailMarkers = [];
// map.currentMarkers = [];
// map.addedMarkers = [];
// add markers
// add identifying number to each marker







// get reference to input elements in toppings container element
