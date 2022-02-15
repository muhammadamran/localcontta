<?php if ($_GET['month'] == '') { ?>
  <div class="panel-heading">
    <p><b>No Data Shown in Chart!</b></p>
  </div>
<?php } else { ?>
  <?php 
  $monthnow = $_GET['month'];
  $yearnow = $_GET['year'];
  mysql_connect('localhost', 'root','');
  mysql_select_db('contta'); 
  $chart = mysql_query("SELECT * FROM tb_record_master INNER JOIN tb_record_ship_exe ON tb_record_master.rcd_id=tb_record_ship_exe.rcd_id  WHERE tb_record_master.rcd_create_month='$monthnow' AND tb_record_master.rcd_create_year='$yearnow'");
  $getchart = mysql_num_rows($chart);
  ?>
  <div class="panel-heading">                                
    <script type="text/javascript">
      window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
          // "light1", "light2", "dark1", "dark2"
          theme: "light2",
          exportEnabled: true,
          animationEnabled: true,
          title: {
            text: "Performance Trucking Level"
          },
          data: [{
            type: "pie",
            startAngle: 25,
            toolTipContent: "<b>{label}</b>: {y}%",
            showInLegend: "true",
            legendText: "{label}",
            indexLabelFontSize: 16,
            indexLabel: "{label} - {y}",
            dataPoints: [
            { y: "<?php echo $getchart;?>", label: "AllRecords" },
            { y: 27.34, label: "Internet Explorer" },
            { y: 0.44, label: "Others" }
            ]
          }]
        });
        chart.render();
      }
    </script>
    <div id="chartContainer" style="height: 300px; max-width: 900px; margin: 0px auto;"></div>
    <script src="thirdparty/chart/canvasjs.min.js"></script>
  </div>
<?php } ?>
