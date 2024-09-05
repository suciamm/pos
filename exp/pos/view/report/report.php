<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form di Tengah Halaman</title>
    <style>
        form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 900px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        p {
            margin-bottom: 5px;
        }
        input[type="date"] {
            width: calc(100% - 24px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-secondary {
            border-radius: 4px;
            cursor: pointer;
            padding: 8px;
            background-color: #ccc;
            border: 1px solid #ccc;
        }
        .btn-secondary:hover {
            background-color: #bbb;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <div>
            <p>Dari Tanggal</p>
            <input type="date" class="form-control" name="date_from" id="date_from" autocomplete="off" placeholder="Dari Tanggal">
            <div class="input-group-append">
                <label class="btn btn-secondary bor-right" for="date_from">
                    <i class="fa fa-calendar"></i>
                </label>
            </div>
            <div class="text-danger col-md-12 row"></div>
        </div>
        <div>
            <p>Sampai Tanggal</p>
            <input type="date" class="form-control" name="date_till" id="date_till" autocomplete="off" placeholder="Sampai Tanggal">
            <div class="input-group-append">
                <label class="btn btn-secondary bor-right" for="date_till">
                    <i class="fa fa-calendar"></i>
                </label>
            </div>
            <div class="text-danger col-md-12 row"></div>
        </div>
        <button type="submit">Submit</button>
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'vendor/autoload.php';
    // use Dompdf\Dompdf;

    $date_from = $_POST['date_from'];
    $date_till = $_POST['date_till'];

    // Data penjualan contoh
    $sales_data = [
        ['date' => '2024-05-14', 'product' => 'Produk A', 'quantity' => 10, 'total' => 100.00],
        ['date' => '2024-05-15', 'product' => 'Produk B', 'quantity' => 8, 'total' => 80.00],
        // Tambahkan data penjualan sesuai kebutuhan
    ];

    // Filter data penjualan berdasarkan tanggal
    $filtered_sales_data = array_filter($sales_data, function($sale) use ($date_from, $date_till) {
        return $sale['date'] >= $date_from && $sale['date'] <= $date_till;
    });

    // Buat HTML untuk laporan penjualan
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Laporan Penjualan</title>
        <style>
            body { font-family: Arial, sans-serif; }
            h1 { text-align: center; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }
            th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h1>Laporan Penjualan</h1>
        <p>Dari: '.$date_from.' Sampai: '.$date_till.'</p>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Terjual</th>
                    <th>Total Penjualan</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($filtered_sales_data as $sale) {
        $html .= '<tr>
            <td>'.$sale['date'].'</td>
            <td>'.$sale['product'].'</td>
            <td>'.$sale['quantity'].'</td>
            <td>$'.$sale['total'].'</td>
        </tr>';
    }

    $html .= '
            </tbody>
        </table>
    </body>
    </html>';

    // Buat PDF dan tampilkan di browser
    // $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('laporan_penjualan.pdf', ['Attachment' => 0]);
}
?>
</body>
</html>
