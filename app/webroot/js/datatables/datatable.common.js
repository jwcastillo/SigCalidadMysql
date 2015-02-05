
// Custom Pagination
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
	return {
		"iStart":         oSettings._iDisplayStart,
		"iEnd":           oSettings.fnDisplayEnd(),
		"iLength":        oSettings._iDisplayLength,
		"iTotal":         oSettings.fnRecordsTotal(),
		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
		"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
	};
}

// Custom Pagination
$.extend( $.fn.dataTableExt.oPagination, {
	"bootstrap": {
		"fnInit": function( oSettings, nPaging, fnDraw ) {
			var oLang = oSettings.oLanguage.oPaginate;
			var fnClickHandler = function ( e ) {
				e.preventDefault();
				if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
					fnDraw( oSettings );
				}
			};

			$(nPaging).addClass('pagination').append(
				'<ul>'+
					'<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
					'<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
				'</ul>'
			);
			var els = $('a', nPaging);
			$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
			$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
		},

		"fnUpdate": function ( oSettings, fnDraw ) {
			var iListLength = 5;
			var oPaging = oSettings.oInstance.fnPagingInfo();
			var an = oSettings.aanFeatures.p;
			var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

			if ( oPaging.iTotalPages < iListLength) {
				iStart = 1;
				iEnd = oPaging.iTotalPages;
			}
			else if ( oPaging.iPage <= iHalf ) {
				iStart = 1;
				iEnd = iListLength;
			} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
				iStart = oPaging.iTotalPages - iListLength + 1;
				iEnd = oPaging.iTotalPages;
			} else {
				iStart = oPaging.iPage - iHalf + 1;
				iEnd = iStart + iListLength - 1;
			}

			for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
				// remove the middle elements
				$('li:gt(0)', an[i]).filter(':not(:last)').remove();

				// add the new list items and their event handlers
				for ( j=iStart ; j<=iEnd ; j++ ) {
					sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
					$('<li '+sClass+'><a href="#">'+j+'</a></li>')
						.insertBefore( $('li:last', an[i])[0] )
						.bind('click', function (e) {
							e.preventDefault();
							oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
							fnDraw( oSettings );
						} );
				}

				// add / remove disabled classes from the static elements
				if ( oPaging.iPage === 0 ) {
					$('li:first', an[i]).addClass('disabled');
				} else {
					$('li:first', an[i]).removeClass('disabled');
				}

				if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
					$('li:last', an[i]).addClass('disabled');
				} else {
					$('li:last', an[i]).removeClass('disabled');
				}
			}
		}
	}
});

TableTools.DEFAULTS.sSwfPath = swf_path;

//["copy", "csv", "xls", "pdf", "print"]

TableTools.DEFAULTS.aButtons = aButtons;


// Datatable default settings
$.extend( $.fn.dataTable.defaults, {
	"bJQueryUI": true,

	//"sScrollX": "100%",
	//"sScrollXInner": "110%",
	//"bScrollCollapse": true,

	"sDom": "R<'row-fluid'<'box24'l><'box24'f><'box24'T><'box24'C>r>t<'row-fluid'<'span12'i><'span12 center'p>>", 	
	/*columnDefs: [
		{ "visible": false, "targets": 2 }
	],*/

	"sPaginationType": "bootstrap",
	"aLengthMenu": [25, 50, 100, 500],
	
	//"bPaginate": false,
	// "bLengthChange": true,
	// "bFilter": true,
	// "bSort": true,
	// "bInfo": true,
	// "bAutoWidth": true,
	 
	
} );


if (datatable_lang) {
	$.extend( $.fn.dataTable.defaults, {
		"oLanguage": {
			"sUrl":  ""+datatable_lang+""
	}
	});
}

$.extend( $.fn.dataTable.ColVis.defaults, colVisDefaults );
	
/*
jQuery.fn.prueba = function(options) {

	var defaults = {

	validateOPtions1 : 'index',

	validateOPtions2 : '',

	};

 	var settings = $.extend({}, defaults, options);

	return this.each(function() {

	// you validation code goes here
	});
};*/


/*

{
    "sEmptyTable":     "No data available in table",
    "sInfo":           "Showing _START_ to _END_ of _TOTAL_ entries",
    "sInfoEmpty":      "Showing 0 to 0 of 0 entries",
    "sInfoFiltered":   "(filtered from _MAX_ total entries)",
    "sInfoPostFix":    "",
    "sInfoThousands":  ",",
    "sLengthMenu":     "Show _MENU_ entries",
    "sLoadingRecords": "Loading...",
    "sProcessing":     "Processing...",
    "sSearch":         "Search:",
    "sZeroRecords":    "No matching records found",
    "oPaginate": {
        "sFirst":    "First",
        "sLast":     "Last",
        "sNext":     "Next",
        "sPrevious": "Previous"
    },
    "oAria": {
        "sSortAscending":  ": activate to sort column ascending",
        "sSortDescending": ": activate to sort column descending"
    }
}

{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
*/