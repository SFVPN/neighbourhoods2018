var $markers = $( ".acf-map" ).find('.marker');
var markers = [];
var leisureMarkers = [];
var retailMarkers = [];
var el = document.getElementById('stirling_north');
var elDF = document.getElementById('test7');
var elDF = elDF.checked;
var stirling_north = null;
var catChecked = [];
var checkArray = ['retail', 'leisure'];

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


function initMap() {
  var origin = {lat: 56.11988819348081, lng: -3.935551643371582};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center		: new google.maps.LatLng(0, 0),
    disableDefaultUI: true,
      zoomControl: true,
      styles: [{
        featureType: 'poi',
        stylers: [{ visibility: 'on' }]  // Turn off POI.
      },
      {
        featureType: 'park',
        stylers: [{ visibility: 'on' }]  // Turn off POI.
      },
      {
        featureType: 'transit.station',
        stylers: [{ visibility: 'on' }]  // Turn off bus, train stations etc.
      }],
      disableDoubleClickZoom: true,
      streetViewControl: false,
  });



  var clickHandler = new ClickEventHandler(map, origin);

  markers = [];
  leisureMarkers = [];
  retailMarkers = [];
  dfMarkers = [];
  map.currentMarkers = [];
  map.addedMarkers = [];
	// add markers
