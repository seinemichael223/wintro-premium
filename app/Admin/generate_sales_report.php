<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="chart.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="generate_chart.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js CDN -->

</head>

<body>
    <h1>Sales Report</h1>

    <!--Daily-->
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

    <div style="width: 600px; margin: 0 auto;">
        <canvas id="dailyChart"></canvas>
    </div>


    <!--Weekly-->
    <div class="navigation">
        <div>
            <span id="currentWeek">Current Week</span>
        </div>
    </div>

    <div class="export__file" id="weeklyPDF">
        <button id="weeklyPDF" class="export__file-btn" title="Generate PDF">
            Generate PDF
        </button>
    </div>

    <div style="width: 600px; margin: 0 auto;">
        <canvas id="WeeklyChart "></canvas>
    </div>


    <!--Monthly-->
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

    <div style="width: 600px; margin: 0 auto;">
        <canvas id="monthlyChart"></canvas>
    </div>

    <script src="J_chart.js"></script>
</body>

</html>