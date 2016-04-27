<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">


	<title>Places Searchbox</title>
</head>
<body>
<input id="search-box" class="controls" type="text" placeholder="Search Box">
<script>
	// This example adds a search box to a map, using the Google Place Autocomplete
	// feature. People can enter geographical searches. The search box will return a
	// pick list containing a mix of places and predicted search terms.

	// This example requires the Places library. Include the libraries=places
	// parameter when you first load the API. For example:
	// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

	function initAutocomplete() {


		// Create the search box and link it to the UI element.
		var input = document.getElementById('search-box');
		var searchBox = new google.maps.places.SearchBox(input);
		//var markers = [];
		// [START region_getplaces]
		// Listen for the event fired when the user selects a prediction and retrieve
		// more details for that place.
		//searchBox.addListener('places_changed', function() {
		//	var places = searchBox.getPlaces();
//
		//	if (places.length == 0) {
		//		return;
		//	}
//
//
		//});
		// [END region_getplaces]
	}


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCm9bkUvEDLGz4BZZQKm_pr94vV35XQq0Y&libraries=places&callback=initAutocomplete"></script>
</body>
</html>