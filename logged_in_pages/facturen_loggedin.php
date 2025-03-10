<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Static array of invoices
$invoices = [
    ['id' => 1, 'invoice_number' => 'INV-001', 'date' => '2023-01-01', 'amount' => '100.00'],
    ['id' => 2, 'invoice_number' => 'INV-002', 'date' => '2023-02-01', 'amount' => '200.00'],
    ['id' => 3, 'invoice_number' => 'INV-003', 'date' => '2023-03-01', 'amount' => '300.00'],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturen</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Facturen</h1>
    <table>
        <thead>
            <tr>
                <th>Factuurnummer</th>
                <th>Datum</th>
                <th>Bedrag</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $invoice): ?>
                <tr>
                    <td><?php echo htmlspecialchars($invoice['invoice_number']); ?></td>
                    <td><?php echo htmlspecialchars($invoice['date']); ?></td>
                    <td><?php echo htmlspecialchars($invoice['amount']); ?></td>
                    <td><a href="view_invoice.php?id=<?php echo $invoice['id']; ?>">Bekijk</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
