<?php
include('db.php');

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Placement Predictor</title>

		<style type="text/css">

		</style>
	</head>
	<body>
<script src="Highcharts/code/highcharts.js"></script>
<script src="Highcharts/code/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

<form action ="display.php" method="POST">
<p> Enter the id of the student: </p><input type="text" name="StudentID"><br/>
<input type="submit" name="submit" value="Predict">
</form>

<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Comparision of Departments'
    },
    subtitle: {
        text: 'Source: <a >Pi360 Database</a>'
    },
    xAxis: {
        categories: <?php echo $cat ?>,
        title: {
            text: "Department"
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'No.of Students',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: null
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: <?php echo $data ?>
});

		</script>


<div id="container_1" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
 <script type="text/javascript">

 Highcharts.chart('container_1', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Comparision of Batch'
    },
    subtitle: {
        text: 'Source: <a >Pi360 Database</a>'
    },
    xAxis: {
        categories: <?php echo $cat_1 ?>,
        title: {
            text: "Batch"
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'No.of Students',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: null
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: <?php echo $data_1 ?>
});
        </script>
<div id="container_2" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">

 Highcharts.chart('container_2', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Comparision of 10th board'
    },
    subtitle: {
        text: 'Source: <a >Pi360 Database</a>'
    },
    xAxis: {
        categories: <?php echo $cat_2 ?>,
        title: {
            text: "10th Board"
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'No.of Students',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: null
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: <?php echo $data_2 ?>
});
         </script>

 <div id="container_3" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">

 Highcharts.chart('container_3', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Comparision of 12th board'
    },
    subtitle: {
        text: 'Source: <a >Pi360 Database</a>'
    },
    xAxis: {
        categories: <?php echo $cat_3 ?>,
        title: {
            text: "12th Board"
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'No.of Students',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: null
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: <?php echo $data_3 ?>
});
        </script>
 <div id="container_4" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">

 Highcharts.chart('container_4', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Comparision of Father Occupations'
    },
    subtitle: {
        text: 'Source: <a >Pi360 Database</a>'
    },
    xAxis: {
        categories: <?php echo $cat_4 ?>,
        title: {
            text: "Father Occupations"
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'No.of Students',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: null
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }






































        
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: <?php echo $data_4 ?>
});
        </script>
 <div id="container_5" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">

 Highcharts.chart('container_5', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Comparision of Mother Occupations'
    },
    subtitle: {
        text: 'Source: <a >Pi360 Database</a>'
    },
    xAxis: {
        categories: <?php echo $cat_5 ?>,
        title: {
            text: "Mother's Occupation"
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'No.of Students',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: null
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: <?php echo $data_5 ?>
});
        </script>
	</body>
</html>
