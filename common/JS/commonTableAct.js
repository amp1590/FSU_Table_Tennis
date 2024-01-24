function deleteField(id){ //Validate the new club
	var url = fileName+"?action=remove&id="+id;
	url = addMaster(url);
	runPageAjaxIntTable(url);
}

function editField(id){ //Validate the new club
	var url = fileName+"?action=edit&id="+id;
//	alert('antes');
	url = addMaster(url);
//	alert(url);
	runPageAjaxIntTable(url);
}


