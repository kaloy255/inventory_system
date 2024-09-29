<?php 
  require('session.php');

  require "chart_data.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#121C20]">
<nav class="w-full flex items-center justify-between py-2 pl-10 pr-20">
        <img src="assets/logo.svg" alt="">

        <div class="flex items-center gap-5">
        <div class="flex items-center gap-1 border-[1px] px-5 py-1 rounded-full border-[#626D6E]" id="dashboard">
            <img src="assets/dashboard-icon.svg" alt="" width="20">
            <p class="text-[#626D6E] text-sm"><a href="home.php">Dashboard</a></p>
        </div>
        <div class="flex items-center gap-1 border-[1px] px-5 py-1 rounded-full border-[#626D6E]" id="inventory">
            <img src="assets/inventory-icon.svg" alt="" width="20" >
            <p class="text-[#626D6E] text-sm"><a href="view_inventory.php">Inventory</a></p>
        </div>
        </div>

        <div class="relative z-10">
        <!-- profile -->
        <div class="w-9 h-9 bg-[#F3A952] rounded-full z-10" id="profile">
            <div class="absolute -bottom-[4.3rem] left-0 bg-[#2B3942] w-24 py-2 rounded-lg hidden" id="profile_option">
            <div class="hover:bg-[#455863]">
            <a href="" class="text-white text-sm ml-3">Settings</a>
            </div>
            <div class="hover:bg-[#455863]">
            <a href="logout.php" class="text-white text-sm ml-3 ">Logout</a>
            </div>
            
            </div>
        </div>
        </div>
    </nav>

  <div class="px-[25px]">

    <figure class="highcharts-figure">
      <div id="container" class="w-full "></div>
    </figure>

    <div class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-10 place-items-center">
        <div class="w-56 bg-[#1A262D] h-28 flex flex-col items-center justify-center gap-1 rounded-lg">
          <div class="text-[#626D6E] flex items-center gap-2 self-start pl-5 "><div class="w-[20px] h-[20px] bg-[#45C8FF] rounded-full"></div><?= $categories[0] ?></div>
          <p class="font-bold text-white tracking-wider	"><?= $beverageCount ?></p>
        </div>

        <div class="w-56 bg-[#1A262D] h-28 flex flex-col items-center justify-center gap-1 rounded-lg">
          <div class="text-[#626D6E] flex items-center gap-2 self-start pl-5 "><div class="w-[20px] h-[20px] bg-[#543FC5] rounded-full"></div><?= $categories[1] ?></div>
          <p class="font-bold text-white tracking-wider	"><?= $snacksCount ?></p>
        </div>

        <div class="w-56 bg-[#1A262D] h-28 flex flex-col items-center justify-center gap-1 rounded-lg">
          <div class="text-[#626D6E] flex items-center gap-2 self-start pl-5 "><div class="w-[20px] h-[20px] bg-[#00E272] rounded-full"></div><?= $categories[2] ?></div>
          <p class="font-bold text-white tracking-wider	"><?= $meatCount ?></p>
        </div>

        <div class="w-56 bg-[#1A262D] h-28 flex flex-col items-center justify-center gap-1 rounded-lg">
          <div class="text-[#626D6E] flex items-center gap-2 self-start pl-5 "><div class="w-[20px] h-[20px] bg-[#FE6A35] rounded-full"></div><?= $categories[3] ?></div>
          <p class="font-bold text-white tracking-wider	"><?= $cannedCount ?></p>
        </div>

        <div class="w-56 bg-[#1A262D] h-28 flex flex-col items-center justify-center gap-1 rounded-lg">
          <div class="text-[#626D6E] flex items-center gap-2 self-start pl-5 "><div class="w-[20px] h-[20px] bg-[#6B8ABC] rounded-full"></div><?= $categories[4] ?></div>
          <p class="font-bold text-white tracking-wider	"><?= $frozenCount ?></p>
        </div>

        <div class="w-56 bg-[#1A262D] h-28 flex flex-col items-center justify-center gap-1 rounded-lg">
          <div class="text-[#626D6E] flex items-center gap-2 self-start pl-5 "><div class="w-[20px] h-[20px] bg-[#D568FB] rounded-full"></div><?= $categories[5] ?></div>
          <p class="font-bold text-white tracking-wider	"><?= $appCount ?></p>
        </div>

        <div class="w-56 bg-[#1A262D] h-28 flex flex-col items-center justify-center gap-1 rounded-lg ">
          <div class="text-[#626D6E] flex items-center gap-2 self-start pl-5 "><div class="w-[20px] h-[20px] bg-[#2EE0CA] rounded-full"></div><?= $categories[6] ?></div>
          <p class="font-bold text-white tracking-wider	"><?= $hwareCount ?></p>
        </div>s
      </div>


  </div>

