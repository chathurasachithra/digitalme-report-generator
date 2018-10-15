$(document).ready(function() {

    //
    // $('form#chartTypeSelect').submit(function (e) {
    //     e.preventDefault();
    //     var selectedChartTypeId = $('select[name="chartTypeChooser"] :selected').val();
    //     var selectedDepartmentId = $('input[name="departmentId"]').val();
    //     var selectedDatasetId = $('input[name="datasetId"]').val();
    //
    //     window.location.href = "/department/" + selectedDepartmentId + "/dataset/"+selectedDatasetId+"/chartType/"+selectedChartTypeId+"/viewcharts/";
    // });

    $("#departmentChooser").imagepicker({
        show_label : true,
        clicked:function (option) {
            var clickingDepartment = this.val();
            window.location.href = "/department/" + clickingDepartment + "/viewDatasets/";
        }
    });

    $("#datasetChooser").imagepicker({
        show_label : true,
        clicked:function (option) {
            var clickingDataset = this.val();
            var selectedDepartmentId = $('input[name="departmentId"]').val();
            window.location.href = "/department/" + selectedDepartmentId + "/dataset/"+clickingDataset+"/viewcharts";
        }
    });

    $("#chartTypeChooser").imagepicker({
        show_label : true,
        clicked:function (option) {
            var clickingChartTypeId = this.val();
            var selectedDepartmentId = $('input[name="departmentId"]').val();
            var selectedDatasetId = $('input[name="datasetId"]').val();

            window.location.href = "/department/" + selectedDepartmentId + "/dataset/"+selectedDatasetId+"/chartType/"+clickingChartTypeId+"/viewcharts/";
        }
    });

    $("#chartChooser").imagepicker({
        show_label : true,
    });

    $(".chartListView").on('click',function () {
        var selectedCharts = [];
        $('#chartChooser :selected').each(function(){
            selectedCharts.push($(this).val());
        });
        if(selectedCharts.length == 0){
            new PNotify({
                title: 'Error!',
                text: 'Please select a chart to view..!',
                type: 'error'
            });
        }else if(selectedCharts.length == 1){
            if(selectedCharts[0] == 'datatable'){
                var selectedDatasetId = $('input[name="datasetId"]').val();
                var url = '/dataset/view/'+selectedDatasetId;
            }else{
                var url = '/chart/view/'+selectedCharts[0];
            }
            window.open(url);
        }else{
            if(selectedCharts.indexOf('datatable') >= 0){
                selectedCharts.splice(selectedCharts.indexOf('datatable'),1);
            }
            var link = '/chart/viewMultiple?charts='+JSON.stringify(selectedCharts);
            window.open(link);
        }
    });
});