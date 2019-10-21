jQuery(document).ready(function($){
	
	$('.pho-user-image').click(function(){
	$('.pho-myaccount-popup-body').show();
	//alert();
});
$('.pho-close_btn').click(function(){
	$('.pho-myaccount-popup-body').hide();
	
});
$('.pho-myaccount-popup-body .pho-modal-box-backdrop').click(function(){
	
	$('.pho-myaccount-popup-body').hide();
});


});