<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Anggota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/styles.css?v=<?php echo time(); ?>">
</head>

<body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function index() {
                window.location.href = "index.php";
            }

            function login() {
                window.location.href = "login.php";
            }
            var elgiButton = document.getElementById("Elgi");
            if (elgiButton) {
                elgiButton.addEventListener("click", function() {
                    window.location.href = "detail.php#Elgi";
                });
            }
        });
    </script>

    <div class="text-center mt-5">
        <h1>Selamat datang di tim 3</h1>
        <h3>
            "Kami fokus pada pengembangan platform e-commerce dengan fitur unik yang memungkinkan pengguna untuk menjual berbagai macam barang dengan mudah. Di platform kami, pengguna dapat dengan jelas melihat nama barang, deskripsi lengkap, dan bahkan gambar atau bentuk barang yang dijual tanpa menampilkan harga secara langsung. Kami memahami pentingnya fleksibilitas dalam harga dan ingin memberi peluang bagi penjual untuk menyesuaikan harga mereka dengan kebijakan mereka sendiri. Kami juga akan memperhatikan fitur-fitur keamanan dan privasi untuk memastikan transaksi yang aman dan nyaman bagi pengguna kami. Dengan kerja keras dan kolaborasi tim, kami yakin dapat menciptakan sebuah platform e-commerce yang inovatif dan sesuai dengan kebutuhan pasar."
    </div>

    </div>
    <div class="container mt-5">
        <section class="row">
            <div class="col-md-6 mb-4"> <!-- Ubah col-md-4 menjadi col-md-6 -->
                <div id="myCard">
                    <img src="gambar/el.jpg" class="card-img-top" alt="Elgi">
                    <div class="card-body">
                        <h2 class="card-title">Elgi</h2>
                        <p class="card-text">Mahasiswa</p>
                        <a href="detail.php#Elgi" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4"> <!-- Ubah col-md-4 menjadi col-md-6 -->
                <div id="myCard">
                    <img src="gambar/Fitr.jpg" class="card-img-top" alt="Fitri">
                    <div class="card-body">
                        <h2 class="card-title">Fitri</h2>
                        <p class="card-text">Mahasiswa</p>
                        <a href="detail.php#Fitri" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4"> <!-- Ubah col-md-4 menjadi col-md-6 -->
                <div id="myCard">
                    <img src="gambar/MF.jpg" class="card-img-top" alt="Fahrisah">
                    <div class="card-body">
                        <h2 class="card-title">Fahrisah</h2>
                        <p class="card-text">Mahasiswa</p>
                        <a href="detail.php#Fitri" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4"> <!-- Ubah col-md-4 menjadi col-md-6 -->
                <div id="myCard">
                    <img src="gambar/upi.jpg" class="card-img-top" alt="Lutfi">
                    <div class="card-body">
                        <h2 class="card-title">Lutfi</h2>
                        <p class="card-text">Mahasiswa</p>
                        <a href="detail.php#Fitri" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4"> <!-- Ubah col-md-4 menjadi col-md-6 -->
                <div id="myCard">
                    <img src="gambar/Fawaz.jpg" class="card-img-top" alt="Fawaz">
                    <div class="card-body">
                        <h2 class="card-title">Fawaz</h2>
                        <p class="card-text">Mahasiswa</p>
                        <a href="detail.php#Fitri" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>
<?php include 'footer.php'; ?>

</html>