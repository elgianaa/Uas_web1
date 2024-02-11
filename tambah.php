<?php
include('header.php');
include('check_session.php');
?>
<div class="container mt-5">
    <h2 class="mb-4">Add News Form</h2>
    <form id="addNewsForm">
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" class="form-control" maxlength="50" id="nama_barang" name="nama_barang" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" cols="30" rows="10" required></textarea>
        </div>

        <div class="form-group">
            <label for="url_image">Image:</label>
            <input type="file" class="form-control-file" id="url_image" name="url_image" accept="image/*" required>
        </div>
        <button type="button" class="btn btn-primary" onclick="addSales()">Add Sales</button>
    </form>
</div>
<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function redirectToDashboard() {
        window.location.href = 'dashboard.php';
    }

    function redirectToTambahData() {
        window.location.href = 'tambah.php';
    }

    function redirectToKelolaData() {
        window.location.href = 'kelola.php';
    }

    function logout() {
        // Implement your logout logic here
        // ...

        // Redirect to the login page after logout
        window.location.href = 'login.php';
    }

    function addSales() {
        const nama_barang = document.getElementById('nama_barang').value;
        const deskripsi = document.getElementById('deskripsi').value;
        const url_image_input = document.getElementById('url_image');
        const url_image = url_image_input.files[0];
        const tanggal = new Date().toISOString().split('T')[0];

        var formData = new FormData();
        formData.append('nama_barang', nama_barang);
        formData.append('deskripsi', deskripsi);
        formData.append('url_image', url_image);
        formData.append('tanggal', tanggal);

        axios.post('https://elgianauaswe1.000webhostapp.com/sales/addsales.php', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
            .then(function(response) {
                console.log(response.data);
                alert(response.data);
                document.getElementById('addNewsForm').reset();
            })
            .catch(function(error) {
                console.error(error);
                alert('Error Adding news');
            });
    }
</script>