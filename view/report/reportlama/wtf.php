document.addEventListener('DOMContentLoaded', function () {
    var allreport = document.getElementById("allreport");
    var resultContainer_allReport = document.getElementById("resultContainer_allReport");
    var resultBodyAll = document.getElementById("detailBodyAll");
    var resultContainer_allReportDetail = document.getElementById("resultContainer_allReportDetail");
    var detailBodyAll = document.getElementById("detailBodyAll");
    var form = document.getElementById("reportForm");

    allreport.addEventListener("click", function (event) {
        event.preventDefault();

        var date_from = document.getElementById("date_from").value;
        var date_till = document.getElementById("date_till").value;

        $.ajax({
            url: 'P_report.php', // URL endpoint Anda
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
                            html += '<td>' + formatDate(item.date) + '</td>';
                            html += '<td>' + formatRupiah(item.total) + '</td>';
                            html += '<td><button type="button" data-date="'+item.date+'" data-operator="'+operator+'" class="btn btn-primary showDetailAll">Detail</button></td>';
                            html += '</tr>';
                            total += parseFloat(item.total);
                        });

                        html += '</tbody>';
                        html += '<tfoot><tr><td colspan="2" style="text-align: right; font-weight: bold;">Total Transaksi:</td><td style="font-weight: bold;">' + formatRupiah(total) + '</td></tr></tfoot>';
                        html += '</table>';
                        grandtotal += total;
                    });

                    document.getElementById("totalTransactionAll").textContent = formatRupiah(grandtotal);
                    resultBodyAll.innerHTML = html;
                    resultContainer_allReport.style.display = 'block';
                    form.style.display = 'none';

                    // Event listener untuk tombol Detail
                    document.querySelectorAll('.showDetailAll').forEach(function(button) {
                        button.addEventListener("click", function (event) {
                            event.preventDefault();

                            var selectedDate = this.getAttribute('data-date');
                            var operator = this.getAttribute('data-operator');

                            $.ajax({
                                url: 'P_report.php', // URL endpoint Anda
                                type: 'POST',
                                data: {
                                    'aksi': 'getReportDetailAll',
                                    'date_from': date_from,
                                    'date_till': date_till,
                                    'operator': operator,
                                    'selected_date': selectedDate
                                },
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status === 'success') {
                                        var data = response.data;
                                        var html = '';
                                        var total = 0;

                                        data.forEach(function (item) {
                                            var itemTotal = parseFloat(item.price_per_unit) * parseFloat(item.quantity);
                                            total += itemTotal;

                                            html += '<tr>';
                                            html += '<td>' + item.sales_code + '</td>';
                                            html += '<td>' + formatDate(item.date) + '</td>';
                                            html += '<td>' + item.product + '</td>';
                                            html += '<td style="text-align: center;">' + item.quantity + '</td>';
                                            html += '<td style="text-align: right;">' + item.price_per_unit + '</td>';
                                            html += '<td style="text-align: right;">' + itemTotal + '</td>';
                                            html += '<td style="text-align: right;">' + item.discount + '</td>';
                                            html += '<td style="text-align: right;">' + item.tax + '</td>';
                                            html += '<td style="text-align: right;">' + item.service + '</td>';
                                            html += '</tr>';
                                        });

                                        html += '<tfoot><tr><td colspan="8" style="text-align: right; font-weight: bold;">Total Transaksi:</td><td style="font-weight: bold;">' + formatRupiah(total) + '</td></tr></tfoot>';
                                        html += '</table>';

                                        detailBodyAll.innerHTML = html;
                                        resultContainer_allReportDetail.style.display = 'block';
                                        resultContainer_allReport.style.display = 'none';
                                    } else {
                                        detailBodyAll.innerHTML = '<tr><td colspan="8">Tidak ada data yang ditemukan untuk tanggal yang dipilih.</td></tr>';
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
                    document.getElementById("totalTransactionAll").textContent = '0';
                    resultContainer_allReport.style.display = 'block';
                    form.style.display = 'none';
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error: " + status + ' - ' + error);
            }
        });
    });
});
