<?php
include('header.php');
include('check_session.php');
?>
<div class="container mt-5">
    <h2 class="mb-4">List Sales</h2>
    <table id="salesTable" class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<?php include 'footer.php'; ?>
<!-- Axios JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function editsales() {
        // Initialize dataTable
        var table = $('#salesTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": function(data, callback, settings) {
                axios.get('https://elgianauaswe1.000webhostapp.com//sales/listsales.php', {
                        params: {
                            key: data.search.value
                        }
                    })
                    .then(function(response) {
                        // Add a new property 'no' to each row
                        response.data.forEach(function(row, index) {
                            row.no = index + 1;
                        });

                        callback({
                            draw: data.draw,
                            recordsTotal: response.data.length,
                            recordsFiltered: response.data.length,
                            data: response.data
                        });
                    })
                    .catch(function(error) {
                        console.error(error);
                        alert('Error Fetching sales data');
                    });
            },
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "nama_barang"
                },
                {
                    "data": "desc"
                },
                {
                    "data": "img",
                    "render": function(data, type, row) {
                        return '<img src="' + data + '" alt="Image" style="max-width: 100px; max-height: 100px;">';
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<div class="btn-group">' +
                            '<button class="btn btn-danger btn-sm" style="margin-right: 5px;" onclick="deleteSales(' + row.id + ')">Delete</button>' +
                            '<form action="edit.php" method="post">' +
                            '<input type="hidden" name="id" value="' + row.id + '" >' +
                            '<button type="submit" class="btn btn-primary btn-sm">Edit</button>' +
                            '</form>' +
                            '</div>';
                    }
                }
            ]
        });
    });

    function deleteSales(id) {
        var formData = new FormData();
        formData.append('idsales', id);

        if (confirm('Are you sure you want to delete this sales?')) {
            axios.post('https://elgianauaswe1.000webhostapp.com//sales/deletesales.php', formData)
                .then(function(response) {
                    alert(response.data);
                    // Refresh the DataTable after deletion
                    $('#salesTable').DataTable().ajax.reload();
                })
                .catch(function(error) {
                    console.error(error);
                    alert('Error delete sales');
                });
        }
    }
</script>