<!--
// This is a collection of javascript functions that I commonly use in many of my sites.
// *************************************************************************************


function common_scripts_test() {
    alert("common_scripts.js");
}


// Trim beginning and ending spaces from a string.
function trimString(str) {
	
	return str.replace(/^\s+|\s+$/g, '');
	
} // end of - function trimString



// Check to see if the supplied email address is in the correct format.
function validate_email(p_strEmail) {
	
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			
	if (reg.test(p_strEmail) == false) {	
		//alert('Invalid Email Address');		
		return false;	
	} else {	
		return true;		
	}
   
} // end of - function validate_email



// Check to see if the values match.
function values_match(fld1, fld2) {
	
	var p1 = fld1.value;
	var p2 = fld2.value;
		
	if (p1 != p2){
		return false;
	}
	
	return true;
	
} // end of - function values_match	




// Check to see if the val passed is a number.
function isNumeric(val) {

	var numericExpression = /^[0-9]+$/;

	if (val.match(numericExpression)) {
		return true;
	} else {
		return false;
	}
	
} // end of - function isNumeric



// Limit the number characters that can be entered in a textbox or textarea.
function limitText(limitField, limitCount, limitNum) {
	
	if (limitField.value.length > limitNum) {
		
		limitField.value = limitField.value.substring(0, limitNum);
		
	} else {
		
		limitCount.value = limitNum - limitField.value.length;
		
	}
	
} // end of - function limitText



// Used with AJAX code.
function GetXmlHttpObject(){
	
	var xmlHttp = null;
	
	try
	  {
	  // Firefox, Opera 8.0+, Safari
	  xmlHttp = new XMLHttpRequest();
	  }
	catch (e)
	  {
	  // Internet Explorer
	  try
	    {
		//xmlHTTP = Server.CreateObject("Msxml2.serverXMLHTTP.3.0");
	    xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
	    }
	  catch (e)
	    {
	    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }
	  }
	  
	  
//if (window.XMLHttpRequest)
//  {// code for IE7+, Firefox, Chrome, Opera, Safari
//  xmlHttp = new XMLHttpRequest();
//  }
//else
//  {// code for IE6, IE5
//  xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
//  }	  
	  
	  
	return xmlHttp;
	
} // end of - function GetXmlHttpObject



function replaceValueInString(p_strCheckMe,p_strToBeReplaced,p_strReplaceWith){

	var strReturnValue = p_strCheckMe;

	var i = strReturnValue.indexOf(p_strToBeReplaced);

	while(i > -1){
	
		strReturnValue = strReturnValue.replace(p_strToBeReplaced, p_strReplaceWith);
		
		i = strReturnValue.indexOf(p_strToBeReplaced, i + p_strReplaceWith.length + 1);
	
	}
	
	return strReturnValue;

} // end of - function replaceValueInString


function Left(str, n){
	
	if (n <= 0) {
	    return "";
	} else if (n > String(str).length) {
	    return str;
	} else {
	    return String(str).substring(0,n);
	}
	
} // end of - function Left


function leftTrim(p_strValue){
		
	while (p_strValue.substring(0,1) == ' '){
		p_strValue = p_strValue.substring(1, p_strValue.length);
	}
	
	return p_strValue;
	
} // end of - function leftTrim


function rightTrim(p_strValue){
	
	while (p_strValue.substring((sString.length - 1), p_strValue.length) == ' '){
		p_strValue = p_strValue.substring(0, (p_strValue.length - 1));
	}
	
	return p_strValue
	
} // end of - function rightTrim


function trimAll(p_strValue){

	while (p_strValue.substring(0,1) == ' '){
		p_strValue = p_strValue.substring(1, p_strValue.length);
	}
	
	while (p_strValue.substring((p_strValue.length - 1), p_strValue.length) == ' '){
		p_strValue = p_strValue.substring(0, (p_strValue.length - 1));
	}
	
	return p_strValue;
	
} // end of - function trimAll


// start of - code not fully tested 
// ********************************



function getClientWidth()
{ 
    if( typeof( window.innerWidth ) == 'number' ) {
        return window.innerWidth;
    } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
        return document.documentElement.clientWidth;
    } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
        return myWidth = document.body.clientWidth;
    }
}
function getClientHeight()
{  
    if( typeof( window.innerWidth ) == 'number' ) {
        return window.innerHeight;
    } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
        return document.documentElement.clientHeight;
    } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
        return document.body.clientHeight;
    }
}




-->