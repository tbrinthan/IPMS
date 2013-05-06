
simpla_datatable = {
    dt1: function(){
        $('#dt1').dataTable({
            "aaSorting": [[ 1, "asc" ]],
            "aoColumns": [
            {
                "bSortable": false
            },
            null,
            null,
            {
                "sType": "formatted-num"
            },
{
                "sType": "formatted-num"
            }
            ]
        });
    },
    dt2: function(){
        $('#dt2').dataTable({
            "sPaginationType": "full_numbers",
            "bRetrieve":true,
            "iDisplayLength": 8,
            "aLengthMenu":  [[8,16, 32, 64,128, -1], [8,16, 32, 64,128, "All"]]
        });
    },
    
    dtnodedetail: function(){
        $('#dtnodedetail').dataTable({
            "sPaginationType": "full_numbers",
            "bRetrieve":true,
            "iDisplayLength": 8,
            "aLengthMenu":  [[8,16, 32, 64,128, -1], [8,16, 32, 64,128, "All"]],
            "aaSorting": [[ 1, "asc" ]],
            "aoColumns": [
            null,
            null,
            null,
            null,
            null
            ]
        });
    },
               
		
    dt22: function(){
        $('#dt22').dataTable({
            "sPaginationType": "full_numbers",
            "iDisplayLength": 8,
            "aLengthMenu":  [[8,16, 32, 64,128, -1], [8,16, 32, 64,128, "All"]],
            "aaSorting": [[ 1, "asc" ]],
            "aoColumns": [
            {
                "bSortable": false
            },
            null,
            null,
            null
            ]
        });
    },
    dt_customer1: function(){
        $('#dt_customer1').dataTable({
            "sPaginationType": "full_numbers",
            "bAutowidth":false,
            "iDisplayLength": 8,
            "aLengthMenu":  [[8,16, 32, 64,128, -1], [8,16, 32, 64,128, "All"]],
            "aaSorting": [[ 1, "asc" ]],
            "aoColumns": [
            {
                "bSortable": false
            },
            null,
            null,
            null,
            null,
            null,
            null
            ]
        });
    },
    dt_customer2: function(){
        $('#dt_customer2').dataTable({
            "sPaginationType": "full_numbers",
            "iDisplayLength": 8,
            "aLengthMenu":  [[8,16, 32, 64,128, -1], [8,16, 32, 64,128, "All"]],
            "aaSorting": [[ 1, "asc" ]],
            "aoColumns": [
            {
                "bSortable": false
            },
            null,
            null,
            null,
            null,
            null
            ]
        });
    },
    ct: function(){
        $('#content_table').dataTable({
            "aaSorting": [[ 2, "asc" ]],
            "aoColumns": [
            {
                "bSortable": false
            },
{
                "sType": "natural"
            },
{
                "sType": "string"
            },
{
                "bSortable": false
            },
{
                "sType": "eu_date"
            },
{
                "bSortable": false
            }
            ]
        });
    },
    mobile_dt: function(){
        if( $(".mobile_dt1 th").hasClass('chb_col')){
            $(".mobile_dt1 .chb_col").remove()
        };
        $(".mobile_dt1").table({
            idprefix: "co1-",
            persist: "essential"
        });
        if( $(".mobile_dt2 th").hasClass('chb_col')){
            $(".mobile_dt2 .chb_col").remove()
        };
        $(".mobile_dt2").table({
            idprefix: "co2-",
            persist: "essential"
        });
        if( $(".mobile_dt3 th").hasClass('chb_col')){
            $(".mobile_dt3 .chb_col").remove()
        };
        $(".mobile_dt3").table({
            idprefix: "co3-",
            persist: "essential"
        });
    },
    dt_gal: function(){
        $('#dt_gal').dataTable({
            "aaSorting": [[ 2, "asc" ]],
            "aoColumns": [
            {
                "bSortable": false
            },
{
                "bSortable": false
            },
{
                "sType": "string"
            },
{
                "sType": "formatted-num"
            },
{
                "sType": "eu_date"
            },
{
                "bSortable": false
            }
            ]
        });
    },
    dt_gal_mobile: function(){
        if( $("#dt_gal th").hasClass('chb_col')){
            $("#dt_gal .chb_col").remove()
        };
        $("#dt_gal").table({
            idprefix: "co1-",
            persist: "essential"
        });
    },
    dt_actions: function() {
        $('.chSel_all').click(function () {
            $(this).closest('table').find('input[name=row_sel]').attr('checked', this.checked);
        });
        $('table.dt_act').each(function(){
            $(this).before('<div style="clear:both;position:relative;top:5px; float: left;" class="large table_act gh_button icon trash danger"><a href="javascript:void(0)" class="delete_all_rows">Delete selected rows</a></div>');
        });
        $('.delete_all_rows').click( function() {
            var target = $(this).closest('div.table_act').next('table.dt_act');
            oTable = $('#'+target.attr('id')).dataTable();
            $('input[@name=row_sel]:checked', oTable.fnGetNodes()).closest('tr').fadeTo(600, 0, function () {
                oTable.fnDeleteRow( this );
                $( '.chSel_all', '#'+target.attr('id') ).attr('checked',false);
                return false;
            });
            return false;
        });
    },
    dt_actions_fb: function() {
        $('.chSel_all').click(function () {
            $(this).closest('table').find('input[name=row_sel]').attr('checked', this.checked);
        });
    },
    dte_1: function(){
        if($('#dte_1').length) {
            $('#dte_1').dataTable({
                "sScrollX": "100%",
                "sScrollXInner": "110%",
                "bScrollCollapse": true
            });
        }
    },
    dte_2: function(){
        if($('#dte_2').length) {
				
            var oTable;
 
            /* Formating function for row details */
            function fnFormatDetails ( nTr )
            {
                var aData = oTable.fnGetData( nTr );
                var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                sOut += '<tr><td>Rendering engine:</td><td>'+aData[2]+' '+aData[5]+'</td></tr>';
                sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
                sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
                sOut += '</table>';
					 
                return sOut;
            }
				
            oTable = $('#dte_2').dataTable( {
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "lib/datatables/server_side/details_col.php",
                "aoColumns": [
                {
                    "sClass": "center", 
                    "bSortable": false
                },
                null,
                null,
                null,
                {
                    "sClass": "center"
                },
{
                    "sClass": "center"
                }
                ],
                "aaSorting": [[1, 'asc']]
            } );
				 
            $('#dte_2 tbody td img').live( 'click', function () {
                var nTr = $(this).parents('tr')[0];
                if ( oTable.fnIsOpen(nTr) )
                {
                    /* This row is already open - close it */
                    this.src = "img/details_open.png";
                    oTable.fnClose( nTr );
                }
                else
                {
                    /* Open this row */
                    this.src = "img/details_close.png";
                    oTable.fnOpen( nTr, fnFormatDetails(nTr), 'details' );
                }
            } );

        }
    }
};
 
 
simpla_tips = {
    init: function() {
        var shared = {
            style		: {
                classes	: 'ui-tooltip-dark ui-tooltip-rounded'
            },
            show		: {
                delay: 0
            },
            hide		: {
                delay: 0
            }
        };
        if($('.ttip_b').length) {
            $('.ttip_b').qtip( $.extend({}, shared, {
                position	: {
                    my		: 'top center',
                    at		: 'bottom center',
                    viewport: $(window)
                }
            }));
        };
        if($('.ttip_t').length) {
            $('.ttip_t').qtip( $.extend({}, shared, {
                position: {
                    my		: 'bottom center',
                    at		: 'top center',
                    viewport: $(window)
                }
            }));
        };
        if($('.ttip_l').length) {
            $('.ttip_l').qtip( $.extend({}, shared, {
                position: {
                    my		: 'right center',
                    at		: 'left center',
                    viewport: $(window)
                }
            }));
        };
        if($('.ttip_r').length) {
            $('.ttip_r').qtip( $.extend({}, shared, {
                position: {
                    my		: 'left center',
                    at		: 'right center',
                    viewport: $(window)
                }
            }));
        };
    }
};
 /* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


