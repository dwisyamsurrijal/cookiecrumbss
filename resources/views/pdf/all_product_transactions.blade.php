<!DOCTYPE html>
<html>
<head>
    <title>All Transactions</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Semua Pesanan</h2>
    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>User</th>
                <th>Total transaksi</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productTransactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->user->name }}</td>
                <td>Rp {{ $transaction->total_amount }}</td>
                <td>{{ $transaction->formatted_created_at }}</td>
                <td>{{ $transaction->is_paid ? 'Berhasil' : 'Diproses' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
