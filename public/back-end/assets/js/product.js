function map_autocomplete(){
	if(document.getElementById('address')){
		autocomplete = new google.maps.places.Autocomplete(
		/** @type {!HTMLInputElement} */
		(document.getElementById('address')),
		{types: ['geocode']});

		// When the user selects an address from the dropdown, populate the address
		// fields in the form.
		autocomplete.addListener('place_changed', fillInAddress);
	}
}

function fillInAddress(){
	// Get the place details from the autocomplete object.
	var place = autocomplete.getPlace();
	if (place != undefined && place.geometry != undefined){
		jQuery('#latitude').val(place.geometry.location.lat());
		latitude = place.geometry.location.lat();
		jQuery('#longitude').val(place.geometry.location.lng());
		longitude = place.geometry.location.lng();
		initMap();
	}
}
function initLocaltion(){
	jQuery(document).ready(function(){
		map_autocomplete();
		initMap();
	});
}
function initMap()
{
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 16,
		center: new google.maps.LatLng(latitude, longitude),
		mapTypeId: "roadmap"
	});
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(latitude, longitude),
		icon: icon,
		map: map
	});
}