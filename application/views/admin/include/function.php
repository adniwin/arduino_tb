<script>
    var url = '<?= ADMIN_WEBAPP_URL; ?>';

    function logoutModal() {
        $('#logoutModal').modal('show');
    }

    function logoutProcess() {
        $.ajax({
            url: url + 'logout',
            method: 'GET',
            success: function (response) {
                setTimeout(function ()
                {
                    window.location.href = "<?= site_url(); ?>login";
                }, 1000);
            }
        });
    }

    function predictModal() {
        $('#predictModal').modal('show');
    }

    function loadData() {
        function getFixedDate(date_input) {
            var d = new Date(date_input);
            var curr_date = d.getDate();
            var curr_month = d.getMonth() + 1; //Months are zero based
            var curr_year = d.getFullYear();
            var h = d.getHours();
            if (h < 10) {
                var h = '0' + h;
            }
            var m = d.getMinutes();
            if (m < 10) {
                var m = '0' + m;
            }
            var fixed_date = curr_date + "-" + curr_month + "-" + curr_year + " " + h + ":" + m;
            return fixed_date;
        }

        function getElementData(input) {
            var array = [];
            $.each(input, function (i, val) {
                var fixed_date = getFixedDate(val[0]);
                array.push({"label": fixed_date, 'y': val[1]})
            });
            return array;
        }

        $.getJSON("<?php echo BASE_URL . 'admin/data_graphic'; ?>", function (obj) {


            var suhu = getElementData(obj['suhu']);
            var lembab = getElementData(obj['lembab']);
            var cahaya = getElementData(obj['cahaya']);
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "theme2",
                zoomEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Arduino Sensor Graphic"
                },
                toolTip: {
                    content: "{name}: {y}"
                },
                axisX: {
                    labelFontSize: 13,
                },
                data: [
                    {
                        type: "spline",
                        showInLegend: true,
                        markerType: "circle",
                        legendText: "Temparature",
                        name: "Temparature",
                        dataPoints: suhu,
                    }, {
                        type: "spline",
                        showInLegend: true,
                        markerType: "circle",
                        legendText: "Humidity",
                        name: "Humidity",
                        dataPoints: lembab,
                    },
                    {
                        type: "spline",
                        showInLegend: true,
                        markerType: "circle",
                        legendText: "Light",
                        name: "Light",
                        dataPoints: cahaya,
                    },
                ]
            });
            var updateChart = function () {
                $.getJSON("<?php echo BASE_URL . 'admin/data_graphic'; ?>", function (obj) {
                    var suhu = getElementData(obj['suhu']);
                    var lembab = getElementData(obj['lembab']);
                    var cahaya = getElementData(obj['cahaya']);
                    chart.options.data[0].dataPoints = suhu;
                    chart.options.data[1].dataPoints = lembab;
                    chart.options.data[2].dataPoints = cahaya;
                    chart.render();
                });
            };

            chart.render();
            setInterval(function () {
                updateChart();
            }, 1000);
        });


    }

    function predictProcess() {
        $('#predictModal').modal('hide');

        $.ajax({
            url: url + 'predict',
            method: 'GET',
            success: function (response) {
                $('#predict_result').html('<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><span class="sr-only"></span>');
                setTimeout(function ()
                {
                    var res = JSON.parse(response);                    
                    $('#predict_result').html(res.prediction + ' (' + res.time + ')');
                }, 2000);


            }
        });
    }


</script>

