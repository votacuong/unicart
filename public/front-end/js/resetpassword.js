jQuery(document).ready(function(){
	
	jQuery('#password, #confirmpassword').keydown(function(){
		
		jQuery('#lostpassword-message-error').hide();
		
		jQuery('.lostpassword-message-misstake').hide();
		
	});
	
});

function checkInfor()
{
	
	if ( document.getElementById('password').value == document.getElementById('confirmpassword').value )
	{
		
		const strengthScore = checkPasswordStrength(document.getElementById('password').value);
		
		if (strengthScore < 5 )
		{
			
			jQuery('.lostpassword-message-misstake').show();
			
			return false;
			
		}
		else
		{
		
			return true;
		
		}
		
	}
	else
	{
	
		jQuery('#lostpassword-message-error').show();
		
		return false;
	
	}
	
	return false;
	
}

function checkPasswordStrength(password) 
{
	
	let strength = 0;
	
	const regex = [];
	
	regex.push(/[a-z]+/);
	
	regex.push(/[A-Z]+/);
	
	regex.push(/[0-9]+/);
	
	regex.push(/[^A-Za-z0-9]+/);

	regex.forEach((item) => {
		
		if (item.test(password)) 
		{
			
			strength += 1;
			
		}
		
	});

	if (password.length >= 8) 
	{
		
		strength += 1;
		
	}
	
	return strength;
	
}