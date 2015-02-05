<?php $this->append('script'); ?>
<script type="text/javascript">
//<![CDATA[
    $(document).ready(function() {
        //console.log($.session.get('used_architecture'));
        //
        /*		$("#RfcComplexityId").bind("change paste keyup switchChange.bootstrapSwitch", function(event, state) {
        var elem = event.target;
		    console.log(this);
		    console.log(event);
		    console.log(state);
		    console.log(elem.name);
		    console.log(elem.tagName);
		    console.log(elem.type);
		    
		});*/
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
    });


//]]>
</script>

<?php $this->end();?>