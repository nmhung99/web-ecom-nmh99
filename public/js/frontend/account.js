function updatePass() {
	axios.post('/password/update', $('#form_change_pass').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
		}).then((result) => {
			window.location.href = '/';
		});
	}).catch(function(error){
		var data = error.response.data;
		if (data.status == 'validator_fail') {
			var messages = data.messages;
			Object.keys(messages).forEach(key => {
				$('#'+key+'_error').text(messages[key][0]);
			});
		} else{
			$('#message_error').text(data.messages);
		} 
	})
}
function removeMessage(obj){
	var input_name = obj.attr('name');
	$('#'+input_name+'_error').text('');
}

function updateInfo() {
	axios.post('/info/update', $('#form_change_info').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
		}).then((result) => {
			window.location.href = '/home';
		});
	}).catch(function(error){
		var data = error.response.data;
		if (data.status == 'validator_fail') {
			var messages = data.messages;
			Object.keys(messages).forEach(key => {
				$('#'+key+'_error').text(messages[key][0]);
			});
		} else if (data.status == 'update_fail') {
			var messages = data.message;
				$('#no_change_error').text(messages);
		} else {
			$('#message_error').text(data.messages);
		} 
	})
}