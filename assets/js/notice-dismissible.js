'use strict';jQuery(function($){$(document).on('click','.ac-notice__dismiss, [data-dismiss]',function(e){e.preventDefault();var $notice=$(this).closest('.ac-notice');var dismissible_callback=$notice.data('dismissible-callback');if(dismissible_callback){$.post(ajaxurl,dismissible_callback)}$notice.fadeOut(500,function(){$notice.remove()})})});