$(document).ready(function() {
	$('#editbuglink').click(function() {
		Bt.editBug();
	});
	$('#closebuglink').click(function() {
		Bt.closeBug();
	});
	$('#deletebuglink').click(function() {
		Bt.deleteBug();
	});
	$('#solvebuglink').click(function() {
		Bt.solveBug();
	});
	$('#responsebuglink').click(function() {
		Bt.responseBug();
	});
	$('#item').focus(function() {
		Bt.clearFind();
	});
	$('#item').blur(function() {
		Bt.findBugreport();
	});
});
var Bt = {
	_editing: false,
	_xstoken: '',
	_id: 0,
	itemInfo: {priority: 1, status: 0, closed: 0, desc: '', response: ''},
	_responsing: false,

	setEditing: function(v) {
		Bt._editing = v;

		return true;
	},
	setXsToken: function(v) {
		Bt._xstoken = v;

		return true;
	},
	setId: function(v) {
		Bt._id = v;

		return true;
	},
	getId: function() {
		return Bt._id;
	},
	isEditing: function() {
		return Bt._editing == true;
	},
	getXsToken: function() {
		return Bt._xstoken;
	},
	setItemInfo: function(v) {
		Bt.itemInfo = v;

		return true;
	},
	setResponse: function(v) {
		Bt._responsing = v;

		return true;
	},
	isResponsing: function() {
		return Bt._responsing;
	},

	// Handlers //

	editBug: function() {
		if (!Bt.getXsToken())
			return false;

		if (!Bt.isEditing())
			Bt.showEditForm();
		else
			Bt.hideEditForm();

		return true;
	},
	closeBug: function() {
		if (!Bt.getXsToken())
			return false;

		if (Bt.itemInfo.closed == 1)
			Bt.processQuery('close', {closed: 0});
		else
			Bt.processQuery('close', {closed: 1});

		return true;
	},
	deleteBug: function() {
		if (!Bt.getXsToken())
			return false;

		Bt.processQuery('delete', false);

		return true;
	},
	solveBug: function() {
		if (!Bt.getXsToken())
			return false;

		if (Bt.itemInfo.status == 1)
			Bt.processQuery('solve', {'solved': 0});
		else if (Bt.itemInfo.status == 0)
			Bt.processQuery('solve', {'solved': 2});
	    else // Bt.itemInfo.status == 2
            Bt.processQuery('solve', {'solved': 1});

		return true;
	},
	responseBug: function() {
		if (!Bt.getXsToken())
			return false;

		if (Bt.isResponsing())
			Bt.hideResponseForm();
		else
			Bt.showResponseForm();

		return true;
	},
	updateCaptions: function(data) {
		if (!Bt.getXsToken())
			return false;

		if (data.errno == 0)
		{
			$('#bugopened').attr('style', 'color: ' + data.editedFields.status[0]).text(data.editedFields.status[1]);
			Bt.itemInfo.closed = data.editedFields.status[2];
			$('#bugpriority').attr('style', 'color: ' + data.editedFields.bugpriority[0]).text(data.editedFields.bugpriority[1]);
			Bt.itemInfo.priority = data.editedFields.bugpriority[2];
			$('#bugdescription').text(data.editedFields.bugdescription);
			Bt.itemInfo.desc = data.editedFields.bugdescription;
			Bt.setEditing(false);
			Bt.hideEditForm();

			return true;
		}
		
		alert('Error: ' + data.error + ' (errno: ' + data.errno + ')!');
		return false;
	},
	updateAdminResponse: function(data) {
		if (!Bt.getXsToken())
			return false;

		if (data.errno == 0)
		{
			Bt.setResponse(false);
			Bt.hideResponseForm();

			if (data.editedFields.response == '')
			{
				$('#adminresponse').fadeOut();
				return true;
			}

			$('#adminresponse').html(' <br /><b style="color: #00ff00;">Respuesta de ' + data.editedFields.admin + ':</b> <strong>' + data.editedFields.response + '</strong> <i>(' + data.editedFields.date + ')</i>').fadeIn();

			return true;
		}
		
		alert('Error: ' + data.error + ' (errno: ' + data.errno + ')!');
		return false;
	},
	updateBug: function() {
		if (!Bt.getXsToken())
			return false;

		return true;
	},
	processQuery: function(type, sendData) {
		if (!Bt.getXsToken())
			return false;

		$.ajax({
			url: Core.baseUrl + '/bugtracker/api?id=' + Bt.getId() + '&xstoken=' + Bt.getXsToken() + '&type=' + type,
			'type': 'POST',
			data: sendData,
			success: function(data) {
				switch (type)
				{
					case 'edit':
						Bt.updateCaptions($.parseJSON(data));
						break;
					case 'response':
						Bt.updateAdminResponse($.parseJSON(data));
						break;
					case 'solve':
						data = $.parseJSON(data);
						if (data.errno == 0)
						{
							$('#bugsolved').attr('style', 'color: ' + data.editedFields.status[0]).text(data.editedFields.status[1]);
							if (data.editedFields.status[1] == 'Si')
							{
								$('#solvebugcaption').text('Marcar no solucionado');
								Bt.itemInfo.status = 1;
							}
							else if (data.editedFields.status[1] == 'Desestimado')
							{
								$('#solvebugcaption').text('Marcar solucionado');
								Bt.itemInfo.status = 2;
							}
							else // data.editedFields.status[1] == 'No'
							{
							    $('#solvebugcaption').text('Marcar desestimado');
								Bt.itemInfo.status = 0;
							}
							
						}
						else
							alert('Error: ' + data.error + ' (errno: ' + data.errno + ')!');
						break;
					case 'close':
						data = $.parseJSON(data);
						if (data.errno == 0)
						{
							$('#bugopened').attr('style', 'color: ' + data.editedFields.closed[0]).text(data.editedFields.closed[1]);
							if (data.editedFields.closed[1] == 'Cerrado')
							{
								$('#closebugcaption').text('Abrir');
								Bt.itemInfo.closed = 1;
							}
							else
							{
								$('#closebugcaption').text('Cerrar');
								Bt.itemInfo.closed = 0;
							}
							
						}
						else
							alert('Error: ' + data.error + ' (errno: ' + data.errno + ')!');
						break;
					case 'delete':
						data = $.parseJSON(data);
						if (data.errno == 0)
						{
							document.location.href = Core.baseUrl + '/bugtracker/';
							return true;
						}
						else
							alert('Error: ' + data.error + ' (errno: ' + data.errno + ')!');
						break;
					case 'find':
						data = $.parseJSON(data);
						if (data.found == true)
						{
							$('#sameReportUrl').attr('href', data.url).text('#' + data.id);
							$('#sameReport').fadeIn();
							$('#submitter').attr('disabled', 'disabled');
						}
						break;
					default:
						break;
				}			
			}
		});

		return true;
	},
	showResponseForm: function() {
		var html = '';

		html += '<fieldset><label for="response">Mensaje (Dejar en blanco para borrar):</label><br /><textarea class="input textarea" id="response" rows="10" cols="80">' + Bt.itemInfo.response + '</textarea>';
		html += '<br /><a href="javascript:;" onclick="Bt.submitResponseForm();" id="submitEdit" class="ui-button button2"><span><span>Enviar</span></span></a><a class="ui-button button2" href="javascript:;" onclick="Bt.hideResponseForm();"><span><span>Cancelar</span></span></a>';
		html += '</fieldset>';

		$('#responseformplace').html(html).fadeIn();
		Bt.setResponse(true);

		return true;
	},
	showEditForm: function() {
		var html = '';

		html += '<fieldset><label for="status">Status:</label><select class="input select" id="status"><option value="0"' + (Bt.itemInfo.closed == 0 ? ' selected="selected"' : '') + '>Abierto</option><option value="1"' + (Bt.itemInfo.closed == 1 ? ' selected="selected"' : '') + '>Cerrado</option></select>';
		html += '<br /><label for="priority">Prioridad:</label><select class="input select" id="priority">';
		var priority = ['Baja', 'Media', 'Alta'];
		for (var i = 0; i < 3; ++i)
		{
			html += '<option value="' + (i + 1) + '"';
			if (Bt.itemInfo.priority == (i + 1))
				html += ' selected="selected"';
			html += '>' + priority[i] + '</option>';
		}
		html += '</select>';
		html += '<br /><label for="description">Descripción:</label><br /><textarea class="input textarea" id="description" rows="10" cols="80">' + Bt.itemInfo.desc + '</textarea>';
		html += '<br /><a href="javascript:;" onclick="Bt.submitEditForm();" id="submitEdit" class="ui-button button2"><span><span>Guardar</span></span></a><a class="ui-button button2" href="javascript:;" onclick="Bt.hideEditForm();"><span><span>Cancelar</span></span></a>';
		html += '</fieldset>';

		$('#editformplace').html(html).fadeIn();

		Bt.setEditing(true);

		return true;
	},
	submitEditForm: function() {
		Bt.processQuery('edit', Bt.getEditFormData());
	},
	submitResponseForm: function() {
		Bt.processQuery('response', Bt.getResponseFormData());
	},
	hideEditForm: function() {
		$('#editformplace').fadeOut();
		Bt.setEditing(false);

		return true;
	},
	hideResponseForm: function() {
		$('#responseformplace').fadeOut();
		Bt.setResponse(false);

		return true;
	},
	getEditFormData: function() {
		var data = {
			priority: $('#priority').val(),
			status: $('#status').val(),
			desc: $('#description').val()
		};

		return data;
	},
	getResponseFormData: function() {
		var data = {
			message: $('#response').val()
		};

		return data;
	},
	findBugreport: function() {
		var id = $('#item').val();
		var type = $('#type').val();

		if (!id || !type || (type == 0 || type == 1 || type == 8 || type == 9))
			return false;

		Bt.processQuery('find', {'type': type, 'id': id});
	},
	clearFind: function() {
		$('#sameReport').fadeOut();
		$('#sameReportUrl').attr('href', '').text('');
		$('#submitter').removeAttr('disabled');
	}
};
