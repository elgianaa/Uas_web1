<?php
include 'header.php';
include 'check_session.php';
?>

<div class="container mt-5">
    <!-- Konten Dashboard -->
    <h2 id="welcomeMessage">Selamat datang di Dashboard</h2>
    <!-- Isi dengan konten lainnya -->
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <button onclick="downloadExcel()" class="btn btn-success mr-2">
                <i class="fa fa-download"></i> Unduh Excel
            </button>
            <button onclick="downloadPDF()" class="btn btn-danger">
                <i class="fas fa-download"></i> Unduh PDF
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center font-weight-bold">
            <div class="card bg-success my-4">
                <div class="card-header"> Sales Accumulation </div>
                <div class="card-body bg-light">
                    <h3 id="salesAmount" class="text-dark">
                        <i class="fas fa-newspaper"></i> Loading...
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="tahunSelect">Pilih Tahun</label>
            <select class="form-control" id="tahunSelect"></select>
        </div>
    </div>
    <hr>

    <h2 class="text-center">GRAFIK JUMLAH SALES DALAM 1 TAHUN</h2>
    <div class="row">
        <div class="col-md-12">
            <canvas id="newsChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Fungsi untuk mengambil data dari API berdasarkan tahun menggunakan axios.post 
    function fetchData(tahun) {
        var formData = new FormData();
        formData.append('tahun', tahun);

        return axios({
            method: 'post',
            url: 'https://elgianauaswe1.000webhostapp.com/dashboard/sum_salesyear.php',
            data: formData,
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    }

    // Fungsi untuk membuat chart dengan data yang diambil
    function createChart(data) {
        var ctx = document.getElementById('newsChart').getContext('2d');

        // Check if there is an existing chart and destroy it 
        var existingChart = Chart.getChart(ctx);
        if (existingChart) {
            existingChart.destroy();
        }

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(item => item.bulan),
                datasets: [{
                    label: 'Sales Amount',
                    data: data.map(item => item.sales_amount),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtzero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    // Fungsi untuk mengisi select option dengan tahun 
    function populateSelectOptions(data) {
        var selectElement = document.getElementById('tahunSelect');
        data.forEach(item => {
            var option = document.createElement('option');
            option.value = item.tahun;
            option.text = item.tahun;
            selectElement.add(option);
        });

        // Set default selected year to the latest year 
        var latestYear = data[0].tahun;
        document.getElementById('tahunSelect').value = latestYear;

        // Fetch data and create the initial chart
        fetchData(latestYear)
            .then(response => {
                var chartData = response.data;
                createChart(chartData);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Event listener untuk perubahan select option tahun
    document.getElementById('tahunSelect').addEventListener('change', function() {
        var selectedYear = this.value;
        fetchData(selectedYear)
            .then(response => {
                var chartData = response.data;
                createChart(chartData);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });

    // Inisialisasi select option dengan data tahun dari API
    axios.get('https://elgianauaswe1.000webhostapp.com/dashboard/select_tahun.php')
        .then(response => {
            var tahunData = response.data;
            populateSelectOptions(tahunData);
        })
        .catch(error => {
            console.error('Error fetching tahun data:', error);
        });

    axios.get('https://elgianauaswe1.000webhostapp.com/dashboard/sum_sales.php')
        .then(function(response) {
            // Memproses data yang diterima dari API
            var dataSalesAmount = response.data;
            // Mengambil elemen untuk menampilkan jumlah sales
            var salesAmountElement = document.getElementById('salesAmount');
            // Menampilkan jumlah berita pada dashboard dengan Font Awesome icon
            salesAmountElement.innerHTML =
                `<i class="fas fa-newspaper"></i> Sales Amount: ${dataSalesAmount[0].sales_amount}`;
        })
        .catch(function(error) {
            console.error('Error fetching data:', error);
        });

    function downloadExcel() {
        // Fetch data based on the selected year
        var selectedYear = document.getElementById('tahunSelect').value;
        fetchData(selectedYear)
            .then(response => {
                var data = response.data;

                // Buat worksheet
                var ws = XLSX.utils.json_to_sheet(data);

                // Buat file Excel
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "Laporan");

                // Simpan file Excel dan unduh
                XLSX.writeFile(wb, "laporan_excel_" + selectedYear + ".xlsx");
            })
            .catch(error => {
                console.error('Error fetching data for Excel:', error);
            });
    }

    function downloadPDF() {
        // Ambil elemen canvas dari chart
        var canvas = document.getElementById('newsChart');

        // Konversi elemen canvas menjadi gambar 
        var imgData = canvas.toDataURL('image/png');

        // Ambil tahun terpilih dari dropdown
        var selectedYear = document.getElementById('tahunSelect').value;
        // Definisikan content untuk PDF menggunakan pdfmake
        var docDefinition = {
            content: [{
                    text: 'Laporan Tahun ' + selectedYear,
                    style: 'header'
                },
                {
                    image: imgData,
                    width: 500
                },
            ],
            styles: {
                header: {
                    fontSize: 18,
                    bold: true,
                    margin: [0, 0, 0, 10],
                },
            },
        };
        // Buat PDF menggunakan pdfmake
        pdfMake.createPdf(docDefinition).download('laporan_' + selectedYear + '_pdf.pdf');
    }
</script>
</body>
<?php include 'footer.php'; ?>

</html>