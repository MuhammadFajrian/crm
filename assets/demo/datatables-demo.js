// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "destroy": true,
    "info": true,
    "bLengthChange": false,
    "bFilter": false,
    "bAutoWidth": false,
    "aoColumnDefs": [
			{ "bSortable": false, "aTargets": [ 0 ] },
			{ "sClass": "numericCol", "aTargets": [ 5 ] },
			{ "width": "50%", "targets": [0, 1] },
			{ "width": "10%", "targets": [4, 5, 6] },
			{ "width": "13%", "targets": [2, 3] }
			],
  });
});
