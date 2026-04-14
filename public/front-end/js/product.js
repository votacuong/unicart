
jQuery(document).ready(function(){
	
	jQuery('.subtrat').click(function(){
		var quanlity = parseInt(jQuery('.quanlity').val());
		if (quanlity > 1){
			jQuery('.quanlity').val(quanlity-1);			
		}
	});
	jQuery('.addtrat').click(function(){
		var quanlity = parseInt(jQuery('.quanlity').val());
		jQuery('.quanlity').val(quanlity+1);
	});
	
});

function addToCart()
{
	jQuery.get(saveCart+jQuery('.quanlity').val(), function(data){
		jQuery.get(countCart, function(data){
			jQuery('#cart-count').html(data);
		});
	});
}