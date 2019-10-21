jQuery(document).ready(function($){
	
	$('.phoen-endpoint-container li .header').click(function(){
	
		if($(this).next('div').css('display')!='none'){
			$(this).next('div').hide();
		}else{
			$(this).next('div').show();
		}
	
	});

	/******* Sort Endpoint ********/
	$(function() {
		$( "#sortable" ).sortable();
	});
	update_list_endpoint = function(){
		var fields = new Array();
			
			$('li .phoen-endpoint-order').each(function(i){

				fields[i] = $(this).val();
		});
			$( 'input.endpoints-order' ).val( fields.join(',') );
		
	};
	
	$('.endpoints li').mouseleave(function(){
		//alert();
		update_list_endpoint();	
	});
	
	$('#submit').click(function(){
		
		update_list_endpoint();	
	});

});