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
        <button type="submit" id="youreport">Your Report</button>
        <button type="submit" id="allreport">All Report</button>          
    </form>
 
    <div id="resultContainer_youReport"  style="display:none;">
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
                            <!-- <th class="pr-0" width="5%">
                                <div class="i-checks">
                                    <input type="checkbox" class="check-all checkbox-template">
                                </div>
                            </th> -->
                            <th width="10%">Sales Code</th>
                            <th width="10%">Tanggal</th>
                            <th width="10%%">Product</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Price per Unit</th>
                            <th width="10%">Subtotal</th>
                            <th width="10%">Discount</th>
                            <th width="10%">Tax</th>
                            <th width="10%">Service Charge</th>
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
        <span class="btndld">
            <button class="download-button" id="downloadPdfButton">Download PDF</button>
            <button class="download-button" id="downloadBtn">Download EXCEL</button>
        </span>
        <div class="row card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="view-tax">
                    <thead>
                        <h3 id="dateRangeFromAll">Dari tanggal = </h3>
                        <h3 id="dateRangeTillAll">Sampai tanggal = </h3>                        
                        <!-- <tr>
                            <th width="40%">Tanggal</th>
                            <th width="40%">Total</th>
                            <th width="20%">Action</th>
                        </tr> -->
                    </thead>
                    <tbody id="resultBodyAll">
                        <!-- Data will be inserted here -->
                    </tbody>
                    <tfoot>
                        <tr>    
                            <td colspan="2" style="text-align: right; font-weight: bold;">Total Transaksi:</td>
                            <td id="totalTransactionAll" style="font-weight: bold;">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div id="resultContainer_allReportDetail" style="display:none;">
        < class="row card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="view-detail">
                    <thead>                     
                        <tr>
                            <th width="10%">Sales Code</th>
                            <th width="10%">Tanggal</th>
                            <th width="10%">Product</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Price per Unit</th>
                            <th width="10%">Discount</th>
                            <th width="10%">Tax</th>
                            <th width="10%">Service Charge</th>
                            <th width="10%">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="detailBodyAll">
                        <!-- Data will be inserted here -->
                    </tbody>
                </table>
            </div>
            <button> Back </button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>
    <script>
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
                            'date_till': date_till,
                            // 'namaUser': namaUser
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            if (namaUser) {
                                namaUser.textContent = "Nama User = " + response.namaUser;
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
                                        // html += '<td><div class="i-checks"><input type="checkbox" class="check checkbox-template" name="id[]" value="' + dateTotals[date].id + '"></div></td>';
                                        // html += '<td>' + dateTotals[date].sales_code + '</td>';
                                        html += '<td>' + date + '</td>'; // Format tanggal
                                        html += '<td style="text-align: right">' + formatRupiah(dateTotals[date].total)  + '</td>'; // Format total
                                        html += '</tr>';
                                        total += dateTotals[date].total; // Menambahkan nilai total transaksi
                                    }
                                }
                                var totalHtml = '<tr>';
                                totalHtml += '<td style="text-align: left; font-weight: bold;">Total Transaksi:</td>';
                                totalHtml += '<td style="text-align: right; font-weight: bold;">' + formatRupiah(total) + '</td>';
                                totalHtml += '</tr>';

                                document.getElementById('resultBody').innerHTML = html;
                                document.querySelector('#view-tax tfoot').innerHTML = totalHtml;
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

                // Menampilkan report detail

                //     $.ajax({
                //     url: url,
                //     type: 'POST',
                //     data: {
                //         'aksi': 'getReportDetail',
                //         'date_from': date_from,
                //         'date_till': date_till
                //     },
                //     dataType: 'json',
                //     success: function (response) {
                //         console.log(response);

                //         if (response.status === 'success') {
                //             var data = response.data;
                //             var html = '';

                //             // Objek untuk menyimpan data detail berdasarkan tanggal
                //             var dateDetails = {};

                //             // Kelompokkan data berdasarkan tanggal
                //             data.forEach(function (item) {
                //                 var date = formatDate(item.date); // Format tanggal
                //                 if (!dateDetails[date]) {
                //                     dateDetails[date] = [];
                //                 }
                //                 dateDetails[date].push(item);
                //             });

                //             // Ambil dan urutkan semua tanggal
                //             var sortedDates = Object.keys(dateDetails).sort(function(a, b) {
                //                 return new Date(a.split('-').reverse().join('-')) - new Date(b.split('-').reverse().join('-'));
                //             });

                //             // Buat baris tabel berdasarkan sortedDates
                //             sortedDates.forEach(function (date) {
                //                 // Tambahkan baris tanggal
                //                 html += '<tr><td colspan="8"><strong>' + date + '</strong></td></tr>';
                                
                //                 // Tambahkan baris detail untuk tanggal tersebut
                //                 dateDetails[date].forEach(function (item) {
                //                     html += '<tr>';
                //                     // html += '<td><div class="i-checks"><input type="checkbox" class="check checkbox-template" name="id[]" value="' + item.id + '"></div></td>';
                //                     html += '<td>' + item.sales_code + '</td>';
                //                     html += '<td>' + formatDate(item.date) + '</td>'; // Format tanggal                                
                //                     html += '<td>' + item.product + '</td>';
                //                     html += '<td>' + item.quantity + '</td>';
                //                     html += '<td style="text-align: right">' + formatRupiah(item.price_per_unit) + '</td>';  
                //                     html += '<td style="text-align: right">' + formatRupiah(item.total_per_product) + '</td>';
                //                     html += '</tr>';
                //                 });
                //             });

                //             detailBody.innerHTML = html;    
                //             resultContainer_youReport.style.display = 'block';
                //             form.style.display = 'none';
                //         } else {
                //             detailBody.innerHTML = '<tr><td colspan="8">Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.</td></tr>';
                //             resultContainer_youReport.style.display = 'block';
                //             form.style.display = 'none';
                //         }
                //     },
                //     error: function (xhr, status, error) {
                //         console.error("AJAX error: " + status + ' - ' + error);
                //     }
                // });


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

                                
                                // Tambahkan baris detail untuk tanggal tersebut
                                sortedDetailDates.forEach(function (date) {
                                // Tambahkan baris tanggal
                                html += '<tr><td colspan="8"><strong>' + date + '</strong></td></tr>';
                                
                                var hitungtotal = 0
                                detailDateTotals[date].details.forEach(function (item) {
                                    
                                    html += '<tr>';
                                    html += '<td>' + item.id + '</td>';
                                    html += '<td>' + formatDate(item.date) + '</td>'; // Format tanggal                                
                                    html += '<td>' + item.product + '</td>';
                                    html += '<td>' + item.quantity + '</td>';
                                    html += '<td style="text-align: right">' + 'Rp' + new Intl.NumberFormat('id-ID').format(item.price_per_unit) + '</td>';  
                                    html += '<td style="text-align: right">' + 'Rp' + new Intl.NumberFormat('id-ID').format(item.total_per_product) + '</td>';
                                    html += '<td>' + item.discount + '</td>';
                                    html += '<td>' + item.tax + '</td>';
                                    html += '<td>' + item.service + '</td>';
                                    
                                    html += '</tr>';
                                });

                                // Tambahkan baris total transaksi per tanggal
                                html += '<tr>';
                                html += '<td colspan="5" style="text-align: right"><strong>Total Transaksi:</strong></td>';
                                html += '<td style="text-align: right"><strong>' + 'Rp' + new Intl.NumberFormat('id-ID').format(detailDateTotals[date].total) + '</strong></td>';
                                html += '</tr>';
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

                            Object.keys(data).forEach(function(operator) {
                                html += '<h4>Operator: ' + operator + '</h4>';
                                html += '<table class="table table-hover table-striped">';
                                html += '<thead><tr><th>Tanggal</th><th>Total</th><th>Action</th></tr></thead>';
                                html += '<tbody>';

                                var total = 0;
                                data[operator].forEach(function (item) {
                                    html += '<tr>';
                                    html += '<td>' + formatDate(item.date) + '</td>';
                                    html += '<td>' + formatRupiah(item.total) + '</td>';
                                    html += '<td><button type="button" data-operator="'+operator+'" class="btn btn-primary showDetailAll">Detail</button></td>';
                                    html += '</tr>';
                                    total += parseFloat(item.total);
                                });

                                html += '</tbody>';
                                html += '<tfoot><tr><td colspan="2" style="text-align: right; font-weight: bold;">Total Transaksi:</td><td style="font-weight: bold;">' + formatRupiah(total) + '</td></tr></tfoot>';
                                html += '</table>';
                            });

                            resultBodyAll.innerHTML = html;
                            resultContainer_allReport.style.display = 'block';
                            form.style.display = 'none';

                            document.querySelectorAll('.showDetailAll').forEach(function(button) {
                                button.addEventListener("click", function (event) {
                                    event.preventDefault();

                                    var operator = this.getAttribute('data-operator');

                                    $.ajax({
                                        url: url,
                                        type: 'POST',
                                        data: {
                                            'aksi': 'getReportDetailAll',
                                            'date_from': date_from,
                                            'date_till': date_till,
                                            'operator': operator
                                            // 'discount': discount,
                                            // 'tax' : tax,
                                            // 'service' : service
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

                                              var total = 0;

                                                sortedDates.forEach(function (date) {
                                                    // html += '<tr><td colspan="9"><strong>' + date + '</strong></td></tr>'; // Update colspan jika ada kolom baru

                                                    dateDetails[date].forEach(function (item) {
                                                        var itemTotal = parseFloat(item.total_per_product) - parseFloat(item.discount) + parseFloat(item.tax) + parseFloat(item.service);
                                                        total += itemTotal; // Akumulasi total transaksi
                                                        
                                                        html += '<tr>';
                                                        html += '<td>' + item.id + '</td>';
                                                        html += '<td>' + formatDate(item.date) + '</td>';
                                                        html += '<td>' + item.product + '</td>';
                                                        html += '<td>' + item.quantity + '</td>';
                                                        html += '<td>' + item.price_per_unit + '</td>';
                                                        html += '<td>' + formatRupiah(itemTotal) +  '</td>'; // Tampilkan total item
                                                        // html += '<td>' + item.total_per_product + '</td>';
                                                        html += '<td>' + item.discount + '</td>';
                                                        html += '<td>' + item.tax + '</td>';
                                                        html += '<td>' + item.service + '</td>';
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
