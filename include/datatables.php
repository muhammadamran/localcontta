<!-- <script src="assets/js/plugins/dataTables/jquery.dataTables.js"></script> -->
<!-- <scrpit src="assets/js/plugins/dataTables/dataTables.bootstrap.js"></script> -->
<!-- <script>
	$(document).ready(function() {
		$('#dataTables-example').dataTable();
	});
</script> -->
<link href="assets/js/dataTables/tables.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">

<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#users').DataTable({
			"order": [],
			"columnDefs": [{
				"targets": 'no-sort',
				"orderable": false,
			}]
		});
	});
</script>