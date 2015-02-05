<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php echo __('Edit Assignment'); ?>
			</h2>
		</div>
		<div class="box-content">
			<?php echo $this->Form->create('Assignment', array('class' => 'form-horizontal')); ?>
			<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
				<fieldset>
					<?php
						echo $this->Form->input('id');
				
					
						$url = array('controller' => 'rfcs', 'action' => 'add');

						$button = $this->Charisma->iconLink('', $url, 'icon-plus-sign icon-white', '', 
							array('class' => 'btn btn-success btn-round ajax-view', 'id' => 'test'));

						$inputAlter['after'] = "&nbsp;$button</div>";

						$options = array_merge($this->Charisma->getInputDefaults(), $this->Charisma->getSelectOptions());
						$options = array_merge($options, $inputAlter);


						echo $this->Form->input('rfc_id', $options);
					?>
					<?php
						echo $this->Form->input('management_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('employee_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('start_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('end_date', $this->Charisma->getDateOptions());

					?>
				  <div class="form-actions">
						<?php echo $this->Charisma->button(__('Save'), 'submit'); ?>
						<?php echo $this->Charisma->button(__('Cancel'), 'reset', 'btn'); ?>
				  </div>
				</fieldset>
			  <!--</form>-->
			<?php echo $this->Form->end(); ?>
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- <div class="row-fluid sortable">

<div class="box span12">
	<div data-original-title="" class="box-header well">
		<h2><i class="icon-tasks"></i>&nbsp;<?php echo __('Schedule'); ?></h2>
	</div>
	<div id="schedule" class="box-content">
	</div>
</div>
</div> -->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->deleteLink(__('Delete'), 
		array('action' => 'delete', $this->Form->value('Assignment.id')), 
		'icon-trash'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
		__('List Assignments'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo  __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Rfcs'), 
				array('controller' => 'rfcs', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Rfc'), 
				array('controller' => 'rfcs', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Employees'), 
				array('controller' => 'employees', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Employee'), 
				array('controller' => 'employees', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Managements'), 
				array('controller' => 'managements', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Management'), 
				array('controller' => 'managements', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>


<!-- Package detail modal div -->
<div class="modal hide fade" id="details">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3><?php echo /*$this->Charisma->camelToTitle(__($this->name));*/ __('Details') ?></h3>
	</div>
	<div id="detail-body" class="modal-body">
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal"><?php echo __('Close'); ?></a>
	</div>
</div>



<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<!-- modal / dialog library -->
<?php echo $this->Html->script('bootstrap', array('once' => true)); ?>

<script type="text/javascript">
//<![CDATA[

	function form_scripts() {

		/*$( 'div#details' ).on( 'click', '#RfcName', function() {
			alert( 'Hola' );
		});*/
		$("div#details input[class='datepicker']").datepicker({ dateFormat: 'yy-mm-dd' });

		$('div#details select.chosen-select').chosen();
		$('div#details input[type="number"].spinner').spinner({min: 0, max: 100, numberFormat: "n", step: 1});

		$("div#details input[type='checkbox']").bootstrapSwitch({
			'onText': '<?php echo __("Yes"); ?>', 
			'offText': '<?php echo __("No"); ?>', 
			'size': 'small', 
		});

		 $('#RfcWeighting').prop('readonly', true);
        $("#RfcComplexityId").prop('disabled', true);
        $("#RfcComplexityId").trigger("chosen:updated");

        if($("#RfcWPost").bootstrapSwitch('state')){
            $('#hiddenField').hide();
        } else {
            $('#hiddenField').show();
        }

              $('input[name="data[Rfc][w_post]"]').bind("change paste keyup switchChange.bootstrapSwitch", function(event, state) {
              // console.log($("#RfcWPost").bootstrapSwitch('state'));
               var elem = event.target;
                if (state) {
                       $('#hiddenField').hide();
                       RfcWeighting = $('#RfcWeighting').val();

                       $('#RfcWeighting').val(0.01);
                       $("#RfcComplexityId").val(2);
                       $("#RfcComplexityId").trigger("chosen:updated");
                   } else {
                       $('#hiddenField').show();
                       $('#RfcWeighting').val(RfcWeighting);
                       $("#RfcComplexityId").val(RfcComplexityId);
                       $("#RfcComplexityId").trigger("chosen:updated");
                   }

                   
               });

              
               var RfcComplexityId = 0;
               var RfcWeighting = 0;
               var acum = 0;
               var acuma = 0;
               var acumpf = 0;
               var acumpc = 0;
               var acumc = 0;
               var acumf = 0;



               var diaproyecto = 22;
               var diarequerimeito = 16;
               var ArquitecturaNew = 2;
               var ArquitecturaMod = 1;
               var Partfuncional = 0.5;
               var Parcontable = 1;
               var cola = 0.5;
               var MaxR = 3;
               var MaxP = 5;
               var MedR = 2;
               var MedP = 4;
               var BajR = 1;
               var BajP = 3;
               var Def = 0.5;


          
               $("#hiddenField").bind("change switchChange.bootstrapSwitch", function(event, state) {
                   var elem = event.target;
                   /*  console.log(this);
       		    console.log(event);
       		    console.log(state);
       		    console.log(elem.name);
       		    console.log(elem.tagName);
       		   	console.log(elem.type);
       		    console.log(elem.value);
       		    console.log(elem.id);*/
                   if (elem.id == "RfcWParticipationFunctional") {
                       acumpf = 0;
                       if (state) {
                           acumpf = Partfuncional;
                       }
                   }

                   if (elem.id == "RfcWParticipationAccounting") {
                       acumpc = 0;
                       if (state) {
                           acumpc = Parcontable;
                       }
                   }
                   if (elem.id == "RfcWPriority") {
                       acumc = 0;
                       if (state) {
                           acumc = cola;
                       }
                   }
                   if (elem.id == "RfcArchitecture") {
                       acuma = 0;
                       if (elem.value == "Nueva") {
                           acuma = ArquitecturaNew;
                       }
                       if (elem.value == "Modificada") {
                           acuma = ArquitecturaMod;
                       }
                   }
                   var elemfi;
                   if (document.getElementById("RfcWStartDate")) {
                       if (document.getElementById("RfcWStartDate").value !== "0000-00-00") {
                           elemfi = document.getElementById("RfcWStartDate").value;
                       }
                   }
                   //console.log(elemfi);

                   var elemff;
                   if (document.getElementById("RfcWEndDate")) {
                       if (document.getElementById("RfcWEndDate").value !== "0000-00-00") {
                           elemff = document.getElementById("RfcWEndDate").value;
                       }
                       //console.log(elemff);
                   }

                   if (elemfi && elemff && elemff >= elemfi && (elem.id=="RfcWStartDate" || elem.id=="RfcWEndDate")) {
                       var loadUrl = "<?php echo Router::url(array('controller'=>'rfcs', 'action'=>'getDiferenceDates.json'));?>";
                       console.log(elemfi);
                       console.log(elemff);
                       
                       var ajaxQuery = $.ajax({
                          
                           type: 'POST',
                           url: loadUrl,
                           async: false,
                             cache: false,
                           timeout: 30000,
                           data: {
                               'fi': elemfi,
                               'ff': elemff
                           },
                           success: function(data) {
                               
                               acumf = data;
                             
                           },
                           /*error: function(XMLHttpRequest, textStatus, errorThrown) {
       						alert(textStatus);
       					},*/
                           dataType: "json"
                       });
                      
                   }
                   
                   var elem2;
                   elem2 = document.getElementById("RfcPackageClassId");
                   //console.log("Tipo de Paquete");
                   if (elem2.value == 1 || elem2.value == 2) {
                       //console.log("requerimiento");
                       acum = acuma + acumpc + acumpf + acumc;
                       //console.log(acumf);
                       if (acumf > 0) {
                           acum = acum + Math.round(acumf / diarequerimeito * 100) / 100;
                       }
                       if (acum > MaxR) {
                           //		console.log("MaxR");
                           acum = MaxR;
                       }
                   }
                   if (elem2.value == 3 || elem2.value == 4) {
                       //		console.log("proyecto");
                       acum = acuma + acumpc + acumpf + acumc;
                       //							console.log(acumf);
                       if (acumf > 0) {
                           acum = acum + Math.round(acumf / diaproyecto * 100) / 100;
                               /*console.log(acum);*/
                       }
                       if (acum > MaxP) {
                           //			console.log("MaxP");
                           acum = MaxP;
                       }
                   }
                   if (acum < Def) {
                       //		console.log("Def");
                       acum = Def;
                   }
                   //console.log(acum);
                   $('#RfcWeighting').val(acum);
                   if (elem2.value == 1 || elem2.value == 2) {
                       //console.log("requerimiento");
                       if (acum > 0 && acum < BajR) {
                           $("#RfcComplexityId").val(2);
                       } else {
                           if (acum > BajR && acum < MedR) {
                               $("#RfcComplexityId").val(3);
                           } else {
                               if (acum > MedR) {
                                   $("#RfcComplexityId").val(4);
                               }
                           }
                       }
                       $("#RfcComplexityId").trigger("chosen:updated");
                   }
                   if (elem2.value == 3 || elem2.value == 4) {
                       //		console.log("proyecto");
                       if (acum > 0 && acum < BajP) {
                           $("#RfcComplexityId").val(2);
                       } else {
                           if (acum > BajP && acum < MedP) {
                               $("#RfcComplexityId").val(3);
                           } else {
                               if (acum > MedP) {
                                   $("#RfcComplexityId").val(4);
                               }
                           }
                       }

                       $("#RfcComplexityId").trigger("chosen:updated");

                   }

               });
	}

	function form_combos() {

		var loadUrl = "<?php echo Router::url(array('controller'=>'project_managers', 'action'=>'getList', 'ext' => 'json'));?>";

		projectManager = $("select#RfcProjectManagerId");
		developmentManager = $("select#RfcDevelopmentManagerId");

		developmentManager.val(-1).trigger("chosen:updated");
		projectManager.empty().trigger("chosen:updated");

		developmentManager.chosen().change(function() {
			developmentManagerId = this.value
			
			$.ajax({
				type: 'POST',
				url: loadUrl,
				data: {'developmentManagerId': developmentManagerId},
				success: function( data, status, xhr ) {
					projectManager.empty();
					$.each(data, function(index,item) {
					 projectManager.append('<option value="' + item.value + '">' + item.label + '</option>');
					});
					projectManager.trigger("chosen:updated");
				},
				/*error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert(textStatus);
				},*/
				dataType: "json"
			});
		});
	}

	function update_rfc_combo(selected_id) {

		packageRfcId = $("select#PackageRfcId");

		previousValue = packageRfcId.val();

		flag = false;

		loadUrl = "<?php echo Router::url(array('controller'=>'rfcs', 'action'=>'getList', 'ext' => 'json'));?>";

		$.ajax({
			type: 'POST',
			url: loadUrl,
			data: {'rfcId': previousValue}, 
			success: function( data, status, xhr ) {
				packageRfcId.empty();
				$.each(data, function(index,item) {
					if ( (item.value === selected_id && !flag ) || (item.value === previousValue && !flag) ) {
						packageRfcId.append('<option value="' + item.value + '" selected="selected">' + item.label + '</option>');
						flag = true;
					}
					else
						packageRfcId.append('<option value="' + item.value + '">' + item.label + '</option>');
				});
				packageRfcId.trigger("chosen:updated");
			},
			dataType: "json"
		});
	}

	function form_submit() {
		var $form = $('div#details form');
		$('div.modal-footer > button[type="submit"]').click(function( event ) {
		//$form.submit(function(event) {
			//alert('submit');
			event.preventDefault();
			$.ajax({
				dataType: "json",
				type: "POST", 
				url: "<?php echo $this->Html->url(array('controller'=>'rfcs', 'action'=>'add', 'ext' => 'json'))?>", 
				data: $form.serialize(), 
				success: function( data, status, xhr ) {

					$('div#details > .modal-body').html('<div class="alert alert-' + data.type + '">' +
					'<button data-dismiss="alert" class="close" type="button">×</button>' + 
						data.message + 
					'</div>');

					var close = '<a href="#" class="btn" data-dismiss="modal"><?php echo __('Close'); ?></a>';

					$("div#details > .modal-footer").html(close);

					if (data.type === 'success') {
						if (data.rfc.id)
							update_rfc_combo(data.rfc.id);
					}
				}
			});
		});
	}

	function add_form() {
		form_scripts();
		form_combos();
	}

	$(document).ready(function() {

		/*$.ajaxSetup ({
			cache: false
		});*/
		// Workload
	/*	var ajax_load = '<?php echo $this->Html->image("charisma/ajax-loaders/ajax-loader-7.gif", 
			array("alt" => __("Loading..."), "class" => "center")); ?>';
		//	load() functions
		var loadUrl = "<?php echo Router::url(array('controller'=>'employees',
			'action'=>'workload', $package['Management']['id']));?>"; //$(this).attr('href');
		$("div#workload").html(ajax_load).load(loadUrl + " .box-content", function() {

		});*/
		// Modal Add Rfc form
		$('a.ajax-view').click( function(e) {
			e.preventDefault();
			$('div#details').modal('show');
			var ajax_load = '<?php echo $this->Html->image("charisma/ajax-loaders/ajax-loader-7.gif", 
				array("alt" => __("Loading..."), "class" => "center")); ?>';
			//	load() functions
			var loadUrl = $(this).attr('href');
			$("div#details > .modal-body").html(ajax_load).load(loadUrl + " .view", add_form);
			// Save previous content
			var close = '<a href="#" class="btn" data-dismiss="modal"><?php echo __('Close'); ?></a>';
			// Load ajax content and restore previous content
			$("div#details > .modal-footer").html(ajax_load).load(loadUrl + " .form-actions > *", 
				function(){
					$(this).append(close);
					form_submit();
				}
			);
		});

	});
//]]>
</script>

<?php $this->end(); ?>