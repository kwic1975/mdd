function ps_notify(type, msg) {
    if ($('.ps-notify-cont').length === 0) {
        $('body').append('<div class="ps-notify-cont"></div>');
    }
    var fade_speed = 500;
    var remove_after = 3000;
    var noti_id = '_' + Math.random().toString(36).substr(2, 9);
    var noti = '<div style="display: none;" id=ps-noti-' + noti_id + ' class="ps-notify-alert ' + type + '">' + msg + '<span class="ps-notify-close">&times;</span></div>';
    $('.ps-notify-cont').append(noti);
    $("#ps-noti-" + noti_id).fadeIn(fade_speed, function() {
        var timer = new Timer(function() {
            $("#ps-noti-" + noti_id).fadeOut(fade_speed, function() {
                $(this).remove();
            });
        }
        ,remove_after);
        $("#ps-noti-" + noti_id)[0].timer = timer;
        $("#ps-noti-" + noti_id).hover(function() {
            $(this)[0].timer.pause();
        }, function() {
            $(this)[0].timer.resume();
        });
        $("#ps-noti-" + noti_id).click(function() {
            window.clearTimeout($(this)[0].timer);
            $(this).fadeOut(fade_speed, function() {
                $(this).remove();
            });
        });
    });
}
function update_act_date()
{
	if($('#act_indicator').is(":checked")==false)
	{
		$("#Indate").datepicker("setDate", 'today');
		$('#Indate').attr('disabled',true);
	}
	else
	{
	    if($('#Indate').attr('data-empty')=="off")
	    {
	        var date=$('#Indate').attr('value');
	        $("#Indate").datepicker("setDate", date);
	        $('#Indate').attr('disabled',false);    
	    }
		else
		{
		    $('#Indate').attr('disabled',false);
		    $('#Indate').val('');    
		}
	}
}
jQuery(document).ready(function(){
	jQuery(document).bind("ajaxStart", function(){
		// console.log('dss');
		jQuery(".ajax_loading").show();
	}).bind("ajaxStop", function(){
		jQuery(".ajax_loading").hide();
	});
	$(document).ajaxError(function( event, jqXHR, ajaxSettings, thrownError ) {
		//console.log(jqXHR.status);
		if (jqXHR.status === 0) {
			ps_notify('danger',"Not connect. Verify Network.");
		} 
		else if (jqXHR.status == 401) {
			ps_notify('danger',"Session Expired! Please login");
			setTimeout(function(){
				window.location.href=SITE_URL;
			}, 1000);
		}
		else if (jqXHR.status == 404) {
			ps_notify('danger',"Requested page not found. [404]");
		} else if (jqXHR.status == 500) {
			ps_notify('danger',"Internal Server Error [500].");
		} else if (thrownError === "parsererror") {
			ps_notify('danger',"Requested JSON parse failed.");
		} else if (thrownError === "timeout") {
			ps_notify('danger',"Time out error.");
		} else if (thrownError === "abort") {
			ps_notify('danger',"Ajax request aborted.");
		} else {
			ps_notify('danger',"Uncaught Error. "+ jqXHR.responseText);
		}
		$(".ajax_loading").hide();
	});
	$(document).on('click','.restore_lgc',function(){
		var data_table = $(this).attr('data-table');
		if (confirm('Are you sure you want to continue?')) {
			$.ajax({
				type:'post',
				url:SITE_URL+'/front_ajax.php',
				data:'RestoreData=action&table='+data_table,
				success:function(response){
					if(typeof response =='object'){
						if(response.status==1)
						{
							$('#error2').html('Successfully Restored.');
							$('#error2').addClass('alert-success');
							$('#error2').show();
						}
						else
						{
							var error_msg = "";
							jQuery.each(response.errors, function( index, error ) {
								error_msg += "<li>"+error+"</li>";
							});
							$('#error2').html(error_msg);
							$('#error2').addClass('alert-danger');
							$('#error2').show();
						}
					}else{
						$('#error2').html(response);
						$('#error2').addClass('alert-danger');
						$('#error2').show();
					}
				}
			})
		}else{
			// ok 
		}
		return false;
	});
    $(document).on('change','#variable_type',function(){
    	var type=$("#variable_type").val();
    	window.location.href="edit-dict.php?type="+type;
    });
    $(document).on('change','#variable_name',function(){
    	var type=$("#variable_type").val();
    	var name=$("#variable_name").val();
    	window.location.href="edit-dict.php?type="+type+"&var="+name;
    });
    $(document).on('change','#act_indicator',function(){
    	update_act_date();
    });
    
    $(document).on('submit','.update-field-form',function(){
		event.preventDefault();
		var next=$(this).attr('data-next');
		var formData = new FormData($(this)[0]);
		var Name=$('#field_name').val();
		formData.append('action', 'UpdateField');
		formData.append('field', Name);
		$.ajax({
			url: "front_ajax.php",
			method:"POST",
			data: formData,
			processData: false,
			contentType: false,
			success:function(response)
			{
				if(response.error==0)
				{
					window.location.href="edit-field.php?field="+encodeURIComponent(Name)+"&tab="+next;
				}
				else
				{
					alert("Failed");
				}
			}
		});
	});
    
    $(document).on('submit','.update-file-form',function(){
    	event.preventDefault();
    	var next=$(this).attr('data-next');
    	var formData = new FormData($(this)[0]);
    	var Name=$('#file_name').val();
    	formData.append('action','UpdateFile');
    	formData.append('file', Name);
    	$.ajax({
    		url: SITE_URL+"/front_ajax.php",
    		method:"POST",
    		data: formData,
    		processData: false,
    		contentType: false,
    		success:function(response)
    		{
    			//console.log(response);
    			if(response.error==0)
    			{
    				window.location.href="edit-file.php?file="+encodeURIComponent(Name)+"&tab="+next;
    			}
    			else
    			{
    				console.log(response);
    			}
    		}
    	});
    });	
    		
    $(document).on('submit','.update-dict-form',function(){
    	event.preventDefault();
    	var next=$(this).attr('data-next');
    	var formData = new FormData($(this)[0]);
    	var Type=$('#variable_type').val();
    	var Name=$('#variable_name').val();
    	formData.append('action', 'UpdateDict');
    	formData.append('type', Type);
    	formData.append('var', Name);
    	$.ajax({
    		url: SITE_URL+"/front_ajax.php",
    		method:"POST",
    		data: formData,
    		processData: false,
    		contentType: false,
    		success:function(response)
    		{
    			//console.log(response);
    			if(response.error==0)
    			{
    				window.location.href="edit-dict.php?type="+Type+"&var="+Name+"&tab="+next;
    			}
    			else
    			{
    				alert("Failed");
    			}
    		}
    	});
    });
    $(document).on('submit','#add-dictionary-form',function(){
    	var formData = new FormData($(this)[0]);
    	$.ajax({
    		url: SITE_URL+"/front_ajax.php",
    		method:"POST",
    		data: formData,
    		processData: false,
    		contentType: false,
    		success:function(response)
    		{
    			// response=JSON.parse(response);
    			if(typeof response =='object'){
    				// response=JSON.parse(response);
    				if(response.status==1)
    				{
    					window.location.href="edit-dict.php?type="+response.type+"&var="+response.name+"&tab=1";
    				}
    				else
    				{
    					var error_msg = "";
    					jQuery.each(response.errors, function( index, error ) {
    						error_msg += "<li>"+error+"</li>";
    					});
    					$('#error1').html(error_msg);
    					$('#error1').show();
    				}
    			}else{
    				$('#error1').html(response);
    				$('#error1').show();
    			}
    		}   
    	});
    	return false;
    });
    $(document).on('submit','#add-file-form',function(){
    	var formData = new FormData($(this)[0]);
    	$.ajax({
    		url: SITE_URL+"/front_ajax.php",
    		method:"POST",
    		data: formData,
    		processData: false,
    		contentType: false,
    		success:function(response)
    		{
    			// response=JSON.parse(response);
    			if(typeof response =='object'){
    				// response=JSON.parse(response);
    				if(response.status==1)
    				{
    					window.location.href="edit-file.php?file="+response.file+"&tab=1";
    				}
    				else
    				{
    					var error_msg = "";
    					jQuery.each(response.errors, function( index, error ) {
    						error_msg += "<li>"+error+"</li>";
    					});
    					$('#error1').html(error_msg);
    					$('#error1').show();
    				}
    			}else{
    				$('#error1').html(response);
    				$('#error1').show();
    			}
    		}
    	});
    	return false;
    });
    $(document).on('click','#import-dict',function(){
    	var fileType = ".csv";
    	if($("#file").val()==''){
    			$('#error3').html("Please select CSV File");
    			$('#error3').show();
    	}else{
    		var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:()])+(" + fileType + ")$");
    		if (!regex.test($("#file").val().toLowerCase())) {
    			
    			$('#error3').html("Invalid File. Upload only " + fileType + " Files.", "danger");
    			$('#error3').show();
    			}
    		else{
    			$('#import-dict').submit();
    		}
    	}
    	return false;
    });
    $(document).on('submit','#import-dictionary-csv',function(){
    	var $form = jQuery("#import-dictionary-csv");
    	var formData = new FormData($form[0]);
    	formData.append("import-csv","action");
    	$.ajax({
    		type: "POST",
    		url:"front_ajax.php",
    		data: formData,
    		processData: false,
    		contentType: false,
    		success: function(response){
    			//console.log(response);
    			if(response.status==1){
    			    $('#error3').hide();
    				$('#import-success').html("Imported Succesfully");
    				$('#import-success').show();
    			}
    			else{
    				var error_msg = "";
    					jQuery.each(response.errors, function( index, error ) {
    						error_msg += "<li>"+error+"</li>";
    					});
    					$('#import-success').hide();
    					$('#error3').html(error_msg);
    					$('#error3').show();
    				}
    		}
    	});
    	return false;
    });
    
    $(document).on('click','#import-field',function(){
		var fileType = ".csv";
		if($("#file").val()==''){
				$('#error3').html("Please select CSV File");
    			$('#error3').show();
		}else{
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:()])+(" + fileType + ")$");
			if (!regex.test($("#file").val().toLowerCase())) {
			   $('#error3').html("Invalid File. Upload only " + fileType + " Files.", "danger");
    			$('#error3').show();
			}
			else{
				$('#import-field').submit();
			}
		}
		return false;
		});
		$(document).on('submit','#import-field-csv',function(){
			var $form = jQuery("#import-field-csv");
			var formData = new FormData($form[0]);
			formData.append("import-field-csv","action");
			$.ajax({
				type: "POST",
				url:"front_ajax.php",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response){
					if(response.status==1){
						$('#error3').hide();
    			    	$('#import-success').html("Imported Succesfully");
    				    $('#import-success').show();
					}
					else{
						var error_msg = "";
    					jQuery.each(response.errors, function( index, error ) {
    						error_msg += "<li>"+error+"</li>";
    					});
    					$('#import-success').hide();
    					$('#error3').html(error_msg);
    					$('#error3').show();
					}
				}
			});
			return false;
		});
    
     $(document).on('click','#import-file',function(){
		var fileType = ".csv";
		if($("#file").val()==''){
				$('#error3').html("Please select CSV File");
    			$('#error3').show();
		}else{
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:()])+(" + fileType + ")$");
			if (!regex.test($("#file").val().toLowerCase())) {
			   $('#error3').html("Invalid File. Upload only " + fileType + " Files.", "danger");
    			$('#error3').show();
			}
			else{
				$('#import-file').submit();
			}
		}
		return false;
		});
		$(document).on('submit','#import-file-csv',function(){
			var $form = jQuery("#import-file-csv");
			var formData = new FormData($form[0]);
			formData.append("import-file-csv","action");
			$.ajax({
				type: "POST",
				url:"front_ajax.php",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response){
					if(response.status==1){
						$('#error3').hide();
    			    	$('#import-success').html("Imported Succesfully");
    				    $('#import-success').show();
					}
					else{
						var error_msg = "";
    					jQuery.each(response.errors, function( index, error ) {
    						error_msg += "<li>"+error+"</li>";
    					});
    					$('#import-success').hide();
    					$('#error3').html(error_msg);
    					$('#error3').show();
					}
				}
			});
			return false;
		});

    
    
    
    $(document).on('submit','#add-field-form',function(){
    	var formData = new FormData($(this)[0]);
    	$.ajax({
    		url: SITE_URL+"/front_ajax.php",
    		method:"POST",
    		data: formData,
    		processData: false,
    		contentType: false,
    		success:function(response)
    		{
    			// response=JSON.parse(response);
    			if(typeof response =='object'){
    				if(response.status==1)
    				{
    					window.location.href="edit-field.php?field="+response.field+"&tab=1";
    				}
    				else
    				{
    					var error_msg = "";
    					jQuery.each(response.errors, function( index, error ) {
    						error_msg += "<li>"+error+"</li>";
    					});
    					$('#error1').html(error_msg);
    					$('#error1').show();
    				}
    			}else{
    				$('#error1').html(response);
    				$('#error1').show();
    			}
    		}
    	});
    	return false;
    });
    var stickyOffset = $('.stick_to_top').offset().top;
	$(window).scroll(function(){
	  var sticky = $('.stick_to_top'),
		  scroll = $(window).scrollTop();

	  if (scroll >= stickyOffset) sticky.parent().addClass('fixed');
	  else sticky.parent().removeClass('fixed');
	});
});