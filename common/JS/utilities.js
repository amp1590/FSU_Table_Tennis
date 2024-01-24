function addMaster(prev){
	master= $('#master').val();
	return prev+"&master="+master;
}
/**
 * This function is used to replace parameters on a link. 
 * For example on link  http://server?param1=val&parm2=val2 we use this
 * function to replace any parameter
 */
function replaceGetParamInLink(name, param, newval){
	// Updates the kml link to download the main data 
	link = document.getElementById(name).href;

	paramPos = link.lastIndexOf(param);

	//In this case the parameter doesn't exist previously so we just add the parameter
	if(paramPos==-1){
		document.getElementById(name).href =  link+"&"+param+"="+newval;
	}
	else{//In this case we replace the value of the parameter
		firstPart = link.slice(0,paramPos);
		secondPart = link.slice(paramPos, link.length);

		//Remove the old parameter argument
		paramEndPos = secondPart.indexOf("&");

		if(paramEndPos == -1){//In this case there are not more parameters
			secondPart = "";
		}else{
			secondPart = secondPart.slice(paramEndPos, secondPart.length);
		}

		newLink = firstPart+param+"="+newval+secondPart;
		document.getElementById(name).href = newLink;
	}
//	alert($(name).href);
}

function popItUp(url, width, height ) {
	newwindow=window.open(url,'','height='+height+',width='+width);
	if (window.focus) {
		newwindow.focus()
	}
	return false;
}

function IsNumeric(val) {

	if (isNaN(parseFloat(val))) {
		return false;
	}

	return true
}

/**
 * Assigns to the object 'img' the img_src text as an image
 */
function rollImage(img, img_src){
	img.src = img_src;
}

//This function changes the styel of the current id with the specified mode
function changeShadow(id, mode){
	switch(mode){
		case 1:
			id.style.color = 'black';
			id.style.textShadow= "0px -1px 5px #eeeeee,\n\
								  0px  1px 5px #eeeeee,\n\
								 -1px  0px 5px #eeeeee,\n\
								 1px  0px 5px #eeeeee,\n\
								 -1px -1px 5px #eeeeee,\n\
								 -1px  1px 5px #eeeeee,\n\
								 1px -1px 5px #eeeeee,\n\
								 1px  1px 5px #eeeeee";
			id.style.cursor = 'pointer';
			break;
		case 2:
			id.style.color = 'white';
			id.style.textShadow= "0px -1px 5px #000000,\n\
								  0px  1px 5px #000000,\n\
								 -1px  0px 5px #000000,\n\
								 1px  0px 5px #000000,\n\
								 -1px -1px 5px #000000,\n\
								 -1px  1px 5px #000000,\n\
								 1px -1px 5px #000000,\n\
								 1px  1px 5px #000000";
			id.style.cursor = 'pointer';
			break;
	}

}