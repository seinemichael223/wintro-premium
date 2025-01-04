<?php include 'data.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="chart.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="script.js"></script>
  <script src="chart.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <?php include 'header.php'; ?>
</head>

<body>

  <main>
    <h1>Sales</h1>

    <div class="navigation">
      <button id="prevMonth" onclick="changeMonth(-1)">←</button>
      <span id="currentMonth">January</span>
      <button id="nextMonth" onclick="changeMonth(1)">→</button>
    </div>
    <div class="export__file">
      <button id="dailyPDF" class="export__file-btn" title="Generate PDF">
        Generate PDF
      </button>
    </div>
    <div>
      <canvas id="dailyChart"></canvas>
      <br><br>
    </div>

    <div class="navigation">
      <div>
        <button onclick="changeYear(-1)">←</button>
        <span id="currentYear">2024</span>
        <button onclick="changeYear(1)">→</button>
      </div>
    </div>

    <div class="export__file" id="monthlyPDF">
      <button id="monthlyPDF" class="export__file-btn" title="Generate PDF">
        Generate PDF
      </button>
    </div>

    <div>
      <canvas id="monthlyChart"></canvas>
      <br><br>
    </div>

    <div class="navigation">
      <div>
        <span id="last5Years">Last 5 Years</span>
      </div>
    </div>

    <div class="export__file" id="monthlyPDF">
      <button id="annualPDF" class="export__file-btn" title="Generate PDF">
        Generate PDF
      </button>
    </div>

    <div>
      <canvas id="annualChart"></canvas>
      <br><br>
    </div>


  </main>

  <?php include 'footer.php'; ?>

</body>


</html>