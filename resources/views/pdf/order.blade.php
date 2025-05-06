<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .invoice-details {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .total-row {
            font-weight: bold;
            background-color: #f4f4f4;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Invoice</h1>
        <div class="invoice-details">
            <p>Invoice #: {{ $data['id'] }} | Date: {{ $data['created_at'] }}</p>
            <p>Bill To: {{ $data['restaurant_name'] }}</p>
            <p>Address: 123 Main Street, Cityville</p>
            <p>Email: johndoe@example.com</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Qty </th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['order_id_with_qty'] as $item)
                    <tr>
                        <td>{{ $item['sub_category'] }}</td>
                        <td>{{ $item['qty'] }}</td>
                        <td>{{ $item['price'] }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td>Total Qty</td>
                    <td>{{ $data['total_qty'] }}</td>
                    <td>{{ $data['total_price'] }}</td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>

</html>
