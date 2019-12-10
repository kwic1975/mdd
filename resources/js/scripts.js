$(document).ready(function(){
		$(document).on('change','#variable_type',function(){
				var type=$("#variable_type").val();
				window.location.href="edit-dict.php?type="+type;
			});
		$(document).on('change','#variable_name',function(){
				var type=$("#variable_type").val();
				var name=$("#variable_name").val();
				window.location.href="edit-dict.php?type="+type+"&var="+name;
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
				url: "front_ajax.php",
				method:"POST",
				data: formData,
				processData: false,
				contentType: false,
				success:function(response)
				{
				    //console.log(response);
					response=JSON.parse(response);
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
	});
