function generatePDF() {
	$("html").animate({ scrollTop: 0 }, "slow", function(){
		setTimeout(function(){
			// Choose the element that your content will be rendered to.
			const element = document.querySelector('.order-detail');
			var clonedElement = element.cloneNode(true);
			jQuery(clonedElement).find('.pdf').hide();
			const options = {
				margin: 0, // Optional: set margins in the configured unit (mm by default)
				filename: 'order-detail.pdf',
				image: { type: 'jpeg', quality: 0.98 },
				html2canvas: { scale: 1 }, // Scale factor for canvas rendering
				jsPDF: { 
					unit: 'cm', // Unit of measurement (mm, cm, inches, pt)
					format: "letter", // Page format (a4, letter, etc.)
					orientation: 'portrait' // Page orientation (portrait or landscape)
				}
			};
			clonedElement.style.backgroundColor = "#141416";
			clonedElement.style.border = "0px solid";
			clonedElement.style['border-radius'] = "0px";
			if (isChrome()){
				//clonedElement.style['marginLeft'] = "-7.5px";
			}
			clonedElement.style['paddingBottom'] = (1056-jQuery(element).height())+"px";
			// Choose the element and save the PDF for your user.
			html2pdf().set(options).from(clonedElement).save();
		}, 500);
	});
}

function isChrome()
{
	var winNav = window.navigator;
	var vendorName = winNav.vendor;

	var isChromium = window.chrome;
	var isOpera = typeof window.opr !== "undefined";
	var isFirefox = winNav.userAgent.indexOf("Firefox") > -1;
	var isIEedge = winNav.userAgent.indexOf("Edg") > -1;
	var isIOSChrome = winNav.userAgent.match("CriOS");
	var isGoogleChrome = isChromium !== null
		&& typeof isChromium !== "undefined"
		&& vendorName === "Google Inc."
		&& isOpera === false
		&& isIEedge === false
		&& (typeof winNav.userAgentData === "undefined" || winNav.userAgentData.brands.some(x => x.brand === "Google Chrome"));

	if (isIOSChrome) {
	   return true;
	} else if(isGoogleChrome) {
	   return true;	
	}
	
	return false;
}