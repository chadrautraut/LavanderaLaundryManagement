<?php
include_once 'functions/connection.php';

function daily_chart()
{
  global $db;
  $sql = "SELECT DATE(created_at) AS date, SUM(total) AS total_sales
    FROM transactions
    WHERE YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)
    GROUP BY DATE(created_at)
    ORDER BY DATE(created_at)";

  $stmt = $db->prepare($sql);
  $stmt->execute();

  $labels = [];
  $data = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $date = date("M d, Y", strtotime($row['date']));
    $labels[] = $date;
    $data[] = $row['total_sales'];
  }
  $chartData = [
    'labels' => $labels,
    'datasets' => [
      [
        'label' => 'Daily Earnings',
        'fill' => true,
        'data' => $data,
        'backgroundColor' => 'rgba(78, 115, 223, 0.05)',
        'borderColor' => 'rgba(78, 115, 223, 1)'
      ]
    ]
  ];

  $chartDataJson = json_encode($chartData);
?>
  <canvas data-bss-chart='{"type":"line","data":<?php echo $chartDataJson; ?>,"options":{"maintainAspectRatio":false,"legend":{"display":false,"labels":{"fontStyle":"normal"}},"title":{"fontStyle":"normal"},"scales":{"xAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"],"drawOnChartArea":false},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}],"yAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"]},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}]}}}'></canvas>
<?php
}

function weekly_chart()
{
  global $db;
  $sql = "SELECT DATE(created_at) AS date, SUM(total) AS total_sales
    FROM transactions
    WHERE YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)
    GROUP BY YEARWEEK(created_at)
    ORDER BY YEARWEEK(created_at)";

  $stmt = $db->prepare($sql);
  $stmt->execute();

  $labels = [];
  $data = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $date = date("M d, Y", strtotime($row['date']));
    $labels[] = $date;
    $data[] = $row['total_sales'];
  }
  $chartData = [
    'labels' => $labels,
    'datasets' => [
      [
        'label' => 'Daily Earnings',
        'fill' => true,
        'data' => $data,
        'backgroundColor' => 'rgba(78, 115, 223, 0.05)',
        'borderColor' => 'rgba(78, 115, 223, 1)'
      ]
    ]
  ];

  

  $chartDataJson = json_encode($chartData);
?>
  <canvas data-bss-chart='{"type":"line","data":<?php echo $chartDataJson; ?>,"options":{"maintainAspectRatio":false,"legend":{"display":false,"labels":{"fontStyle":"normal"}},"title":{"fontStyle":"normal"},"scales":{"xAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"],"drawOnChartArea":false},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}],"yAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"]},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}]}}}'></canvas>
<?php
}

function month_chart()
{
  global $db;
  $sql = "SELECT YEAR(created_at) AS year, MONTH(created_at) AS month, SUM(total) AS total_sales
  FROM transactions
  WHERE MONTH(created_at) = MONTH(CURRENT_TIMESTAMP)
  GROUP BY YEAR(created_at), MONTH(created_at)
  ORDER BY YEAR(created_at), MONTH(created_at)";

  $stmt = $db->prepare($sql);
  $stmt->execute();

  $labels = [];
  $data = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $monthName = date("M", mktime(0, 0, 0, $row['month'], 10));
    $labels[] = $monthName . ' ' . $row['year'];
    $data[] = $row['total_sales'];
  }
  $chartData = [
    'labels' => $labels,
    'datasets' => [
      [
        'label' => 'Earnings',
        'fill' => true,
        'data' => $data,
        'backgroundColor' => 'rgba(78, 115, 223, 0.05)',
        'borderColor' => 'rgba(78, 115, 223, 1)'
      ]
    ]
  ];


  $chartDataJson = json_encode($chartData);
?>
  <canvas data-bss-chart='{"type":"line","data":<?php echo $chartDataJson; ?>,"options":{"maintainAspectRatio":false,"legend":{"display":false,"labels":{"fontStyle":"normal"}},"title":{"fontStyle":"normal"},"scales":{"xAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"],"drawOnChartArea":false},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}],"yAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"]},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}]}}}'></canvas>
