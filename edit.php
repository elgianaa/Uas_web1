<?php
include('header.php');
include('check_session.php');

// Ambil ID dari $_POST
$id = isset($_POST['id']) ? $_POST['id'] : null;

?>

<div class="container mt-5">
    <h2 class="mb-4">Edit Sales Form</h2>
    <form id="editSalesForm">
        <input type="hidden" id="salesId" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" class="form-control" maxlength="50" id="nama_barang" name="nama_barang" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Content:</label>
            <!-- Changed from input to textarea for content -->
            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
        </div>
        <div class="form-group">
            <label for="img_url">Image:</label>
            <!-- Corrected id from "url_image" to "img_url" and name from "url_name" to "img_url" -->
            <input type="file" class="form-control-file" id="img_url" name="img_url" accept="image/*" required>
        </div>
        <button type="button" class="btn btn-primary" onclick="editSales()">Edit Sales</button>
    </form>
</div>
<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function getData() {
        const salesId = document.getElementById('salesId').value;
        var formData = new FormData();
        formData.append('idsales', salesId);
        //lakukan permintaan AJAX untuk mendapatkan data dari berita berdasakan ID
        axios.post('https://elgianauaswe1.000webhostapp.com/dashboard/selectdata.php', formData)
            .then(function(response) {
                //isi nilai input dengan data yang diterima 
                document.getElementById('nama_barang').value = response.data.title;
                document.getElementById('deskripsi').value = response.data.desc;
            })
            .catch(function(error) {
                console.error(error);
                alert('Error fetching Sales data');
            });
    }

    function editSales() {
        const salesId = document.getElementById('salesId').value;
        const nama_barang = document.getElementById('nama_barang').value;
        const deskripsi = document.getElementById('deskripsi').value;
        const img_urlInput = document.getElementById('img_url');
        const img_url = img_urlInput.files[0];
        const tanggal = new Date().toISOString().split('T')[0];
        //get form data
        var formData = new FormData();
        formData.append('idsales', salesId);
        formData.append('nama_barang', nama_barang);
        formData.append('deskripsi', deskripsi);
        formData.append('tanggal', tanggal);

        if (img_urlInput.files.length > 0) {
            formData.append('url_image', img_url);
        } else {
            formData.append('url_image', null);
        }
        //lakukan permintaan AJAX untuk mengedit berita
        axios.post('https://elgianauaswe1.000webhostapp.com/sales/editsales.php', formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then(function(response) {
                console.log(response.data);
                alert(response.data);
                window.location.href = 'kelola.php';
            })
            .catch(function(error) {
                console.error(error);
                alert('Error Editing sales');
            });
    }

    window.onload = getData;
</script>