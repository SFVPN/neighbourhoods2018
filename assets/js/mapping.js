//
// jQuery(document).ready(function() {
//   //  jQuery('.accordion p:empty, .orbit p:empty').remove();
//
// var marksCanvas = document.getElementById("marksChart");
// var marksData = {
// 	labels: Object.keys(audit_vars),
// 	datasets: [{
// 		label: "Rating",
// 		backgroundColor: "rgba(0, 150, 136, .75)",
// 		data: Object.values(audit_vars)
// 	}]
// };
//
// var radarChart = new Chart(marksCanvas, {
//   type: 'radar',
//   data: marksData,
//   options: {
//         layout: {
//             padding: {
//                 left: 0,
//                 right: 0,
//                 top: 0,
//                 bottom: 0
//             }
//         },
//         legend: {
//             display: false
//         },
//         tooltips: {
//             titleFontSize: 16,
//             bodyFontSize: 14,
//             bodySpace: 5,
//             displayColors: false,
//         },
//
//     }
// });
// });
var map = null;
var layers = [];
function toggleLayer(i) {
	if (layers[i].getMap() === null) {
		layers[i].setMap(map);
	}
	else {
		layers[i].setMap(null);
	}
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
		zoom		: 10,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};


	// create map
	map = new google.maps.Map( $el[0], args);

	// layers to toggle


	var stirling_north = new google.maps.KmlLayer({
		preserveViewport: false,
		url: 'https://raw.githubusercontent.com/alastair38/KML-Layers/master/overlay.kml',
 map: map
	        });



					// $(document).on('click', 'input[type="checkbox"]', function () {
					// 		kmlFilter = $(this);
					// 		kmlFilterVal = kmlFilter.val();
					//
					// 		if ((!this.checked) && (kmlFilterVal === 'stirling_north')) {
					//     stirling_north.setMap(null);
					// 	} else {
					// 		stirling_north = new google.maps.KmlLayer({
					// 			preserveViewport: true,
					// 			url: 'https://raw.githubusercontent.com/alastair38/KML-Layers/master/overlay.kml',
					// 			map: map
					// 			});
					// 		}
					// });


					var el = document.getElementById('stirling_north');

					// get reference to input elements in toppings container element



								google.maps.event.addDomListener(el, 'click', function() {
												checkBox = $(this);
												elChecked = checkBox.context.checked;
												//checkBoxValue = checkBox.val();
												if (!elChecked) {
												stirling_north.setMap(null);
												//console.log(checkBoxChecked);
											} else {
												stirling_north = new google.maps.KmlLayer({
													preserveViewport: true,
													url: 'https://raw.githubusercontent.com/alastair38/KML-Layers/master/overlay.kml',
													map: map
													});
													//console.log(checkBoxChecked);
												}
												//checkboxes(checkBox);
							         });


// $('.map-filters_kml').on('click', 'input[type="checkbox"]', function () {
// 			kmlFilter = $(this);
// 			checked = kmlFilter.checked;
// 			if(!checked) {
// 				kmlLayer.setMap(null);
// 			} else {
// 				kmlLayer = new google.maps.KmlLayer({
// 					url: 'http://googlemaps.github.io/js-v2-samples/ggeoxml/cta.kml',
// 			 map: map
// 								});
// 			}
// })

// var mapDiv = document.getElementById('stirling_north');
// 					google.maps.event.addDomListener(mapDiv, 'click', function() {
// 									var checked = mapDiv.checked;
// 				          if(!checked) {
// 										kmlLayer.setMap(null);
// 									} else {
// 										kmlLayer = new google.maps.KmlLayer({
// 											url: 'http://googlemaps.github.io/js-v2-samples/ggeoxml/cta.kml',
// 									 map: map
// 										        });
// 									}
//
// 				        });


	// add a markers reference
	map.markers = [];
	map.leisureMarkers = [];
	map.retailMarkers = [];
	map.currentMarkers = [];
	// add markers
// add identifying number to each marker
	var sidebar = 1;
	$markers.each(function(){
	add_marker( $(this), map, sidebar);
		sidebar++;
});



	// center map
	center_map( map );

// 	function markerCluster( markers, map ) {
// 	var cluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
// }
//
// markerCluster( map.markers, map );

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

