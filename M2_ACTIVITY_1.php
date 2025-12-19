<!DOCTYPE html>
<html>
<head>
    <title>Simple Lending System</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .container {
            width: 400px;
            background: #fff;
            padding: 20px;
            margin: 50px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .result {
            margin-top: 15px;
            background: #e9ecef;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Simple Lending System</h2>

    <form method="post">
        <label>Loan Amount (₱500 - ₱50,000)</label>
        <input type="number" name="amount" required min="500" max="50000">

        <label>Loan Term</label>
        <select name="term" required>
            <option value="1">1 Month</option>
            <option value="3">3 Months</option>
            <option value="6">6 Months</option>
            <option value="9">9 Months</option>
            <option value="12">12 Months</option>
            <option value="24">24 Months</option>
        </select>

        <button type="submit" name="calculate">Calculate Loan</button>
    </form>

<?php
if (isset($_POST['calculate'])) {

    $loanAmount = $_POST['amount'];
    $months = $_POST['term'];
    $monthlyRate = 0.02; // 2% monthly interest

    if ($loanAmount < 500 || $loanAmount > 50000) {
        echo "<p style='color:red;'>Invalid loan amount.</p>";
        exit;
    }

    // Loan formula
    $monthlyPayment = $loanAmount * (
        ($monthlyRate * pow(1 + $monthlyRate, $months)) /
        (pow(1 + $monthlyRate, $months) - 1)
    );

    $totalAmount = $monthlyPayment * $months;
    $totalInterest = $totalAmount - $loanAmount;
    $monthlyInterest = $totalInterest / $months;

    echo "<div class='result'>";
    echo "<h3>Loan Summary</h3>";
    echo "Loan Amount: ₱" . number_format($loanAmount, 2) . "<br>";
    echo "Loan Term: {$months} months<br>";
    echo "Monthly Interest: ₱" . number_format($monthlyInterest, 2) . "<br>";
    echo "Total Interest: ₱" . number_format($totalInterest, 2) . "<br>";
    echo "Total Amount to Pay: ₱" . number_format($totalAmount, 2) . "<br>";
    echo "<strong>Payment per Month: ₱" . number_format($monthlyPayment, 2) . "</strong>";
    echo "</div>";
}
?>

</div>
</body>
</html>