</body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<style>
  #dashboard:hover{
    cursor: pointer;
    border-color: #ACB2B2;
  }
  #inventory:hover{
    cursor: pointer;
    border-color: #ACB2B2;
  }


  .highcharts-figure,
  .highcharts-data-table table {
    margin: 1em auto;
  }

  .highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
  }

  .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
  }

  .highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
  }

  .highcharts-data-table td,
  .highcharts-data-table th,
  .highcharts-data-table caption {
    padding: 0.5em;
  }

  .highcharts-data-table thead tr,
  .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
  }

  .highcharts-data-table tr:hover {
    background: #f1f7ff;
  }
</style>
<script>
  document.getElementById("profile").addEventListener("click", function(){
    document.getElementById("profile_option").classList.toggle('hidden');
  });
</script>

<script>
  Highcharts.chart('container', {
    chart: {
      type: 'pie',
      backgroundColor: '#1A262D',
      borderRadius: 10,
      custom: {},
      events: {
        render() {
          const chart = this,
            series = chart.series[0];
          let customLabel = chart.options.chart.custom.label;

          if (!customLabel) {
            customLabel = chart.options.chart.custom.label =
              chart.renderer.label(
                'Total Product<br/>' +
                "<strong class='totalProduct'><?=$sum?></strong>"
              )
              .css({
                color: '#ffff',
                textAnchor: 'middle'
              })
              .add();
          }

          const x = series.center[0] + chart.plotLeft,
            y = series.center[1] + chart.plotTop -
            (customLabel.attr('height') / 2);

          customLabel.attr({
            x,
            y
          });
          // Set font size based on chart diameter
          customLabel.css({
            fontSize: `${series.center[2] / 12}px`
          });
        }
      }
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    title: {
        text: 'Dashboard',
        align: 'left', // Align the title to the left
        x: 0, 
        style: {
            color: '#ffff', // Set your desired text color for the title
            fontSize: '25px'
        }
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
    },
    legend: {
      enabled: false
    },
    plotOptions: {
      series: {
        allowPointSelect: true,
        cursor: 'pointer',
        borderRadius: 8,
        dataLabels: [{
          enabled: true,
          distance: 20,
          format: '{point.name}'
          
        }, {
          enabled: true,
          distance: -15,
          format: '{point.percentage:.0f}%',
          style: {
            fontSize: '0.9em'
          }
        }],
        showInLegend: true
      }
    },
    series: [{
      name: 'Quantity',
      colorByPoint: true,
      innerSize: '75%',
      data: [{
          name: 'Beverage',
          y: <?= $beverageCount?>
        }, {
          name: 'Snacks',
          y: <?= $snacksCount?>
        }, {
          name: 'Meat',
          y: <?= $meatCount?>
        }, {
          name: 'Canned Goods',
          y: <?= $cannedCount?>
        },
        {
          name: 'Frozen Foods',
          y: <?= $frozenCount?>
        },
        {
          name: 'Appliances',
          y: <?= $appCount?>
        }, {
          name: 'Hardware',
          y: <?= $hwareCount?>
        }
      ]
    }]
  });
</script>



</html>