function add_marker( $marker, map, sidebar ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
	var title = $marker.attr('data-title');

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
					fillOpacity: .5,
					strokeColor: fillColor,
					strokeOpacity: .95
				};

				var iconHover = {
								path: google.maps.SymbolPath.CIRCLE,
								scale: 8,
								fillColor: fillColor,
								fillOpacity: .95,
								strokeColor: fillColor,
								strokeOpacity: .5
							};

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map,
		icon: icon,
		category: auditType,
		title: title
	});


	google.maps.event.addListener(marker, 'mouseover', function() {
	    marker.setIcon(iconHover);
	});
	google.maps.event.addListener(marker, 'mouseout', function() {
	    marker.setIcon(icon);
	});

	// add to array
	map.markers.push( marker );

	if(auditType === 'leisure') {
		map.leisureMarkers.push( marker );

	} if(auditType === 'retail') {
		map.retailMarkers.push( marker );
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
			    $.each(map.markers, function(index,value){
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

	$('input[type=checkbox]').each(function () {
		filter = $(this);
		filterValue = filter.val();
		if(filter.is(':checked')) {

				map.markers.forEach(function(element) {
						if(element.category == filterValue) {

								map.currentMarkers.push( element );

						}
				});

		}

	});

var retailCluster = new MarkerClusterer(map, map.retailMarkers, {imagePath: 'https://neighbourhoods.dev/wp-content/themes/neighbourhoods2018/assets/icons/m'});

var leisureCluster = new MarkerClusterer(map, map.leisureMarkers, {imagePath: 'https://neighbourhoods.dev/wp-content/themes/neighbourhoods2018/assets/icons/m2'});

//console.log(leisureCluster.markers_.length)


// function addCluster(markerName, clusterName) {
// 	clusterName = new MarkerClusterer(map, map.markerName, {imagePath: 'https://neighbourhoods.dev/wp-content/themes/neighbourhoods2018/assets/icons/m'});
//
// }
//
// function removeCluster(clusterName) {
// 	//var markerCluster = new MarkerClusterer(map, markers);
//
// retailCluster.removeMarkers( retailCluster.getMarkers() );
// }


	//set marker clusterer thing here

	// Filter Markers
			  $('.map-filters__wrap').on('change', 'input[type="checkbox"]', function () {
					//map.currentMarkers = [];
					// $('input[type=checkbox]').each(function () {
					//  filter = $(this);
					//  filterValue = filter.val();
					//  if(filter.is(':checked')) {
				 //
					// 		 map.markers.forEach(function(element) {
					// 				 if(element.category == filterValue) {
				 //
					// 						 map.currentMarkers.push( element );
				 //
					// 				 }
					// 		 });
				 //
					//  }
				 //
				 // });


					 filter = $(this);
					 filterValue = filter.val();

					 if(filter.is(':checked')) {
						 if(filterValue === 'retail') {
								 retailCluster = new MarkerClusterer(map, map.retailMarkers, {imagePath: 'https://neighbourhoods.dev/wp-content/themes/neighbourhoods2018/assets/icons/m'});
								 //console.log(retailCluster.markers_.length);
							}
							if(filterValue === 'leisure') {
								 leisureCluster = new MarkerClusterer(map, map.leisureMarkers, {imagePath: 'https://neighbourhoods.dev/wp-content/themes/neighbourhoods2018/assets/icons/m2'});
								 //console.log(leisureCluster.markers_.length);
							}

							 map.markers.forEach(function(element) {
								 // if(filterValue === 'retail') {
									// 	retailCluster = new MarkerClusterer(map, map.retailMarkers, {imagePath: 'https://neighbourhoods.dev/wp-content/themes/neighbourhoods2018/assets/icons/m'});
									// 	//console.log(retailCluster.markers_.length);
								 // }
								 // if(filterValue === 'leisure') {
									// 	leisureCluster = new MarkerClusterer(map, map.leisureMarkers, {imagePath: 'https://neighbourhoods.dev/wp-content/themes/neighbourhoods2018/assets/icons/m2'});
									// 	//console.log(leisureCluster.markers_.length);
								 // }
									 if(element.category == filterValue) {
											 element.setVisible(true);


												//addCluster(filterValue + 'Markers', filterValue + 'Cluster');



									 }
							 });

							 $("[data-cat='" + filterValue + "']").each(function(){
 	 						 $(this).show();
 	 					 })

					 } else {
						 if(filterValue === 'retail') {
								retailCluster.removeMarkers( retailCluster.getMarkers() );
								//console.log(retailCluster.markers_.length);
						 }
						 if(filterValue === 'leisure') {
							 leisureCluster.removeMarkers( leisureCluster.getMarkers() );
							 //console.log(leisureCluster.markers_.length);
						}
							 map.markers.forEach(function(element) {
								 	var index = map.markers.indexOf(element);
									// if(filterValue === 'retail') {
									// 	 retailCluster.removeMarkers( retailCluster.getMarkers() );
									// 	 //console.log(retailCluster.markers_.length);
									// }
									// if(filterValue === 'leisure') {
 									// 	leisureCluster.removeMarkers( leisureCluster.getMarkers() );
									// 	//console.log(leisureCluster.markers_.length);
 								 // }
									 if(element.category == filterValue) {
											 element.setVisible(false);
									 }
							 });

							 $("[data-cat='" + filterValue + "']").each(function(){
								$(this).hide();
							})
					 }
					 //cluster.removeMarkers( cluster.getMarkers() );
					 //cluster = new MarkerClusterer(map, map.currentMarkers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

			 });



});



})(jQuery);
