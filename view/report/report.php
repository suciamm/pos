<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form di Tengah Halaman</title>
    <style>
        /* Mengatur form untuk ditengahkan di tengah halaman */
        form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 900px; /* Lebar form */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        /* Style untuk label pada bagian tanggal */
        p {
            margin-bottom: 5px;
        }

        /* Style untuk input tanggal */
        input[type="date"] {
            width: calc(100% - 24px); /* Lebar input date */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Menghitung padding dan border ke dalam lebar */
        }

        /* Style untuk ikon kalender */
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
    <form action="" class="">
        <div>
            <p>Dari Tanggal</p>
            <!-- Field untuk tanggal awal -->
            <input type="date" class="form-control" name="date_from" id="date_from" autocomplete="off" placeholder="Dari Tanggal">
            <!-- Tambahkan elemen kalender untuk memilih tanggal -->
            <div class="input-group-append">
                <label class="btn btn-secondary bor-right" for="date_from">
                    <i class="fa fa-calendar"></i>
                </label>
            </div>
            <div class="text-danger col-md-12 row"></div>
        </div>

        <div>
            <p>Sampai Tanggal</p>
            <!-- Field untuk tanggal berakhir -->
            <input type="date" class="form-control" name="date_till" id="date_till" autocomplete="off" placeholder="Sampai Tanggal">
            <!-- Tambahkan elemen kalender untuk memilih tanggal -->
            <div class="input-group-append">
                <label class="btn btn-secondary bor-right" for="date_till">
                    <i class="fa fa-calendar"></i>
                </label>
            </div>
            <div class="text-danger col-md-12 row"></div>
        </div>
        <button type="submit">Submit</button>

    </form>
</body>
</html>
