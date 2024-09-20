<!DOCTYPE html>
<html>
<head>
    <title>Transaction Details</title>
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
    <h2>Detail Transaksi</h2>
    <p>ID Transaksi: {{ $productTransaction->id }}</p>
    <p>User: {{ $productTransaction->user->name }}</p>
    <p>Total transaksi: Rp {{ $productTransaction->total_amount }}</p>
    <p>Tanggal: {{ $productTransaction->formatted_created_at }}</p>
    <p>Status: {{ $productTransaction->is_paid ? 'Berhasil' : 'Diproses' }}</p>

    <h3>Transaction Items</h3>
    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Kuantitas</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productTransaction->transactionDetails as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>Rp {{ $detail->price * $detail->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
