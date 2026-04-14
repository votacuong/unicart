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
		filter();
	}
}
var latitude = '';
var longitude = '';
var slider_min = 0;
var slider_max = 500;
var slider_price_min = 0;
var slider_price_max = 5000;
var timeoutFilter = null;
function initLocaltion(){
	jQuery(document).ready(function(){
		map_autocomplete();
		
		$( "#slider-range" ).slider({
		  range: true,
		  min: 0,
		  max: 500,
		  values: [ 0, 500 ],
		  slide: function( event, ui ) {
			  slider_min = ui.values[ 0 ];
			  slider_max = ui.values[ 1 ];
			  $( "#amount" ).html( ui.values[ 0 ] + " km - " + ui.values[ 1 ] + " km" );
			  clearTimeout(timeoutFilter);
			  timeoutFilter = setTimeout(function(){
				  filter();
			  }, 500);
		  }
		});
		$( "#amount" ).html( " 0 km - 500 km " );
		
		$( "#price-range" ).slider({
		  range: true,
		  min: 0,
		  max: 500,
		  values: [ 0, 500 ],
		  slide: function( event, ui ) {
			  slider_price_min = ui.values[ 0 ];
			  slider_price_max = ui.values[ 1 ];
			  $( "#price-amount" ).html( ui.values[ 0 ] + " "+Currency+" - " + ui.values[ 1 ] + " "+Currency );
			  clearTimeout(timeoutFilter);
			  timeoutFilter = setTimeout(function(){
				  filter();
			  }, 500);
		  }
		});
		$( "#price-amount" ).html( " 0 "+Currency+" - 5000 "+Currency+" " );
		
	});
}
function filter()
{
	jQuery.get(filterURL+'?latitude='+latitude+'&longitude='+longitude+'&slider_min='+slider_min+'&slider_max='+slider_max+'&slider_price_min='+slider_price_min+'&slider_price_max='+slider_price_max, function(data){
		if (data != 'Error')
		{
			jQuery('#product-filter-list').html(data);
		}
	});
}