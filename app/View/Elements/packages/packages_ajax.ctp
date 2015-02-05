<?php $this->append('css'); ?>
	<!-- Chosen -->
	<?php echo $this->Html->css('chosen.min'); ?>
<?php $this->end(); ?>

<?php $this->append('script'); ?>
<!-- modal / dialog library -->
<?php echo $this->Html->script('bootstrap', array('once' => true)); ?>
<!-- jQuery Chosen -->
<?php echo $this->Html->script('chosen.jquery.min', array('once' => true)); ?>
<script type="text/javascript">
//<![CDATA[
	var asInitVals = new Array();

	$(document).ready(function() {

		statusIndex = -1;

		$("table#packages thead th").each(function (index, element) {
			if ($(this).html() == "<?php echo __('Status') ?>")
				statusIndex = index;
		});

		columns1 = [];

		columns1.push({ "bVisible": false });

		for (var i = 1; i < $('#packages thead > tr > th').length - 2; i++) {
			if (i == statusIndex) {
				columns1.push({
					"mRender": function ( data, type, full ) {

						switch(data) {
							case 'Certificado':
								label = 'label-success';
								break;
							case 'No Iniciado':
								label = '';
								break;
							default:
								label = 'label-info';
						}
						return '<span class="label '+label+'">'+data+'</span>';
					}
				});
			}
			else
				columns1.push(null);
		};
		// Hide last two columns by default
		columns1.push({ "bVisible": false });
		columns1.push({ "bVisible": false });

		var view = "<?php echo Router::url(array('controller'=>'packages','action'=>'view'));?>";

		var oTable = $('#packages').dataTable ( {

			"bServerSide": true,
			"bProcessing": true,
			//"sServerMethod": "POST",
			"sAjaxSource": "<?php echo $this->Html->url(); ?>",
			"bPaginate": true,
			"iDisplayLength": 25,
			"aoColumns": columns1,
			"fnRowCallback": function( nRow, aData, iDisplayIndex ) {

				$('td:eq(0)', nRow).html(
					'<a class="ajax-view" href="'+ view + '/' + aData[0]+'">'+aData[1]+'</a>');
					
					return nRow;
			},
			"fnInitComplete": function(oSettings, json) {
				$('div.dataTables_length select').chosen();
			}
	}); // Fin dataTable()


		$("tfoot input").attr('class', "search_init");

		$("tfoot input").keyup( function () {
				/* Filter on the column (the index) of this element */
				oTable.fnFilter( this.value, $("tfoot input").index(this) + 1 );
		} );
		 
		 /*
		 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in
		 * the footer
		 */
		$("tfoot input").each( function (i) {
				asInitVals[i] = this.value;
		} );
		 
		$("tfoot input").focus( function () {
				if ( this.className == "search_init" ) {
						this.className = "";
						this.value = "";
				}
		} );
		 
		$("tfoot input").blur( function (i) {
				if ( this.value == "" ) {
						this.className = "search_init";
						this.value = asInitVals[$("tfoot input").index(this) + 1];
				}
		} );

	});

//]]>
</script>

<?php $this->end();?>