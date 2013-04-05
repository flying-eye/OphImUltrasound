
/* Module-specific javascript can be placed here */

$(document).ready(function() {
	$('#et_save').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();

			
			return true;
		}
		return false;
	});

	$('#et_cancel').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();

			if (m = window.location.href.match(/\/update\/[0-9]+/)) {
				window.location.href = window.location.href.replace('/update/','/view/');
			} else {
				window.location.href = baseUrl+'/patient/episodes/'+et_patient_id;
			}
		}
		return false;
	});

	$('#et_deleteevent').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();
			return true;
		}
		return false;
	});

	$('#et_canceldelete').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();

			if (m = window.location.href.match(/\/delete\/[0-9]+/)) {
				window.location.href = window.location.href.replace('/delete/','/view/');
			} else {
				window.location.href = baseUrl+'/patient/episodes/'+et_patient_id;
			}
		} 
		return false;
	});

	$('select.populate_textarea').unbind('change').change(function() {
		if ($(this).val() != '') {
			var cLass = $(this).parent().parent().parent().attr('class').match(/Element.*/);
			var el = $('#'+cLass+'_'+$(this).attr('id'));
			var currentText = el.text();
			var newText = $(this).children('option:selected').text();

			if (currentText.length == 0) {
				el.text(ucfirst(newText));
			} else {
				el.text(currentText+', '+newText);
			}
		}
	});
	
	// Use the existence of an editing widget to determine mode
	var sel = document.getElementById("Element_OphImUltrasound_Request_priority_id");
	
	// Edit mode
	if (sel != null)
	{
		ta = document.getElementById('Element_OphImUltrasound_Request_indication');
		var rp = document.getElementById('usEditReport');
		if (ta.value.length > 0)
		{
			$("#usEditReport").show();
		}
		else
		{
			$("#usEditReport").hide();
		}
	}
	// View mode
	else
	{
		var rp = document.getElementById('usReportText');
		if (rp.innerHTML.length > 0)
		{
			$("#usViewReport").show();
		}
		else
		{
			$("#usViewReport").hide();
		}
	}
});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}


/* Called by report button on edit page */
function importReport()
{
	console.log('importing');
	var reportText = "B Scan ultrasound:\n\nPosterior vitreous detachment with dense vitreous opacities consistent with a diagnosis of endophthalmitis\n\nNo retinal detachment or any sign of retinal tears";

	document.getElementById("Element_OphImUltrasound_Report_report").value = reportText;

}