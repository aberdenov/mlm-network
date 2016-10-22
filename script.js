function inputStatus(obj, btn_id) {
	if (obj.checked) {
		document.getElementById(btn_id).disabled = ''; 
	} else {
		document.getElementById(btn_id).disabled = 'disabled'; 
	}
}

function openDiv(layerID) {
	if (window.document.all[layerID].style.display == 'none') {
		window.document.all[layerID].style.display = '';
	} else {
		window.document.all[layerID].style.display = 'none';
	}
	
	return false;
}

function setAction(val) {
	document.getElementById('action').value = val;

	frmProfile.submit();
}

function showStruct(user_id) {
	jQuery.post(
		'ajax.php', {
			type: "html-request",
			action: 1,
			user_id: user_id
		},
		onShowStruct
	);	
}

function onShowStruct(data) {
	var info = data.split('#');

	document.getElementById('struct').innerHTML = info[0];
	document.getElementById('sel_id').style.display = '';

	$("#struct").orgChart({container: $("#command")});
}