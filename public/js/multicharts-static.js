$(document).ready(function(){

	$('div.multichartContainer').on('click','button#chartViewFilter',function(){
		$currentMultiChartDiv = $(this).closest('div#chartMultiViewDiv');
		var token = $('input[name="_token"]').val();
		var mainFilter = $currentMultiChartDiv.find('select[name="mainFilterSelect"]').find(":selected").val();
		var monthFilter = $currentMultiChartDiv.find('select[name="monthFilterSelect"]').find(":selected").val();
		var yearFilter = $currentMultiChartDiv.find('select[name="yearFilterSelect"]').find(":selected").val();
		var chartId = $currentMultiChartDiv.find('input[name="chartId"]').val();
		var datasetId = $currentMultiChartDiv.find('input[name="datasetId"]').val();

		//collect dynamic filters
		var dynamicFiltersList = [];
		$currentMultiChartDiv.find('select.customFilterSelect').each(function(){
			var columnName = $(this).data('name');
			var columnId = columnName.slice(-1);
			if($(this).find(":selected").val() != 0){
				dynamicFiltersList.push({name : columnName, value: $(this).find(":selected").val()});
			}
		});
	    po.ajax({
	        type: 'POST',
	        url: '/chart/filter',
	        data: {'mainFilter' : mainFilter,'monthFilter':monthFilter, 'yearFilter':yearFilter,'_token' : token,'datasetId':datasetId,'chartId':chartId,'dynamicFilters': dynamicFiltersList},
	        success: function(respond) {
	            if (respond.status == false) {
	            	new PNotify({
					    title: 'Error!',
					    text: respond.msg,
					    type: 'error'
					});
	            } else if(respond.status == true) {
                        $currentMultiChartDiv.find('div#singleChartContainer').empty();
                        $currentMultiChartDiv.find('div#singleChartContainer').html(respond.data.view);
					    $('html, body').animate({
					        scrollTop: $currentMultiChartDiv.find('div#singleChartContainer').offset().top
					    }, 2000);
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


	$('div.multichartContainer').on('click','button#addNewChartFilter',function(){
		$currentMultiChartDiv = $(this).closest('div#chartMultiViewDiv');
		var selectedCustomFilter = $currentMultiChartDiv.find('select[name="dynamicFilterSelect"] :selected').val();
		var selectedCustomFilterName = $currentMultiChartDiv.find('select[name="dynamicFilterSelect"] :selected').text();
		var chartId = $currentMultiChartDiv.find('input[name="chartId"]').val();
		var datasetId = $currentMultiChartDiv.find('input[name="datasetId"]').val();
		var token = $('input[name="_token"]').val();

		if(selectedCustomFilter == 0){
        	new PNotify({
			    title: 'Error!',
			    text: 'Please select a column to create the filter',
			    type: 'error'
			});
			return false;			
		}else{
		    po.ajax({
		        type: 'POST',
		        url: '/chart/dataset/'+datasetId+'/filter/'+selectedCustomFilter+'/getValues',
		        data: {'_token' : token},
		        success: function(respond) {
		            if (respond.status == false) {
		            	new PNotify({
						    title: 'Error!',
						    text: respond.msg,
						    type: 'error'
						});
		            } else if(respond.status == true) {
		            	if(respond.data.length > 0){
			            	var filterValues = respond.data;
			            	$defaultCustomFilter = $currentMultiChartDiv.find('div.customFilterDefaultDiv').clone();
			            	$defaultFilterSelect = $defaultCustomFilter.find('select[name="customFilterDefaultSelect"]');
		            		for (var i = 0; i <= filterValues.length-1; i++) {
		            			var optionHtml = "<option class='filterValues' value="+filterValues[i]+">"+filterValues[i]+"</option>";
		            			$(optionHtml).insertAfter($defaultFilterSelect.find('option[name="filterDefaultOption"]'));	
		            		}

		            		$defaultFilterSelect.attr('name',selectedCustomFilter+'-filterSelect');
		            		$defaultFilterSelect.addClass('customFilterSelect');
		            		$defaultFilterSelect.data('name',selectedCustomFilter);
		            		$defaultCustomFilter.find('label.filterLabel').html(selectedCustomFilterName);
		            		$defaultCustomFilter.removeClass('hidden');
		            		$defaultCustomFilter.removeClass('customFilterDefaultDiv');
		            		$defaultCustomFilter.addClass('customFiltersDiv');
		            		$defaultCustomFilter.insertBefore($currentMultiChartDiv.find('div.customFilterDefaultDiv'));
		            		$currentMultiChartDiv.find('select[name="dynamicFilterSelect"]').prop('selectedIndex',0);
		            	}
		            	

		            }else{
		            	new PNotify({
						    title: 'Error!',
						    text: 'Something went wrong..!',
						    type: 'error'
						});
		            }
		        }
		    });	
		}


	});


	$('div.multichartContainer').on('click','button#chartViewReset',function(){
		$currentMultiChartDiv = $(this).closest('div#chartMultiViewDiv');

		$currentMultiChartDiv.find('select[name="mainFilterSelect"]').prop('selectedIndex',0);
		$currentMultiChartDiv.find('select[name="monthFilterSelect"]').prop('selectedIndex',0);
		$currentMultiChartDiv.find('select[name="yearFilterSelect"]').prop('selectedIndex',0);
		$currentMultiChartDiv.find('div.dynamicFiltersDiv').find('div.customFiltersDiv').remove();
		$currentMultiChartDiv.find('button#chartViewFilter').trigger('click');
	});
});