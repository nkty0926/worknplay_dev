var GoogleMap = {
	map : null,
	markers : [],
	infoWindow : null,
	searchBox : null,
	data : {
		latLng : {
			lat : null,
			lng : null
		},
		address : null,
		country : 'KR'
	},
	initMarkers : function() {
		if (GoogleMap.markers) {
			GoogleMap.markers.forEach(function(marker) {
				marker.setMap(null);
			});
		}
		GoogleMap.markers = [];
	},
	setData : function(place) {
		GoogleMap.data.latLng.lat = place.geometry.location.toJSON().lat;
		GoogleMap.data.latLng.lng = place.geometry.location.toJSON().lng;
		GoogleMap.data.address = place.formatted_address;
		if (place.address_components) {
			for (var i = 0; i < place.address_components.length; i++) {
				if (place.address_components[i].types[0] == 'country') {
					GoogleMap.data.country = place.address_components[i].short_name;
					break;
				}
			}
		}
	},
	setMarker : function() {
		if (GoogleMap.data.latLng.lat && GoogleMap.data.latLng.lng) {
			var marker = new google.maps.Marker({
				map : GoogleMap.map,
				position : GoogleMap.data.latLng,
				title : GoogleMap.data.address
			});
			if (marker.title) {
				marker.addListener('click', function() {
					if (GoogleMap.markers.length > 1) {
						GoogleMap.data.latLng.lat = this.getPosition().toJSON().lat;
						GoogleMap.data.latLng.lng = this.getPosition().toJSON().lng;
						GoogleMap.data.address = this.title;
						var geocoder = new google.maps.Geocoder;
						geocoder.geocode({
							location : GoogleMap.data.latLng
						}, function(results, status) {
							if (status === 'OK' && results[0].address_components) {
								for (var i = 0; i < results[0].address_components.length; i++) {
									if (results[0].address_components[i].types[0] == 'country') {
										GoogleMap.data.country = results[0].address_components[i].short_name;
										break;
									}
								}
							}
						});
						GoogleMap.initMarkers();
						GoogleMap.setMarker();
						GoogleMap.setInputs();
					}
					GoogleMap.infoWindow.setContent(marker.title);
					GoogleMap.infoWindow.open(GoogleMap.map, marker);
				});
				GoogleMap.infoWindow.setContent(marker.title);
				GoogleMap.infoWindow.open(GoogleMap.map, marker);
			}
			GoogleMap.markers.push(marker);
			GoogleMap.map.setCenter(marker.position);
		}
	},
	setInputs : function() {
		if (GoogleMap.data.latLng.lat && GoogleMap.data.latLng.lng) {
			document.getElementById('GoogleMap-lat').value = GoogleMap.data.latLng.lat;
			document.getElementById('GoogleMap-lng').value = GoogleMap.data.latLng.lng;
			// document.getElementById('GoogleMap-addr').value = GoogleMap.data.address;
			// document.getElementById('location-country').value = GoogleMap.data.country;
		}
	},
	findPlace : function() {
		var service = new google.maps.places.PlacesService(GoogleMap.map);
		var request = {
			query : $('#location-country>option[value!=""]:selected').text() + ' ' + $('#location-parent>a').text() + ' ' + $('#location-child>a').text(),
			fields : [ 'name', 'geometry', 'formatted_address' ]
		};
		request.query = request.query.replace(' Select', '').trim();
		console.log(request);
		service.findPlaceFromQuery(request, function(results, status) {
			if (status === google.maps.places.PlacesServiceStatus.OK) {
				if (results[0].geometry.location) {
					GoogleMap.map.setCenter(results[0].geometry.location);
				}
			}
		});
	}
};

function initAutocomplete() {
	if (document.getElementById('GoogleMap-map')) {
		// init Map
		GoogleMap.map = new google.maps.Map(document.getElementById('GoogleMap-map'), {
			center : {
				lat : 40.74887580000001,
				lng : -73.9680091
			},
			zoom : 14,
			zoomControl : true,
			scaleControl : true,
			rotateControl : false,
			mapTypeControl : false,
			streetViewControl : false,
			fullscreenControl : false
		});
		GoogleMap.infoWindow = new google.maps.InfoWindow({
			maxWidth : 300
		});

		if (document.getElementById('GoogleMap-lat') && document.getElementById('GoogleMap-lng')) {
			// set Marker
			GoogleMap.data.latLng.lat = parseFloat(document.getElementById('GoogleMap-lat').value);
			GoogleMap.data.latLng.lng = parseFloat(document.getElementById('GoogleMap-lng').value);
			if (document.getElementById('GoogleMap-addr') && document.getElementById('location-country')) {
				GoogleMap.data.address = document.getElementById('GoogleMap-addr').value;
				GoogleMap.data.country = document.getElementById('location-country').value;
			}
			GoogleMap.setMarker();

			if (document.getElementById('GoogleMap-addr')) {
				// click event
				var geocoder = new google.maps.Geocoder;
				GoogleMap.map.addListener('click', function(e) {
					geocoder.geocode({
						location : e.latLng
					}, function(results, status) {
						if (status === 'OK') {
							if (results[0].geometry) {
								GoogleMap.initMarkers();
								GoogleMap.setData(results[0]);
								GoogleMap.setMarker();
								GoogleMap.setInputs();
							} else {
								document.getElementById('GoogleMap-addr').value = 'No results found';
								console.log('No results found');
							}
						} else {
							document.getElementById('GoogleMap-addr').value = 'No results found';
							console.log('Geocoder failed due to: ' + status);
						}
					});
				});

				// input event
				GoogleMap.searchBox = new google.maps.places.SearchBox(document.getElementById('GoogleMap-addr'));
				GoogleMap.searchBox.addListener('places_changed', function() {
					var bounds = new google.maps.LatLngBounds();
					var places = GoogleMap.searchBox.getPlaces();
					if (places && places.length > 0) {
						GoogleMap.initMarkers();
						places.forEach(function(place) {
							if (place.geometry) {
								GoogleMap.setData(place);
								GoogleMap.setMarker();
								GoogleMap.setInputs();
								if (place.geometry.viewport) {
									bounds.union(place.geometry.viewport);
								} else {
									bounds.extend(place.geometry.location);
								}
							}
						});
						GoogleMap.map.fitBounds(bounds);
					}
				});

				// bounds event
				GoogleMap.map.addListener('bounds_changed', function() {
					GoogleMap.searchBox.setBounds(GoogleMap.map.getBounds());
				});
			}
		}
	}
}