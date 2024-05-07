$(document).ready(function() {
	
	$.notify.addStyle('warning', {
		html: 
			'<div>'+
					'<i class="fa fa-warning text-warning"></i> <span data-notify-text/>'+
			'</div>',
		classes: {
			notifWarning: {
				"color":"#fff",
				"background-color":"#2f333e",
				"padding-top":"30px",
				"padding-bottom":"30px",
				"padding-left":"30px",
				"padding-right":"30px",
				"opacity":"0.9",
			}
		}
	});



	$.notify.addStyle('success', {
		html: 
			'<div>'+
					'<i class="fa fa-check"></i> <span data-notify-text/>'+
			'</div>',
		classes: {
			notifSuccess: {
				"color":"#fff",
				"background-color":"#28a745",
				"padding-top":"30px",
				"padding-bottom":"30px",
				"padding-left":"30px",
				"padding-right":"30px",
				"opacity":"0.9",
			}
		}
	});



	$.notify.addStyle('danger', {
		html: 
			'<div>'+
					'<i class="fa fa-close"></i> <span data-notify-text/>'+
			'</div>',
		classes: {
			notifDanger: {
				"color":"#fff",
				"background-color":"#dc3545",
				"padding-top":"30px",
				"padding-bottom":"30px",
				"padding-left":"30px",
				"padding-right":"30px",
				"opacity":"0.9",
			}
		}
	});

});

function notification(msg,position,style,className,showTime) 
{
	$.notify(msg, {						
			position:position,				 		
	 		clickToHide: true,
			autoHide: true,
			autoHideDelay: showTime,
			style: style,
			className: className
	});
}