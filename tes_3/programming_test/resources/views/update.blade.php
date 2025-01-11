<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Transaction : {{ $transactionmix->id }}</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Card Form -->
        <div class="card">
            <div class="card-header">
                <h4>Form Edit</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('programming.update', $transactionmix->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="number" class="form-label">Transaction No</label>
                        <input type="number" class="form-control" id="transaction_no" name="transaction_no"
                            value="{{ $transactionmix->no_transaction }}">
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Transaction Date</label>
                        <input type="date" class="form-control" id="date" name="transaction_date"
                            value="{{ $transactionmix->transaction_date }}">
                    </div>

                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Transaction Items</h4>
                            </div>
                            <div class="card-body">
                                {{-- <button id="clickAddItem" class="btn btn-primary mb-3">Add Item</button> --}}
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered" id="itemTable">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('programming.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var transactionId = '{{ $transactionmix->id }}'; // Ganti dengan ID transaksi yang sesuai

            // Mengambil transaction details dengan AJAX
            $.ajax({
                url: '/transaction/' + transactionId + '/details', // URL route yang kita buat
                type: 'GET',
                success: function(response) {
                    // Jika berhasil, masukkan data ke dalam tabel
                    var tableBody = $('#itemTable tbody');
                    tableBody.empty(); // Kosongkan tabel sebelum menambahkan data baru

                    // Loop melalui data response dan tambahkan ke tabel
                    response.forEach(function(transactionItem) {
                        var row = `
                            <tr data-id="${transactionItem.id}">
                                <td><input type="hidden" class="form-control" name="iditem[]" value="${transactionItem.id}" required><input type="text" class="form-control" name="item[]" value="${transactionItem.item}" required></td>
                                <td><input type="number" class="form-control" name="quantity[]" value="${transactionItem.quantity}" required></td>
                                <td><button type="button" class="btn btn-danger delete-item">Delete</button></td>
                            </tr>
                        `;
                        tableBody.append(row); // Tambahkan row baru ke dalam tabel
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error fetching data: ' + error);
                }
            });

            // Menggunakan event delegation untuk tombol Delete
            $(document).on('click', '.delete-item', function() {
                // Mendapatkan ID dari row yang akan dihapus
                var row = $(this).closest('tr');
                var itemId = row.data('id'); // Mengambil ID item dari atribut data-id

                // Menanyakan konfirmasi pengguna
                if (confirm('Anda yakin menghapus item ini?')) {
                    $.ajax({
                        url: '/transaction/detail/delete', // Endpoint yang menangani penghapusan
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}', // CSRF token untuk keamanan
                            item_id: itemId // Mengirim ID item yang akan dihapus
                        },
                        success: function(response) {
                            if (response.success) {
                                // Menghapus row dari tabel jika berhasil
                                row.remove();
                            } else {
                                alert('Failed to delete the item.');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + error);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
