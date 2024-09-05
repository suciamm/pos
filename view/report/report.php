<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Report</title>
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="form-report-page">
    <form id="reportForm" method="POST" action="P_report.php">
        <div>
            <p>Dari Tanggal</p>
            <input type="date" class="form-control" name="date_from" id="date_from" autocomplete="off" placeholder="Dari Tanggal">
        </div>
        <div>
            <p>Sampai Tanggal</p>
            <input type="date" class="form-control" name="date_till" id="date_till" autocomplete="off" placeholder="Sampai Tanggal">
        </div>
        <button type="submit">Submit</button>
    </form>

    <div id="resultContainer">
        <span class="btndld">
            <button class="download-button" id="downloadPdfButton">Download PDF</button>
            <button class="download-button" id="downloadBtn">Download EXCEL</button>
        </span>
        <div class="row card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="view-tax">
                    <thead>
                        <h3 id="dateRangeFrom">Dari tanggal = </h3>
                        <h3 id="dateRangeTill">Sampai tanggal = </h3>                        
                        <tr>
                            <th class="pr-0" width="5%">
                                <div class="i-checks">
                                    <input type="checkbox" class="check-all checkbox-template">
                                </div>
                            </th>
                            <!-- <th width="10%">Sales Code</th> -->
                            <th width="50%">Tanggal</th>
                            <th width="50%">Total</th>
                        </tr>
                        <p></p>
                    </thead>
                    <tbody id="resultBody">
                        <!-- Data will be inserted here -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: right; font-weight: bold;">Total Transaksi:</td>
                            <td id="totalTransaction" style="font-weight: bold;">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="view-detail">
                    <thead>                     
                        <tr>
                            <th class="pr-0" width="5%">
                                <div class="i-checks">
                                    <input type="checkbox" class="check-all checkbox-template">
                                </div>
                            </th>
                            <th width="10%">Sales Code</th>
                            <th width="10%">Tanggal</th>
                            <th width="10%%">Product</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Price per Unit</th>
                            <th width="15%">Total per Product</th>
                            <th width="10%">Operator</th>
                        </tr>
                    </thead>
                    <tbody id="detailBody">
                        <!-- Data will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>
    <script>
            document.addEventListener("DOMContentLoaded", function () {
                var form = document.getElementById("reportForm");
                var resultContainer = document.getElementById("resultContainer");
                var resultBody = document.getElementById("resultBody");
                var detailBody = document.getElementById("detailBody");
                var dateRangeFrom = document.getElementById("dateRangeFrom");
                var dateRangeTill = document.getElementById("dateRangeTill");
                var totalTransaction = document.getElementById("totalTransaction");
                var url = 'process/P_report.php';   

                // Fungsi untuk memformat tanggal dalam format tanggal-bulan-tahun
                function formatDate(dateString) {
                    var date = new Date(dateString);
                    var day = String(date.getDate()).padStart(2, '0');
                    var month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
                    var year = date.getFullYear();
                    return `${day}-${month}-${year}`;   
                }

                

                form.addEventListener("submit", function (event) {
                    event.preventDefault();

                    var date_from = document.getElementById("date_from").value;
                    var date_till = document.getElementById("date_till").value;

                    dateRangeFrom.textContent = "Dari tanggal = " + formatDate(date_from);
                    dateRangeTill.textContent = "Sampai tanggal = " + formatDate(date_till);

                    // Menampilkan report keseluruhan
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            'aksi': 'getReport',
                            'date_from': date_from,
                            'date_till': date_till
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);

                            if (response.status === 'success') {
                                var data = response.data;
                                var html = '';
                                var total = 0;  // Variabel untuk menghitung total transaksi

                                // Objek untuk menyimpan total per tanggal
                                var dateTotals = {};

                                // Kelompokkan transaksi berdasarkan tanggal dan jumlahkan totalnya
                                data.forEach(function (item) {
                                    var date = formatDate(item.date); // Format tanggal
                                    if (!dateTotals[date]) {
                                        // dateTotals[date] = { total: 0, sales_code: item.sales_code, id: item.id };
                                        dateTotals[date] = { total: 0, id: item.id };
                                    }
                                    dateTotals[date].total += parseFloat(item.total);
                                });

                                // Buat baris tabel berdasarkan dateTotals
                                for (var date in dateTotals) {
                                    if (dateTotals.hasOwnProperty(date)) {
                                        html += '<tr>';
                                        html += '<td><div class="i-checks"><input type="checkbox" class="check checkbox-template" name="id[]" value="' + dateTotals[date].id + '"></div></td>';
                                        // html += '<td>' + dateTotals[date].sales_code + '</td>';
                                        html += '<td>' + date + '</td>'; // Format tanggal
                                        html += '<td>' + new Intl.NumberFormat('id-ID').format(dateTotals[date].total.toFixed(2)) + '</td>'; // Format total
                                        html += '</tr>';
                                        total += dateTotals[date].total; // Menambahkan nilai total transaksi
                                    }
                                }

                                resultBody.innerHTML = html;
                                totalTransaction.textContent = new Intl.NumberFormat('id-ID').format(total); // Memperbarui total transaksi dengan format pecahan ribuan
                                resultContainer.style.display = 'block';
                                form.style.display = 'none';
                            } else {
                                resultBody.innerHTML = '<tr><td colspan="4">Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.</td></tr>';
                                totalTransaction.textContent = '0'; // Set total transaksi ke 0 jika tidak ada data
                                resultContainer.style.display = 'block';
                                form.style.display = 'none';
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX error: " + status + ' - ' + error);
                        }
                    });

                // Menampilkan report detail
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'aksi': 'getReportDetail',
                        'date_from': date_from,
                        'date_till': date_till
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);

                        if (response.status === 'success') {
                            var data = response.data;
                            var html = '';

                            // Objek untuk menyimpan data detail berdasarkan tanggal
                            var dateDetails = {};

                            // Kelompokkan data berdasarkan tanggal
                            data.forEach(function (item) {
                                var date = formatDate(item.date); // Format tanggal
                                if (!dateDetails[date]) {
                                    dateDetails[date] = [];
                                }
                                dateDetails[date].push(item);
                            });

                            // Ambil dan urutkan semua tanggal
                            var sortedDates = Object.keys(dateDetails).sort(function(a, b) {
                                return new Date(a.split('-').reverse().join('-')) - new Date(b.split('-').reverse().join('-'));
                            });

                            // Buat baris tabel berdasarkan sortedDates
                            sortedDates.forEach(function (date) {
                                // Tambahkan baris tanggal
                                html += '<tr><td colspan="8"><strong>' + date + '</strong></td></tr>';
                                
                                // Tambahkan baris detail untuk tanggal tersebut
                                dateDetails[date].forEach(function (item) {
                                    html += '<tr>';
                                    html += '<td><div class="i-checks"><input type="checkbox" class="check checkbox-template" name="id[]" value="' + item.id + '"></div></td>';
                                    html += '<td>' + item.sales_code + '</td>';
                                    html += '<td>' + formatDate(item.date) + '</td>'; // Format tanggal                                
                                    html += '<td>' + item.product + '</td>';
                                    html += '<td>' + item.quantity + '</td>';
                                    html += '<td>' + item.price_per_unit + '</td>';  
                                    html += '<td>' + item.total_per_product + '</td>';
                                    html += '<td>' + item.operator + '</td>';
                                    html += '</tr>';
                                });
                            });

                            detailBody.innerHTML = html;    
                            resultContainer.style.display = 'block';
                            form.style.display = 'none';
                        } else {
                            detailBody.innerHTML = '<tr><td colspan="8">Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.</td></tr>';
                            resultContainer.style.display = 'block';
                            form.style.display = 'none';
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error: " + status + ' - ' + error);
                    }
                });

            });

            // Download button click event bentuk csv
            document.getElementById("downloadBtn").addEventListener("click", function () {
                var date_from = document.getElementById("date_from").value;
                var date_till = document.getElementById("date_till").value;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'aksi': 'getReport',
                        'date_from': date_from,
                        'date_till': date_till
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            var data = response.data;
                            var csvContent = "data:text/csv;charset=utf-8,";
                            csvContent += "sales_code,date,total,status,operator,table_id\n"; // Header
                            
                            data.forEach(function (rowArray) {
                                var row = rowArray.sales_code + "," + formatDate(rowArray.date) + "," + rowArray.total + "," + rowArray.status + "," + rowArray.operator + "," + rowArray.table_id;
                                csvContent += row + "\n";
                            });

                            var encodedUri = encodeURI(csvContent);
                            var link = document.createElement("a");
                            link.setAttribute("href", encodedUri);
                            link.setAttribute("download", "sales_report.csv");
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        } else {
                            alert("Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error: " + status + ' - ' + error);
                    }
                });
            });

            // Download PDF functionality
            document.getElementById('downloadPdfButton').addEventListener('click', function () {
                var date_from = document.getElementById("date_from").value;
                var date_till = document.getElementById("date_till").value;

                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Title and period
                doc.setFontSize(16);
                doc.text("Sales Report", 14, 20);
                doc.setFontSize(12);
                doc.text("Periode " + formatDate(date_from) + " sampai dengan " + formatDate(date_till), 14, 30);

                // Add table
                doc.autoTable({
                    startY: 40,
                    head: [['Sales Code', 'Product', 'Quantity', 'Price per Unit', 'Total per Product', 'Total', 'Operator']],
                    body: Array.from(document.querySelectorAll('#view-detail tbody tr')).map(row =>
                        Array.from(row.querySelectorAll('td')).slice(1).map(cell => cell.innerText)  // Slicing to exclude the checkbox column
                    ),
                    styles: { 
                        cellPadding: 3,
                        fontSize: 10,
                        halign: 'left',
                        valign: 'middle',
                        overflow: 'linebreak',
                        tableWidth: 'wrap'
                    },
                    headStyles: {
                        fillColor: [52, 73, 94],
                        textColor: [255, 255, 255],
                        lineWidth: 0.1,
                        halign: 'center'
                    },
                    bodyStyles: {
                        lineWidth: 0.1
                    }
                });

                doc.save('sales_report.pdf');
            });
        });
   </script>
</body>
</html>
