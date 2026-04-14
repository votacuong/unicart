$(document).ready( function(){
	jQuery('#process-pay').click(function(){
		handler.open({
			name: AMStripe.options.name,
			description: AMStripe.options.description,
			amount: AMStripe.options.stripe_amount * 100
		});
	});
});
function cartDeleteItem(key)
{
	jQuery.get(deleteItemCart+key, function(){
		window.location.reload();
	});
}
handler = StripeCheckout.configure({
	key    : AMStripe.options.publicKey,
	image  : __baseURL +'public/logo.png',
	locale : 'auto',
	currency: currency,
	panelLabel: "Pay",
	email: email,
	allowRememberMe: false,
	token: function(token) {
		jQuery('#ajax-process-pay').show();
		jQuery.post(__baseURL + 'cart/complete_payment', {stripe_token:token}, function(data){
			if (data.indexOf('Order-Success') != -1){
				window.location.href = thankyou;
			}else{
				window.location.href = fail;
			}
		}).fail(function(data){
			if (data.indexOf('Order-Success') != -1){
				window.location.href = thankyou;
			}else{
				jQuery('#ajax-process-pay').hide();
				jQuery('<div class="dialog-delete">'+fail_message+'</div>').dialog({
					title: 'Order Message',
					height: 250,
					width: 350
				});
			}
		});
	}
});
// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
	handler.close();
});
jQuery(document).ready(function(){
	jQuery('.subtrat').click(function(){
		var quanlity = parseInt(jQuery('.quanlity').val());
		if (quanlity > 0){
			jQuery('.quanlity').val(quanlity-1);
			window.location.href = reward+parseInt(jQuery('.quanlity').val());
		}
	});
	jQuery('.addtrat').click(function(){
		var quanlity = parseInt(jQuery('.quanlity').val());
		if (quanlity + 1 <= reward){
			jQuery('.quanlity').val(quanlity+1);
			window.location.href = reward+parseInt(jQuery('.quanlity').val());
		}
	});
	jQuery('.quanlity').blur(function(){
		if (parseInt(jQuery(this).val()) > reward ){
			jQuery('.quanlity').val(reward);
		}
		window.location.href = reward+parseInt(jQuery('.quanlity').val());
	});
});