// add identifying number to each marker

  var sidebar = 0;
  $markers.each(function(){
    $marker = $(this);
    sidebar++;
    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
    var title = $marker.attr('data-title');
    var df = $marker.attr('data-df');
    var place = $marker.attr('data-placeid');
    var auditType = $marker.attr('data-type');
    var fillColor = null;
    if(auditType === 'leisure') {
      fillColor = '#FFBF00';

    } if(auditType === 'retail') {
      fillColor = '#008CFF';
    }

    var icon = {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 8,
            fillColor: fillColor,
            fillOpacity: 1,
            strokeColor: fillColor,
            strokeOpacity: 1,
            anchor: new google.maps.Point(0, 2)
          };

          var iconHover = {
                  path: google.maps.SymbolPath.CIRCLE,
                  scale: 8,
                  fillColor: '#ffffff',
                  fillOpacity: 1,
                  strokeColor: fillColor,
                  strokeOpacity: 1,
                  anchor: new google.maps.Point(0, 2)
                };

    // create marker
    var marker = new google.maps.Marker({
      position	: latlng,
      map			: map,
      icon: icon,
      key: place,
      category: auditType,
      dementiaFriendly: df,
      title: title
    });



    	google.maps.event.addListener(marker, 'mouseover', function() {
    	    marker.setIcon(iconHover);
    	});
    	google.maps.event.addListener(marker, 'mouseout', function() {
    	    marker.setIcon(icon);
    	});

    	// add to array
    	markers.push( marker );

    	if(auditType === 'leisure') {

    		leisureMarkers.push( marker );

    	} if(auditType === 'retail') {

    		retailMarkers.push( marker );

    	} if(df === "Yes") {

    		dfMarkers.push( marker );

    	}

    	// if marker contains HTML, add it to an infoWindow
    	if( $marker.html() )
    	{
    		// create info window
    		var infowindow = new google.maps.InfoWindow({
    			content		: $marker.html()
    		});

    		// Create a click on the sidebar list and open the info window
    				$('#m'+sidebar).click(function(){
    		      // Close info windows
    			    $.each(markers, function(index,value){
    			        if(infowindow)
    		          	infowindow.close();

    		      });

    					//map.setCenter(marker.getPosition());
    					map.panTo(marker.getPosition());
    					map.setZoom(14);
    			    // Click on the marker
    			    	google.maps.event.trigger(marker, "click");
    				});
    		// show info window when marker is clicked
    		google.maps.event.addListener(marker, 'click', function() {
    			marker.setIcon(iconHover);
    			infowindow.open( map, marker );

    		});

    		google.maps.event.addListener(infowindow,'closeclick', function() {
    			marker.setIcon(icon);

    		});


    	}

});
center_map( map );
google.maps.event.addDomListener(el, 'click', function() {
        checkBox = $(this);
        elChecked = checkBox.context.checked;
        //checkBoxValue = checkBox.val();
        if (elChecked) {
          stirling_north = new google.maps.KmlLayer({
            preserveViewport: true,
            url: 'https://raw.githubusercontent.com/alastair38/KML-Layers/master/overlay.kml',
            map: map,
            suppressInfoWindows: true,
            clickable: false
            });

        //console.log(checkBoxChecked);
      } else {
          stirling_north.setMap(null);
          //console.log(checkBoxChecked);
        }
        //checkboxes(checkBox);
       });










			 //alert(checkArray);

			 $('.map-filters__wrap').on('change', 'input[type="checkbox"]', function () {
			   //console.log(checkArray);
			  var arr = checkArray;


			    filter = $(this);
			    filterValue = filter.val();



			    if(filter.is(':checked')) {

			      checkArray.push(filterValue);

			      var containsVal = contains('dementiaFriendly');

			       if((containsVal) && (checkArray.length == 1)) {
							 markers.forEach(function(element) {
											 element.setVisible(false);
							 });
							 $("[data-cat]").each(function(){
 							$(this).hide();
 						})
			      }


			      if((containsVal) && (checkArray.length > 1)) {
			        //loop markers show marker whenever element.category is in arrayValue ... contains(element.category);
							markers.forEach(function(element) {

									var containsCat = contains(element.category);

									if((containsCat) && (element.dementiaFriendly === "Yes")) {
											element.setVisible(true);
											$("[data-key='" + element.key + "']").show();
									} else {
											element.setVisible(false);
											$("[data-key='" + element.key + "']").hide();
									}

							});


			      }

						if(!containsVal) {
						 //loop markers
						 //hide marker when element.category is not in checkArray  ... contains(element.category);
						 markers.forEach(function(element) {

								 var containsCat = contains(element.category);

								 if(containsCat) {
										 element.setVisible(true);
										 $("[data-key='" + element.key + "']").show();
								 } else {
									 element.setVisible(false);
									 $("[data-key='" + element.key + "']").hide();
								 }

						 });

					 }



			    } else {
			      $.each(checkArray,function(i,item){
			 				if(checkArray[i] == filterValue) {
			 					checkArray.splice(i, 1);
			 				}
			 			});


			      var containsVal = contains('dementiaFriendly');

			      if(checkArray.length == 0 ) {
							markers.forEach(function(element) {
											element.setVisible(false);
							});
							$("[data-cat]").each(function(){
							$(this).hide();
						})
			      }


			        if((containsVal) && (checkArray.length == 1 )) {
								markers.forEach(function(element) {
 											 element.setVisible(false);
 							 });
							 $("[data-cat]").each(function(){
 							 $(this).hide();
 						 })//hide every marker as all category filters are unchecked
			      }

			      if((containsVal) && (checkArray.length > 1 )) {
			        //loop markers
			        //hide marker when element.category is not in checkArray  ... contains(element.category);
							markers.forEach(function(element) {

								 	var containsCat = contains(element.category);

									if((containsCat) && (element.dementiaFriendly === "Yes")) {
											element.setVisible(true);
											$("[data-key='" + element.key + "']").show();
									} else {
										element.setVisible(false);
										$("[data-key='" + element.key + "']").hide();
									}

							});


			      }

						if(!containsVal) {
						 //loop markers
						 //hide marker when element.category is not in checkArray  ... contains(element.category);
						 markers.forEach(function(element) {

								 var containsCat = contains(element.category);

								 if(!containsCat) {
										 element.setVisible(false);
										 $("[data-key='" + element.key + "']").hide();
								 } else {
									 element.setVisible(true);
									 $("[data-key='" + element.key + "']").show();
								 }

						 });


					 }





			    }



			 });



   //
   //   $('#dmentiaFriendly').on('change', 'input[type="checkbox"]', function () {
   //    //map.currentMarkers = [];
   //    // $('input[type=checkbox]').each(function () {
   //    //  filter = $(this);
   //    //  filterValue = filter.val();
   //    //  if(filter.is(':checked')) {
   //   //
   //    // 		 map.markers.forEach(function(element) {
   //    // 				 if(element.category == filterValue) {
   //   //
   //    // 						 map.currentMarkers.push( element );
   //   //
   //    // 				 }
   //    // 		 });
   //   //
   //    //  }
   //   //
   //   // });
   //
   //     filter = $(this);
   //     filterValue = filter.val();
   //
   //     if(filter.is(':checked')) {
   //        //console.log(filter.context.checked);
   //
   //         markers.forEach(function(element) {
   //           // if(filterValue === 'retail') {
   //            // 	retailCluster = new MarkerClusterer(map, map.retailMarkers, {imagePath: 'https://neighbourhoods.dev/wp-content/themes/neighbourhoods2018/assets/icons/m'});
   //
   //
   //             if(element.dementiaFriendly == "Yes") {
   //               console.log(element.title + " is visible");
   //                 element.setVisible(true);
   //             } else {
   //               console.log(element.title + " is not visible");
   //               element.setVisible(false);
   //             }
   //
   //
   //         });
   //
   //
   //
   //     } else {
   //        console.log(filter.context.checked);
   //
   //
   //         markers.forEach(function(element) {
   //
   //            // if(filterValue === 'retail') {
   //            // 	 retailCluster.removeMarkers( retailCluster.getMarkers() );
   //            // 	 //console.log(retailCluster.markers_.length);
   //            // }
   //            // if(filterValue === 'leisure') {
   //              // 	leisureCluster.removeMarkers( leisureCluster.getMarkers() );
   //            // 	//console.log(leisureCluster.markers_.length);
   //             // }
   //             if(element.dementiaFriendly == "No") {
   //                console.log(element.title + " is visible");
   //                 element.setVisible(true);
   //             } else {
   //                console.log(element.title + " is not visible");
   //               element.setVisible(false);
   //             }
   //
   //
   //
   //
   //         });
   //
   //
   //     }
   //     //cluster.removeMarkers( cluster.getMarkers() );
   //     //cluster = new MarkerClusterer(map, map.currentMarkers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
   //
   // });


     // google.maps.event.addDomListener(elDF, 'click', function() {
     //         dfcheckBox = $(this);
     //         elDFChecked = dfcheckBox.context.checked;
     //         //checkBoxValue = checkBox.val();
     //         if (!elDFChecked) {
     //
     //           markers.forEach(function(element) {
     //             // if(filterValue === 'retail') {
     //              // 	retailCluster = new MarkerClusterer(map, map.retailMarkers, {imagePath: 'https://neighbourhoods.dev/wp-content/themes/neighbourhoods2018/assets/icons/m'});
     //
     //
     //               if(element.dementiaFriendly === "No") {
     //                   element.setVisible(false);
     //               }
     //
     //
     //           });
     //
     //         //console.log(checkBoxChecked);
     //       } else {
     //         markers.forEach(function(element) {
     //           // if(filterValue === 'retail') {
     //            // 	retailCluster = new MarkerClusterer(map, map.retailMarkers, {imagePath: 'https://neighbourhoods.dev/wp-content/themes/neighbourhoods2018/assets/icons/m'});
     //
     //
     //             if(element.dementiaFriendly === "Yes") {
     //                 element.setVisible(true);
     //             }
     //
     //
     //         });
     //           //console.log(checkBoxChecked);
     //         }
     //         //checkboxes(checkBox);
     //       });

}

/**
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



function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});



	// only 1 marker?
	if( markers.length == 1 )
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



// get reference to input elements in toppings container element
