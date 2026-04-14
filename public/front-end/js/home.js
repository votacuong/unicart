function addToCart(product_id)
{
	jQuery.get(addCart+product_id, function(data){
		jQuery.get(countCart, function(data){
			jQuery('#cart-count').html(data);
		});
	});
}