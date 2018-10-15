$(document).ready(function(){
	var files;
	$('form#datasetImport').submit(function(e){
		e.preventDefault();
		if($(this).find('input[name="dataImport"]').val() == ''){
        	new PNotify({
			    title: 'Error!',
			    text: 'Please select a file first',
			    type: 'error'
			});	
			return false;
		}else if($(this).find('input[name="dataSetName"]').val() == ''){
        	new PNotify({
			    title: 'Error!',
			    text: 'Please enter a name for the Dataset',
			    type: 'error'
			});	
			return false;		
		}
		var token = $('input[name="_token"]').val();
		// var data = $(this).serialize();
		var data = new FormData();
	    $.each(files, function(key, value)
	    {
	        data.append(key, value);
	    });
	    data.append('_token',token);
	    data.append('hasHeader',$(this).find('input[name="hasHeader"]').is(':checked'));
	    data.append('dataSetName',$(this).find('input[name="dataSetName"]').val());
	    data.append('department',$(this).find('select[name="departmentSelect"]').val());
	    data.append('contentDescription',$(this).find('textarea[name="contentDescription"]').val());
	    po.ajax({
	        type: 'POST',
	        url: $(this).attr('action'),
	        data: data,
	        dataType: 'json',
	        processData: false,
	        contentType: false,	        
	        success: function(respond) {
	            if (respond.status == false) {
	            	new PNotify({
					    title: 'Error!',
					    text: respond.msg,
					    type: 'error'
					});
	            } else if(respond.status == true) {
	            	new PNotify({
					    title: 'Success!',
					    text: respond.msg,
					    type: 'success'
					});
					$('form#datasetImport')[0].reset();	            	
	            	$('div.sucessButtonList').removeClass('hidden');
	            }else{
	            	new PNotify({
					    title: 'Error!',
					    text: 'Something went wrong..!',
					    type: 'error'
					});
	            }
	        }
	    });

	});

	$('form#datasetImport').on('change','input[name="dataImport"]',function(e){
	 	files = e.target.files;
	});
});