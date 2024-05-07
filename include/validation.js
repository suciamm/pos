$(document).ready(function() {
	
	window.table = $('#view-table').DataTable({					
			"scrollY": 260,
			"dom": 
				"<'top'>t"+
				"<'col-md-12'i>"+
				"<'row pull-right'<'col-md-12'p>>",
			"iDisplayLength": 5,
			"pagingType": "full_numbers",
			"bJQueryUI":true,
			"bSort":false,
			"bPaginate":true
    });



    window.filter_all = function (id){
    		table.search(id).draw();
    }

    window.filter_column = function(col,id){
    		table.column(col).search(id).draw();
    }


    $('#refresh').click(function(event) {
   		history.go(0);
    }); 

  	$('#back').click(function(event) {
    		var back_link = $(this).attr('data-id');
			window.location.href=back_link;
	}); 

	$('.back').click(function(event) {
    		var back_link = $(this).attr('data-id');
			window.location.href=back_link;
	});

  	$('#add').click(function(event) {
			var back_link = $(this).attr('data-id');
			location.href=back_link;
	}); 

	$('#cancel').click(function(event) {
			event.preventDefault();
			var back_link = $(this).val();
			location.href=back_link;
	});

	$('.number').keypress(function(data) {
		if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))	{
		return false;
		}
	});


	//CURRENCY//
	window.toInteger = function(val){
    	var result;
		result = val.replace('Rp ', '');
		result = result.split('.').join('');
		result = parseInt(result);
		return result;
    }

	window.rupiah = function(val){	
    	var	reverse = val.toString().split('').reverse().join(''),
			rp 	= reverse.match(/\d{1,3}/g);
			rp	= rp.join('.').split('').reverse().join('');
			return 'Rp '+rp;
    }

    window.rupiahInput = function(id,target){

    	var val 	= $(id).autoNumeric('init',{aSep:'.',aDec:',',mDec: '0'});
		var target 	= $(id).parent().find(target);
		target.val(val.autoNumeric('get'));
		return;
    }

	


	//PENCARIAN//
	$('.show').change(function(event) {
		table.page.len($(this).val()).draw();
	});
   
    $('.search').keyup(function(event) {
		window.filter_all($(this).val());
	});    


});