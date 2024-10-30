jQuery(document).ready(function($) {
	/* Tabs handler. */
	var tabs = $("#tabs").tabs({
        fx: {
            opacity: 'toggle',
            duration: 'slow'
        }
    });
	
	/* Custom switch onoff buttons. */
	$('.on').on('click', function(e, data) {
		id = this.id;
		$( ".on" ).addClass( "onactive" );
		$( ".off" ).removeClass( "offactive" );
		
		$('.itmfw_'+id+'').val('1');
	});
	
	$('.off').on('click', function(e, data) {
		id = this.id;
		$( ".off" ).addClass( "offactive" );
		$( ".on" ).removeClass( "onactive" );
		
		$('.itmfw_'+id+'').val('0');
	})
	
	
	/*  Ajax form submit */
	$( ".itm_save_btn" ).click(function() {
	  $( ".itmfw_options_form" ).submit();
	});
	
	/* Post form data */
	$('.itmfw_options_form').submit( function () {
			var btn = $(".itm_save_btn");
			btn.button('loading')
			$(".ajaxloader").show();
			
			var itmfw_options =  $(this).serialize();
	
			$.ajax({
				type: "POST",
				url: "options.php",
				data: itmfw_options,
				timeout: 3000,
				success: function() {
					$(".ajaxloader").hide();
					/* Button Reset */
					btn.button('reset')
					
					$('.itmfw_response').html("<div class='divSuccessMsg'></div>");
					$('.divSuccessMsg').html("<span class='success'><i class='fa fa-check'></i> Settings Saved!</span>")
					.hide()
					.fadeIn(1500, function() { $('.divSuccessMsg'); });
					setTimeout(function(){
						$('.divSuccessMsg').fadeOut();
					},7000);
				},
			  error: function() {
					$(".ajaxloader").hide();
					/* Button Reset */
					btn.button('reset')
					
					$('.itmfw_response').html("<div class='divErrorMsg'></div>");
					$('.divErrorMsg').html("Something is going wrong... Please contact support team.")
					.hide()
					.fadeIn(1500, function() { $('.divErrorMsg'); });
			    }
			});
			return false;
	});
	
	//Remove image thumbnail.
	jQuery('.remove').click(function(e){
		id = this.id;
		$('.img_prev_'+id+'').hide();
		$('#up_'+id+'').val("");
	});
	
	/* media upload start */
	jQuery('.itmfw_upload_button').click(function() {
         targetfield = jQuery(this).prev('.upload-url');
		 imgid = this.id;
         tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
         return false;
    });
 
    window.send_to_editor = function(html) {
         imgurl = jQuery('img',html).attr('src');
         jQuery(targetfield).val(imgurl);
		 $('.img_prev_'+imgid+'').show();
		 $('#itmfw-img-'+imgid+'').attr('src', imgurl);
         tb_remove();
    }
	/* media upload end */

});
