<?php


// Query to get product list with the number of items sold
$sql = "SELECT 
            p.id, 
            p.product_name, 
            p.product_price, 
            p.product_in_store, 
            p.date, 
            p.stock_update_date, 
            p.quantity_added, 
            COALESCE(SUM(u.total_products), 0) AS items_sold 
        FROM 
            products p 
        LEFT JOIN 
            user_order u 
        ON 
            p.id = u.product_id AND u.order_status = 'complete' 
        GROUP BY 
            p.id, p.product_name, p.product_price, 
            p.product_in_store, p.date, p.stock_update_date, p.quantity_added";

$result = $conn->query($sql);

// HTML and CSS for the report
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Product Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class='header'>
        <h1>Product Report</h1>
        <p>Generated on: " . date('Y-m-d H:i:s') . "</p>
    </div>";

// Check if there are results
if ($result->num_rows > 0) {
    // Start the HTML table
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>In Store</th>
                <th>Date Added</th>
                <th>Stock Update Date</th>
                <th>Quantity Added</th>
                <th>Items Sold</th>
            </tr>";

    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["product_name"] . "</td>
                <td>" . $row["product_price"] . "</td>
                <td>" . $row["product_in_store"] . "</td>
                <td>" . $row["date"] . "</td>
                <td>" . $row["stock_update_date"] . "</td>
                <td>" . $row["quantity_added"] . "</td>
                <td>" . $row["items_sold"] . "</td>
            </tr>";
    }

    // End the HTML table
    echo "</table>";
} else {
    echo "<p>No products found.</p>";
}

// Close the database connection
$conn->close();

echo "</body>
</html>";
?>