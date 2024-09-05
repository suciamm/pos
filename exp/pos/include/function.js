
//FILE
function readImage(input) 
{
	if(input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) 
		{
			$('#previewImage').attr('src', e.target.result);
			$('#previewImage').hide();
			$('#previewImage').fadeIn(650);
		}

		reader.readAsDataURL(input.files[0]);
	}
}

function getfileNeme(e)
{
	var val = e.target.files[0].name;
	return val;
}

function getfileSize(e)
{
	var val = e.target.files[0].size;
	return val;
}

function getfileExt(e,filename)
{
	var val = filename.split('.').pop().toLowerCase();
	return val;
}





//SHOW 
function error(id,msg){
	$(id).addClass('no-valid');
	$(id).parent().find('.text-danger').show();
	$(id).parent().find('.text-danger').text(msg);		
	$(id).closest('input').removeClass('is-valid');
	$(id).closest('input').addClass('is-invalid');
	$(id).closest('select').removeClass('is-valid');
	$(id).closest('select').addClass('is-invalid');
	$(id).closest('textarea').removeClass('is-valid');
	$(id).closest('textarea').addClass('is-invalid');
}

function success(id)
{	
	$(id).removeClass('no-valid');
	$(id).parent().find('.text-danger').hide();		
	$(id).closest('input').removeClass('is-invalid')
	$(id).closest('select').removeClass('is-invalid')
	$(id).closest('textarea').removeClass('is-invalid');
}

function file_error(id,msg) {
	$(id).parent().find('.text-danger').show();
	$(id).parent().find('.text-danger').text(msg);
	$(id).closest('input').addClass('is-invalid');
}

function file_success(id)
{
	$(id).parent().find('.text-danger').hide();
	$(id).closest('input').removeClass('is-invalid');
	$(id).closest('input').addClass('is-valid');
}

function loading(text){
	$('body').loadingModal({
			text 			: text, 
			positionc		: 'auto',
			backgroundColor	: 'rgb(0, 0, 0)',
			animation 		: 'fadingCircle'
	});
}

function alertDanger(msg) {
	var txt ='';
	txt += "<div class='col-md-12 alert bg-red alert-dismissable'>";
	txt += " <a href='#' class='close' data-dismiss='alert' aria-label='close'> ×</a> "+msg;
	txt += "</div>";
	return txt;
}



function alertSuccess(msg) {
	var txt ='';
	txt += "<div class='col-md-12 alert bg-green text-dark alert-dismissable'>";
	txt += " <a href='#' class='close' data-dismiss='alert' aria-label='close'> ×</a> "+msg;
	txt += "</div>";
	return txt;
}




//COOKIE
function getCookie(name) {
	var cookie = $.cookie(name);
	return cookie;
}

function setCookie(name,value) {
	$.cookie(name,value);
}

function removeCookie(name) {
	$.removeCookie(name)
}

function clearCookie() {
	var cookies = $.cookie();
	for(var cookie in cookies) {
	   $.removeCookie(cookie);
	}
}

