<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Order Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #000000;
        }

        header {
            color: rgb(0, 0, 0);
            padding: 2px 0;
            text-align: center;
        }

        .logoAndName h1 {
            margin: 0;
            font-size: 20px;
        }

        .date {
            font-size: 15px;
            margin-top: 5px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            /* Setting font size to 18px */
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td.sr {
            text-align: center;
            font-size: 18px;
            width: 60px;
        }

        td.sub_category {
            text-align: center;
            font-size: 18px;
        }

        td.qty {
            width: 80px;
            text-align: center;
            font-size: 18px;

        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e2e2e2;
        }

        table caption {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <header>

        <div class="logoAndName">
            <h1>Your Company Name</h1>
        </div>
        <div class="date">
            <p>{{ $date }}</p>
        </div>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mergedOrders as $item)
                    <tr>
                        <td class="sr">{{ $loop->iteration }}</td>
                        <td class="sub_category">{{ $item['sub_category'] }}</td>
                        <td class="qty">{{ $item['qty'] }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td class="sr">--</td>
                    <td class="sub_category"><b>Total</b></td>
                    <td class="qty">{{ $totalQty }}</td>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>
