$(document).ready(function(){
    $('.form_datetime').datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: "2017-01-01 10:00",
        minuteStep: 10
    });


    $('form#saveChartPlan').on('click','a.createChartPlanBackBtn',function () {
        window.history.back();
    });

    $('form#saveChartPlan').on('click','a.createChartPlanSaveBtn',function () {
        if($('select[name="isDefault"]').val() == 0 && $('select[name="clientSelect"]').val() == 0 ){
            new PNotify({
                title: 'Error!',
                text: 'Please select a Client for the Chart Plan',
                type: 'error'
            });
            return false;
        }else if($('input[name="planExpireDate"]').val() == ''){
            new PNotify({
                title: 'Error!',
                text: 'Please select a Expire date for the Chart Plan',
                type: 'error'
            });
            return false;
        }else if($('input[name="datasetCheck"]:checked').length == 0){
            new PNotify({
                title: 'Error!',
                text: 'Please select atlease one dataset for the Chart Plan',
                type: 'error'
            });
            return false;
        }else{
            var selectedDatasets = [];
            $('input[name="datasetCheck"]:checked').each(function(){
                selectedDatasets.push($(this).data('id'));
            });

            var params = [];
            params.push({name: 'clientId', value: $('select[name="clientSelect"]').val() });
            params.push({name: 'isActive', value: $('select[name="isActive"]').val() });
            params.push({name: 'isDefault', value: $('select[name="isDefault"]').val() });
            params.push({name: 'expireDate', value: $('input[name="planExpireDate"]').val() });
            params.push({name: 'planDescription', value: $('textarea[name="planDescription"]').val() });
            params.push({name: 'selectedDatasets', value: JSON.stringify(selectedDatasets) });
            params.push({name: '_token', value: $('input[name="_token"]').val()  });

            po.ajax({
                type: 'POST',
                url: '/chartPlan/save',
                data: params,
                success: function(respond) {
                    if (respond.status == false) {
                        new PNotify({
                            title: 'Error!',
                            text: respond.msg,
                            type: 'error'
                        });
                    }else if(respond.status == true){
                        new PNotify({
                            title: 'Success!',
                            text: respond.msg,
                            type: 'success'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        },2000);
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

    $('select[name="isDefault"]').on('change',function () {
        if($(this).val() == 1){
            $('div.clientSelectDiv').addClass('hidden');
            $('select[name="clientSelect"]').val('0');
        }else{
            $('div.clientSelectDiv').removeClass('hidden');
        }
    });
});