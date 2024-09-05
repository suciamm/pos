<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="resultContainer">
        <span class="btndld">
            <button class="download-button" id="downloadPdfButton">Download PDF</button>
            <button class="download-button" id="downloadBtn">Download EXCEL</button>
        </span>
        <div class="row card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="view-tax">
                    <thead>
                        <tr>
                            <th class="pr-0" width="5%">
                                <div class="i-checks">
                                    <input type="checkbox" class="check-all checkbox-template">
                                </div>
                            </th>
                            <th width="10%">sales_code</th>
                            <th width="25%">date</th>
                            <th width="25%">product</th>
                            <th width="25%">kuantitas</th>
                            <th width="25%">harga item</th>
                            <th width="10%">total</th>
                            <th width="10%">operator</th>
                        </tr>
                    </thead>
                    <tbody id="resultBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var urlParams = new URLSearchParams(window.location.search);
            var date_from = urlParams.get('date_from');
            var date_till = urlParams.get('date_till');
            var resultBody = document.getElementById("resultBody");

            $.ajax({
                url: 'process/P_report.php',
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

                        data.forEach(function (item) {
                            html += '<tr>';
                            html += '<td><div class="i-checks"><input type="checkbox" class="check checkbox-template" name="id[]" value="' + item.id + '"></div></td>';
                            html += '<td>' + item.sales_code + '</td>';
                            html += '<td>' + item.date + '</td>';
                            html += '<td>' + item.product + '</td>';
                            html += '<td>' + item.quantity + '</td>';
                            html += '<td>' + item.price_per_unit + '</td>';  
                            html += '<td>' + item.total_per_product + '</td>';
                            html += '<td>' + item.operator + '</td>';
                            html += '</tr>';
                        });

                        resultBody.innerHTML = html;
                    } else {
                        resultBody.innerHTML = '<tr><td colspan="8">Tidak ada data yang ditemukan untuk rentang tanggal yang dipilih.</td></tr>';
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error: " + status + ' - ' + error);
                }
            });

            // Download button click event bentuk csv
            document.getElementById("downloadBtn").addEventListener("click", function () {
                $.ajax({
                    url: 'process/P_report.php',
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
                            csvContent += "sales_code,date,product,quantity,price_per_unit,total_per_product,total_transaction,operator\n"; // Header

                            data.forEach(function (item) {
                                var row = [
                                    item.sales_code,
                                    item.date,
                                    item.product,
                                    item.quantity,
                                    item.price_per_unit,
                                    item.total_per_product,
                                    item.total_transaction,
                                    item.operator
                                ].join(",");
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
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Title and period
                doc.setFontSize(16);
                doc.text("Sales Report", 14, 20);
                doc.setFontSize(12);
                doc.text("Periode " + date_from + " sampai dengan " + date_till, 14, 30);

                // Add table
                doc.autoTable({
                    startY: 40,
                    head: [['Sales Code', 'Date', 'Product', 'Quantity', 'Price per Unit', 'Total per Product', 'Operator']],
                    body: Array.from(document.querySelectorAll('#view-tax tbody tr')).map(row =>
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
