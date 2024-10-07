<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Report</title>
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">




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
        <button type="submit" id="youreport">Your Report</button>
        <button type="submit" id="allreport">All Report</button>          
    </form>
 
    <div id="resultContainer_youReport"  style="display:none;">
        <span class="btndld">
            <button class="download-button" id="downloadPdfButton">Download PDF</button>
            <button class="download-button" id="downloadBtn">Download EXCEL</button>
            <button id="backtoyoureport"> Back </button>


        </span>
        <div class="row card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="view-tax">
                    <thead>
                        <h3 id="dateRangeFrom">Dari tanggal = </h3>
                        <h3 id="dateRangeTill">Sampai tanggal = </h3>
                        <h3 id="namaUser">Nama User = <?php echo htmlspecialchars($namaUser); ?></h3> <!-- Menampilkan nama user -->                        <tr>
                      
                        <tr class="table-your">  
                            <th width="20%">Tanggal</th>
                            <th width="10%">Total</th>
                        </tr>
                    </thead>
                    <tbody id="resultBody">
                        <!-- Data will be inserted here -->
                    </tbody>
                    <tfoot>
                        <!-- Total transaction will be inserted here -->
                    </tfoot>
                </table>
            </div>
            
            <div class="table-responsive-detail">
                <table class="table table-hover table-striped" id="view-detail">
                    <thead>                     
                        <tr>
                            <th width="15%">Kode bayar</th>
                            <th width="10%">Tanggal</th>
                            <th width="15%">Product</th>
                            <th width="7%">Quantity</th>
                            <th width="13%">Price</th>
                            <th width="10%">Subtotal</th>
                            <th width="10%">Discount</th>
                            <th width="10%">Tax</th>
                            <th width="10%">SRV</th>
                        </tr>
                    </thead>
                    <tbody id="detailBody">
                        <!-- Data will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="resultContainer_allReport" style="display:none;">
            <button class="download-button" id="downloadPdfButtonAllReport">Download PDF</button>
            <button class="download-button" id="downloadExcelButonAllReport">Download EXCEL</button>
            <button id="backtoallreport"> Back </button>
        </span>
        <div class="row card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="view-tax2">
                    <thead>
                        <h3 id="dateRangeFromAll">Dari tanggal = </h3>
                        <h3 id="dateRangeTillAll">Sampai tanggal = </h3>                        
                    
                    </thead>
                    <tbody id="resultBodyAll">
                        <!-- Data will be inserted here -->
                    </tbody>
                    <tfoot>
                        <tr>    
                            <td colspan="2" style="text-align: right; font-weight: bold;">Total Keseluruhan Transaksi:</td>
                            <td id="totalTransactionAll" style="font-weight: bold;">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div id="resultContainer_allReportDetail" style="display:none;">
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="view-detail">
                <thead>                     
                        <tr>
                            <th width="15%">Kode bayar</th>
                            <th width="10%">Tanggal</th>
                            <th width="15%">Product</th>
                            <th width="7%">Quantity</th>
                            <th width="13%">Price</th>
                            <th width="10%">Subtotal</th>
                            <th width="10%">Discount</th>
                            <th width="10%">Tax</th>
                            <th width="10%">SRV</th>

                        </tr>
                    </thead>
                    <tbody id="detailBodyAll">
                        <!-- Data will be inserted here -->
                </tbody>
            </table>
            </div>
            <button id="backtoallreportdetail"> Back </button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>
 
    <script>

            document.getElementById("backtoallreport").addEventListener("click", function () {
                resultContainer_allReportDetail.style.display = 'none';
                reportForm.style.display = 'block';
                resultBodyAll.innerHTML = ''; // Clear the report details if needed
            });
            document.getElementById("backtoyoureport").addEventListener("click", function () {
                // Hide the current detail view
                resultContainer_youReport.style.display = 'none';

                // Show the "Report All" view
                reportForm.style.display = 'block';
                resultBodyAll.innerHTML = ''; // Clear the report details if needed
            });
            document.getElementById("backtoallreportdetail").addEventListener("click", function () {
                // Hide the current detail view
                resultContainer_allReport.style.display = 'none';

                // Show the "Report All" view
                resultContainer_allReport.style.display = 'block';
                resultBodyAll.innerHTML = ''; // Clear the report details if needed
            });

            document.addEventListener("DOMContentLoaded", function () {
                var form = document.getElementById("reportForm");
                var youreport = document.getElementById("youreport");
                var allreport = document.getElementById("allreport");
                var resultContainer_youReport = document.getElementById("resultContainer_youReport");
                var resultContainer_allReport = document.getElementById("resultContainer_allReport");
                var resultContainer_allReportDetail = document.getElementById("resultContainer_allReportDetail");

                var resultBody = document.getElementById("resultBody");
                var detailBody = document.getElementById("detailBody");
                var resultBodyAll = document.getElementById("resultBodyAll");
                var detailBodyAll = document.getElementById("detailBodyAll");

                var namaUser = document.getElementById("namaUser");
                var dateRangeFrom = document.getElementById("dateRangeFrom");
                var dateRangeTill = document.getElementById("dateRangeTill");
                var dateRangeFromAll = document.getElementById("dateRangeFromAll");
                var dateRangeTillAll = document.getElementById("dateRangeTillAll")

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
                function formatRupiah(angka) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka).replace(/,00$/, '');
                }

                    // Fungsi untuk memproses respons dari AJAX
                function processReportResponse(response) {
                    if (response.status === 'success') {
                        $('#namaUser').text('Nama User = ' + response.namaUser);
                        // Proses dan tampilkan data laporan di sini
                    } else {
                        $('#namaUser').text('Nama User = User tidak dikenal');
                    }
                }

                youreport.addEventListener("click", function (event) {
                    event.preventDefault();

                    // var nama_user = "";
                    var date_from = document.getElementById("date_from").value;
                    var date_till = document.getElementById("date_till").value;
                    var totalReportTransaction = [];
                    var totalPerField = [];

                    // namaUser.textContent = "Nama User = " + processReportResponse(nama_user);
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
                            // 'namaUser': namaUser
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            if (namaUser) {
                                namaUser.textContent = "Nama Kasir = " + response.namaUser;
                            }
                            
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
                                        html += '<td>' + date + '</td>'; // Format tanggal
                                        html += '<td style="text-align: right">' + formatRupiah(dateTotals[date].total)  + '</td>'; // Format total
                                        html += '</tr>';
                                        total += dateTotals[date].total; // Menambahkan nilai total transaksi

                                        totalPerField.push(dateTotals[date].total);
                                    }
                                }
                                var totalHtml = '<tr>';
                                totalHtml += '<td style="text-align: left; font-weight: bold;">Total Transaksi:</td>';
                                totalHtml += '<td style="text-align: right; font-weight: bold;">' + formatRupiah(total) + '</td>';
                                totalHtml += '</tr>';
                                totalReportTransaction.push(total);  

                                document.getElementById('resultBody').innerHTML = html;
                                document.querySelector('#view-tax tfoot').innerHTML = totalHtml;

                                console.log("Total Transaksi All:", totalReportTransaction);
                                console.log("Total transaction Detail:", totalPerField);
                            } else {
                                resultBody.innerHTML = '<tr><td colspan="4">Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.</td></tr>';
                                totalTransaction.textContent = '0'; // Set total transaksi ke 0 jika tidak ada data
                                resultContainer_youReport.style.display = 'block';
                                form.style.display = 'none';
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX error: " + status + ' - ' + error);
                        }
                    });

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
                                var detailDateTotals = {};

                                // Kelompokkan data berdasarkan tanggal dan hitung total transaksi per tanggal
                                data.forEach(function (item) {
                                    var date = formatDate(item.date); // Format tanggal
                                    if (!detailDateTotals[date]) {
                                        detailDateTotals[date] = { total: 0, details: [] };
                                    }
                                    detailDateTotals[date].total += parseFloat(item.total_per_product); // Hitung total per tanggal
                                    detailDateTotals[date].details.push(item); // Simpan detail per tanggal
                                });

                                // Ambil dan urutkan semua tanggal
                                var sortedDetailDates = Object.keys(detailDateTotals).sort(function(a, b) {
                                    return new Date(a.split('-').reverse().join('-')) - new Date(b.split('-').reverse().join('-'));
                                });

                                var totalPerFieldIndex = 0;

                                    // Tambahkan baris detail untuk tanggal tersebut
                                    sortedDetailDates.forEach(function (date) {
                                        // Tambahkan baris tanggal
                                        html += '<tr><td colspan="9"><strong>' + date + '</strong></td></tr>';
                                        // var totalPerFieldIndex = 0;
                                        var hitungtotal = 0;
                                        var perunit = 0;
                                        detailDateTotals[date].details.forEach(function (item) {
                                            hitungtotal += parseFloat(item.total); // Hitung total transaksi per detail
                                            perunit = parseFloat(item.price_per_unit)* parseFloat(item.quantity);

                                            html += '<tr>';
                                            html += '<td>' + item.sales_code + '</td>';
                                            html += '<td>' + formatDate(item.date) + '</td>'; // Format tanggal                                
                                            html += '<td>' + item.product + '</td>';
                                            html += '<td style="text-align: center;">' + item.quantity + '</td>';
                                            html += '<td style="text-align: right">' + item.price_per_unit + '</td>';  
                                            html += '<td style="text-align: right">' + perunit + '</td>';
                                            html += '<td style="text-align: right">' + item.discount + '</td>';
                                            html += '<td style="text-align: right">' + item.tax + '</td>';
                                            html += '<td style="text-align: right">' + item.service + '</td>';
                                            html += '</tr>';
                                        });

                                        // Tambahkan baris total transaksi per tanggal
                                        html += '<tr>';                                

                                        html += '<td colspan="8" style="text-align: right"><strong>Total Transaksi:</strong></td>';
                                        html += '<td style="text-align: right"><strong>' + 'Rp' + new Intl.NumberFormat('id-ID').format(totalPerField[totalPerFieldIndex]) + '</strong></td>';
                                        html += '<td colspan="3"></td>'; // Kosongkan kolom untuk diskon, pajak, layanan
                                        html += '</tr>';
                                        totalPerFieldIndex += 1;
                                    });

                                detailBody.innerHTML = html;    
                                resultContainer_youReport.style.display = 'block';
                                form.style.display = 'none';
                            } else {
                                detailBody.innerHTML = '<tr><td colspan="8">Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.</td></tr>';
                                resultContainer_youReport.style.display = 'block';
                                form.style.display = 'none';
                            }

                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX error: " + status + ' - ' + error);
                        }
                    });

                });


           
            allreport.addEventListener("click", function (event) {
                event.preventDefault();

                var date_from = document.getElementById("date_from").value;
                var date_till = document.getElementById("date_till").value;
                // var operator = document.getElementById("operator").value;

                dateRangeFromAll.textContent = "Dari tanggal = " + formatDate(date_from);
                dateRangeTillAll.textContent = "Sampai tanggal = " + formatDate(date_till);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'aksi': 'getReportAll',
                        'date_from': date_from,
                        'date_till': date_till
                    },  
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);

                        if (response.status === 'success') {
                            var data = response.data;
                            var html = '';
                            var grandtotal = 0;

                            Object.keys(data).forEach(function(operator) {
                                html += '<h4>Nama Kasir: ' + operator + '</h4>';
                                html += '<table class="table table-hover table-striped">';
                                html += '<thead><tr><th>Tanggal</th><th>Total</th><th>Action</th></tr></thead>';
                                html += '<tbody>';

                                var total = 0;
                                data[operator].forEach(function (item) {
                                    html += '<tr>';
                                    html += '<td style="text-align: center;">' + formatDate(item.date) + '</td>';
                                    html += '<td style="text-align: right;">' + formatRupiah(item.total) + '</td>';
                                    // html += '<td><button  type="button" data-operator="'+operator+'" class="btn btn-primary btn-sm showDetailAll"><i class="fas fa-edit"></i></button></td>';
                                    html += '<td class="center-button"><button  type="button" data-operator="'+operator+'" class="btn btn-primary btn-sm showDetailAll"><i class="fas fa-edit"></i></button></td>';
                                    html += '</tr>';
                                    total += parseFloat(item.total);

                                });
                                html += '</tbody>';
                                html += '<tfoot><tr><td colspan="2" style="text-align: right; font-weight: bold;">Total Transaksi:</td><td style="font-weight: bold;">' + formatRupiah(total) + '</td></tr></tfoot>';
                                html += '</table>';
                                grandtotal += total;
                            });
                            // html += '<h4 style="text-align: right; font-weight: bold;">Grand Total Semua Transaksi: ' + formatRupiah(grandTotal) + '</h4>';

                            document.getElementById("totalTransactionAll").textContent = formatRupiah(grandtotal);
                            resultBodyAll.innerHTML = html;
                            resultContainer_allReport.style.display = 'block';
                            form.style.display = 'none';

                            document.querySelectorAll('.showDetailAll').forEach(function(button) {
                                button.addEventListener("click", function (event) {
                                    event.preventDefault();

                                    // var selectedDate = this.getAttribute('data-operator');
                                    // var selected_date = this.closest('tr').querySelector('td:first-child').textContent;
                                    var operator = this.getAttribute('data-operator');

                                    $.ajax({
                                        url: url,
                                        type: 'POST',
                                        data: {
                                            'aksi': 'getReportDetailAll',
                                            'date_from': date_from,
                                            'date_till': date_till,
                                            'operator': operator
                                            // 'selected_date': selected_date
                                        },
                                        dataType: 'json',
                                        success: function (response) {
                                        console.log(response);

                                        if (response.status === 'success') {
                                            var data = response.data;
                                            console.log(data); // Debug untuk memastikan data terisi

                                            if (data.length > 0) {
                                                var html = '';
                                                var dateDetails = {};

                                                data.forEach(function (item) {
                                                    var date = formatDate(item.date);
                                                    if (!dateDetails[date]) {
                                                        dateDetails[date] = [];
                                                    }
                                                    dateDetails[date].push(item);
                                                });

                                                var sortedDates = Object.keys(dateDetails).sort(function(a, b) {
                                                    return new Date(a.split('-').reverse().join('-')) - new Date(b.split('-').reverse().join('-'));
                                                });

                                              var total =   0;

                                                sortedDates.forEach(function (date) {
                                                    // html += '<tr><td colspan="9"><strong>' + date + '</strong></td></tr>'; // Update colspan jika ada kolom baru

                                                    dateDetails[date].forEach(function (item) {
                                                        // var itemTotal = parseFloat(item.total_per_product) - parseFloat(item.discount) + parseFloat(item.tax) + parseFloat(item.service);
                                                        var itemTotal = parseFloat(item.price_per_unit)* parseFloat(item.quantity);
                                                        total += itemTotal; // Akumulasi total transaksi
                                                        
                                                        html += '<tr>';
                                                        html += '<td>' + item.sales_code + '</td>';
                                                        html += '<td>' + formatDate(item.date) + '</td>';
                                                        html += '<td>' + item.product + '</td>';
                                                        html += '<td style="text-align: center;">' + item.quantity + '</td>';
                                                        html += '<td style="text-align: right;">' + item.price_per_unit + '</td>';
                                                        html += '<td style="text-align: right;">' + itemTotal + '</td>'; // Tampilkan total item
                                                        // html += '<td>' + item.total_per_product + '</td>';
                                                        html += '<td style="text-align: right;">' + item.discount + '</td>';
                                                        html += '<td style="text-align: right;">' + item.tax + '</td>';
                                                        html += '<td style="text-align: right;">' + item.service  + '</td>';
                                                        html += '</tr>';
                                                    });
                                                });

                                                // Menampilkan total transaksi di bagian bawah tabel
                                                html += '<tfoot><tr><td colspan="8" style="text-align: right; font-weight: bold;">Total Transaksi:</td><td style="font-weight: bold;">' + formatRupiah(total) + '</td></tr></tfoot>';
                                                html += '</table>';

                                                
                                                detailBodyAll.innerHTML = html;
                                                resultContainer_allReportDetail.style.display = 'block';
                                                resultContainer_allReport.style.display = 'none';
                                            } else {
                                                detailBodyAll.innerHTML = '<tr><td colspan="8">Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.</td></tr>';
                                                resultContainer_allReportDetail.style.display = 'block';
                                                resultContainer_allReport.style.display = 'none';
                                            }
                                        } else {
                                            detailBodyAll.innerHTML = '<tr><td colspan="8">Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.</td></tr>';
                                            resultContainer_allReportDetail.style.display = 'block';
                                            resultContainer_allReport.style.display = 'none';
                                        }
                                        },

                                        error: function (xhr, status, error) {
                                            console.error("AJAX error: " + status + ' - ' + error);
                                        }
                                    });
                                });
                            });
                        } else {
                            resultBodyAll.innerHTML = '<tr><td colspan="4">Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.</td></tr>';
                            totalTransaction.textContent = '0';
                            resultContainer_allReport.style.display = 'block';
                            form.style.display = 'none';
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error: " + status + ' - ' + error);
                    }
                });
                });

                        

            // YOU REPORT 
            // Download button click event bentuk csv you report
            document.getElementById("downloadBtn").addEventListener("click", function () {
                var date_from = document.getElementById("date_from").value;
                var date_till = document.getElementById("date_till").value;

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
                        if (response.status === 'success') {
                            var data = response.data;
                            var csvContent = "data:text/csv;charset=utf-8,";

                            // Header
                            csvContent += "Sales Code,Date,Product,Quantity,Price per Unit,Total per Product,Discount,Tax,Service\n";

                            // Kelompokkan data berdasarkan tanggal
                            var detailDateTotals = {};
                            data.forEach(function (item) {
                                var date = formatDate(item.date); // Format tanggal
                                if (!detailDateTotals[date]) {
                                    detailDateTotals[date] = [];
                                }
                                detailDateTotals[date].push(item); // Simpan detail per tanggal
                            });

                            // Iterasi setiap tanggal dan detailnya
                            for (var date in detailDateTotals) {
                                if (detailDateTotals.hasOwnProperty(date)) {
                                    detailDateTotals[date].forEach(function (item) {
                                        var row = item.sales_code + "," + 
                                                formatDate(item.date) + "," + 
                                                item.product + "," + 
                                                item.quantity + "," + 
                                                item.price_per_unit + "," + 
                                                item.total_per_product + "," + 
                                                item.discount + "," + 
                                                item.tax + "," + 
                                                item.service;
                                        csvContent += row + "\n";
                                    });
                                }
                            }

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

            // Download PDF functionality you report
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

                // Add first table (Total transactions per date)
                doc.autoTable({
                    startY: 40,
                    head: [['Date', 'Total']],
                    body: Array.from(document.querySelectorAll('#view-tax tbody tr')).map(row =>
                        Array.from(row.querySelectorAll('td')).map((cell, index) => index === 1 ? cell.innerText : cell.innerText)
                    ),
                    styles: { 
                        cellPadding: 3,
                        fontSize: 8,
                        valign: 'middle',
                        overflow: 'linebreak',
                        tableWidth: 'auto' // Ukuran tabel otomatis lebih kecil
                    },
                    headStyles: {
                        fillColor: [52, 73, 94],
                        textColor: [255, 255, 255],
                        lineWidth: 0.1,
                        halign: 'center'
                    },
                    bodyStyles: {
                        lineWidth: 0.1,
                        halign: function (data) { return data.column.index === 1 ? 'right' : 'left'; } // Harga rata kanan
                    },
                    columnStyles: {
                        0: { cellWidth: 40 }, // Lebar kolom 'Date'
                        1: { cellWidth: 50, halign: 'right' } // Lebar kolom 'Total' dan rata kanan
                    }
                });

                // Space between tables
                let finalY = doc.lastAutoTable.finalY + 10;

                // Add second table (Detailed transactions per date)
                doc.autoTable({
                    startY: finalY,
                    head: [['Kode Bayar', 'Date', 'Product', 'Quantity', 'Price per Unit', 'Total per Product', 'Discount', 'Tax', 'Service']],
                    body: Array.from(document.querySelectorAll('#view-detail tbody tr')).map(row =>
                        Array.from(row.querySelectorAll('td')).map((cell, index) => {
                            // Kolom harga rata kanan
                            if ([4, 5, 6, 7, 8].includes(index)) return { content: cell.innerText, styles: { halign: 'right' } };
                            return cell.innerText;
                        })
                    ),
                    styles: { 
                        cellPadding: 3,
                        fontSize: 8,
                        valign: 'middle',
                        overflow: 'linebreak',
                        tableWidth: 'wrap' // Ukuran tabel menyesuaikan konten, lebih besar dari tabel pertama
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

                // Save the PDF
                doc.save('sales_report.pdf');
            });

        
            // ALL REPORT 
            document.getElementById('downloadPdfButtonAllReport').addEventListener('click', function () {
                var date_from = document.getElementById("date_from").value;
                var date_till = document.getElementById("date_till").value;

                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Title and period
                doc.setFontSize(16);
                doc.text("Sales Report", 14, 20);
                doc.setFontSize(12);
                doc.text("Periode " + formatDate(date_from) + " sampai dengan " + formatDate(date_till), 14, 30);

                let y = 40; // Initial vertical position

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'aksi': 'getReportAll',
                        'date_from': date_from,
                        'date_till': date_till
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            var data = response.data;

                            Object.keys(data).forEach(function (operator) {
                                // Add operator title
                                doc.setFontSize(14);
                                doc.text('Nama Kasir: ' + operator, 14, y);
                                y += 10;

                                // Add table for each operator
                                doc.autoTable({
                                    startY: y,
                                    head: [['Tanggal', 'Total']],
                                    body: data[operator].map(item => [
                                        formatDate(item.date),
                                        formatRupiah(item.total)
                                    ]),
                                    styles: { 
                                        cellPadding: 3,
                                        fontSize: 8,
                                        valign: 'middle',
                                        overflow: 'linebreak',
                                        tableWidth: 'auto' // Ukuran tabel otomatis lebih kecil
                                    },
                                    headStyles: {
                                        fillColor: [52, 73, 94],
                                        textColor: [255, 255, 255],
                                        lineWidth: 0.1,
                                        halign: 'center'
                                    },
                                    bodyStyles: {
                                        lineWidth: 0.1,
                                        halign: function (data) { return data.column.index === 1 ? 'right' : 'left'; } // Harga rata kanan
                                    },
                                    columnStyles: {
                                        0: { cellWidth: 40 }, // Lebar kolom 'Tanggal'
                                        1: { cellWidth: 50, halign: 'right' } // Lebar kolom 'Total' dan rata kanan
                                    },
                                    margin: { top: 10 }
                                });

                                y = doc.lastAutoTable.finalY + 10; // Update y position for next operator

                                // Now, fetch the detail data per date for this operator
                                $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data: {
                                        'aksi': 'getReportDetailAll',
                                        'date_from': date_from,
                                        'date_till': date_till,
                                        'operator': operator
                                    },
                                    dataType: 'json',
                                    success: function (responseDetail) {
                                        if (responseDetail.status === 'success') {
                                            var detailsData = responseDetail.data;
                                            var dateDetails = {};

                                            detailsData.forEach(function (item) {
                                                var date = formatDate(item.date);
                                                if (!dateDetails[date]) {
                                                    dateDetails[date] = [];
                                                }
                                                dateDetails[date].push(item);
                                            });

                                            var sortedDates = Object.keys(dateDetails).sort(function(a, b) {
                                                return new Date(a.split('-').reverse().join('-')) - new Date(b.split('-').reverse().join('-'));
                                            });

                                            sortedDates.forEach(function (date) {
                                                doc.addPage(); // Add new page for each date's details
                                                doc.setFontSize(14);
                                                doc.text('Detail Transaksi Tanggal: ' + date + ' - Kasir: ' + operator, 14, 20);

                                                doc.autoTable({
                                                    startY: 30,
                                                    head: [['Kode Bayar', 'Date', 'Product', 'Quantity', 'Price per Unit', 'Total per Product', 'Discount', 'Tax', 'Service']],
                                                    body: dateDetails[date].map(item => [
                                                        item.sales_code,
                                                        formatDate(item.date),
                                                        item.product,
                                                        item.quantity,
                                                        item.price_per_unit, // Rata kanan untuk harga per unit
                                                        item.price_per_unit * item.quantity, // Rata kanan untuk total per product
                                                        item.discount, // Rata kanan untuk diskon
                                                        item.tax, // Rata kanan untuk pajak
                                                        item.service // Rata kanan untuk service
                                                    ]),
                                                    styles: { 
                                                        cellPadding: 3,
                                                        fontSize: 8,
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
                                                    },
                                                    columnStyles: {
                                                        0: { halign: 'left' }, // Kode Bayar rata kiri
                                                        1: { halign: 'left' }, // Date rata kiri
                                                        2: { halign: 'left' }, // Product rata kanan
                                                        3: { halign: 'center' }, // Quantity rata tengah
                                                        4: { halign: 'right' }, // Harga per unit rata kanan
                                                        5: { halign: 'right' }, // Total per product rata kanan
                                                        6: { halign: 'right' }, // Diskon rata kanan
                                                        7: { halign: 'right' }, // Pajak rata kanan
                                                        8: { halign: 'right' }  // Service rata kanan
                                                    },
                                                    margin: { top: 10 }
                                                });
                                            });

                                            // Save PDF after all details are added
                                            doc.save('Laporan_Transaksi.pdf');
                                        } else {
                                            console.error('Tidak ada detail data yang ditemukan untuk kasir: ' + operator);
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        console.error("AJAX error (detail): " + status + ' - ' + error);
                                    }
                                });
                            });
                        } else {
                            console.error('Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error: " + status + ' - ' + error);
                    }
                });
            });
        
            document.getElementById('downloadExcelButonAllReport').addEventListener('click', function () {
                var date_from = document.getElementById("date_from").value;
                var date_till = document.getElementById("date_till").value;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'aksi': 'getReportAll',
                        'date_from': date_from,
                        'date_till': date_till
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            var data = response.data;
                            var csvContent = "data:text/csv;charset=utf-8,";

                            // Add header
                            csvContent += "Nama Kasir,Tanggal,Total\n";

                            // Iterate through operators
                            Object.keys(data).forEach(function (operator) {
                                data[operator].forEach(function (item) {
                                    var row = [
                                        operator,
                                        formatDate(item.date),
                                        formatRupiah(item.total)
                                    ].join(',');
                                    csvContent += row + "\n";
                                });

                                // Fetch the details per operator
                                $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data: {
                                        'aksi': 'getReportDetailAll',
                                        'date_from': date_from,
                                        'date_till': date_till,
                                        'operator': operator
                                    },
                                    dataType: 'json',
                                    success: function (responseDetail) {
                                        if (responseDetail.status === 'success') {
                                            var detailsData = responseDetail.data;

                                            // Add detail header
                                            csvContent += "\nDetail Transaksi Kasir: " + operator + "\n";
                                            csvContent += "Sales Code,Date,Product,Quantity,Price per Unit,Total per Product,Discount,Tax,Service\n";

                                            detailsData.forEach(function (item) {
                                                var detailRow = [
                                                    item.sales_code,
                                                    formatDate(item.date),
                                                    item.product,
                                                    item.quantity,
                                                    item.price_per_unit,
                                                    item.price_per_unit * item.quantity,
                                                    item.discount,
                                                    item.tax,
                                                    item.service
                                                ].join(',');
                                                csvContent += detailRow + "\n";
                                            });
                                        } else {
                                            console.error('Tidak ada detail data yang ditemukan untuk kasir: ' + operator);
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        console.error("AJAX error (detail): " + status + ' - ' + error);
                                    }
                                });
                            });

                            // Create CSV Blob and download it
                            var encodedUri = encodeURI(csvContent);
                            var link = document.createElement("a");
                            link.setAttribute("href", encodedUri);
                            link.setAttribute("download", "Laporan_Transaksi.csv");
                            document.body.appendChild(link); // Required for FF
                            link.click(); // Trigger the download
                            document.body.removeChild(link); // Cleanup
                        } else {
                            console.error('Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error: " + status + ' - ' + error);
                    }
                });
            });

        });
   </script>
</body>
</html>