<?php
}





function expenditures_month_chart()
{
  global $db;
  $sql = "SELECT i.name AS label, YEAR(e.created_at) AS year, MONTH(e.created_at) AS month, SUM(e.qty) AS total_expenditures
  FROM expenditures e
  INNER JOIN items i ON e.item_id = i.id
  WHERE MONTH(e.created_at) = MONTH(CURRENT_TIMESTAMP)
  GROUP BY i.name, YEAR(e.created_at), MONTH(e.created_at)
  ORDER BY YEAR(e.created_at), MONTH(e.created_at)";

  $stmt = $db->prepare($sql);
  $stmt->execute();

  $labels = [];
  $datasets = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $monthName = date("M", mktime(0, 0, 0, $row['month'], 10));
    $labels[] = $monthName . ' ' . $row['year'];
    $itemLabel = $row['label'];
    $data = $row['total_expenditures'];

    $existingDatasetIndex = array_search($itemLabel, array_column($datasets, 'label'));
    if ($existingDatasetIndex !== false) {

      $datasets[$existingDatasetIndex]['data'][] = $data;
    } else {

      $datasets[] = [
        'label' => $itemLabel,
        'fill' => true,
        'data' => [$data],
        'backgroundColor' => 'rgba(78, 115, 223, 0.05)',
        'borderColor' => 'rgba(78, 115, 223, 1)'
      ];
    }
  }

  $chartData = [
    'labels' => $labels,
    'datasets' => $datasets
  ];

  $chartDataJson = json_encode($chartData);
?>
  <canvas data-bss-chart='{"type":"line","data":<?php echo $chartDataJson; ?>,"options":{"maintainAspectRatio":false,"legend":{"display":true,"labels":{"fontStyle":"normal"}},"title":{"fontStyle":"normal"},"scales":{"xAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"],"drawOnChartArea":false},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}],"yAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"]},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}]}}}'></canvas>
<?php
}

function daily_rating_chart()
{
    global $db;
    $sql = "SELECT DATE(created_at) AS date, AVG(rating) AS average_rating
            FROM ratings
            WHERE YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at)";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $labels = [];
    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $date = date("M d, Y", strtotime($row['date']));
        $labels[] = $date;
        $data[] = $row['average_rating'];
    }

    $chartData = [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => 'Daily Average Ratings',
                'fill' => true,
                'data' => $data,
                'backgroundColor' => 'rgba(78, 115, 223, 0.05)',
                'borderColor' => 'rgba(78, 115, 223, 1)',
                'borderWidth' => 2,
                'pointRadius' => 5,
                'pointBackgroundColor' => 'rgba(78, 115, 223, 1)',
                'pointBorderColor' => '#fff',
                'pointHoverRadius' => 7,
                'pointHoverBackgroundColor' => 'rgba(78, 115, 223, 1)',
                'pointHoverBorderColor' => 'rgba(78, 115, 223, 1)',
            ]
        ]
    ];


    /**
 * Retrieves historical sales data from the database.
 *
 * @return array Historical sales data.
 */
function get_historical_sales_data()
{
    global $db;

    // SQL query to retrieve historical sales data
    $sql = "SELECT DATE(sales_date) AS date, sales_amount
            FROM sales
            WHERE YEAR(sales_date) = YEAR(CURRENT_TIMESTAMP) - 1
            GROUP BY DATE(sales_date)
            ORDER BY DATE(sales_date)";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $salesData = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $salesData[] = [
            'date' => $row['date'],
            'sales_amount' => $row['sales_amount'],
        ];
    }

    return $salesData;
}


    $chartDataJson = json_encode($chartData);
    ?>
    <canvas data-bss-chart='{"type":"line","data":<?php echo $chartDataJson; ?>,"options":{"maintainAspectRatio":false,"legend":{"display":true,"labels":{"fontStyle":"normal"}},"title":{"display":true,"text":"Daily Average Ratings","fontStyle":"normal"},"scales":{"xAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"],"drawOnChartArea":false},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}],"yAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"]},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}]}}}'></canvas>
    <?php
}