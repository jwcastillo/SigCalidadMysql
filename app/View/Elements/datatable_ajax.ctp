
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

		columns = [];

		columns.push({ "bVisible": false });

		for (var i = 1; i < $('#ajax-table thead > tr > th').length; i++) {
			columns.push(null);
		};

		var view = "<?php echo Router::url(array('plugin' => $this->params['plugin'] , 
			'controller' => $this->params['controller'],'action'=>'view'));?>";

		var oTable =$('#ajax-table').dataTable ( {
			
			"bServerSide": true,
			"bProcessing": true,
			//"sServerMethod": "POST",
			"sAjaxSource": "<?php echo $this->Html->url(); ?>",
			"bPaginate": true,
			"iDisplayLength": 25,
			"aoColumns": columns,
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