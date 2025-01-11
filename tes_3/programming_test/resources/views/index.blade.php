<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programming Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="flex mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            Programming Test : Build Simple Apps
                        </div>
                        <div class="col-4">
                            <a href="{{ route('programming.create') }}">Add Transaction</a>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn"
                        style="float: right; background: none; border: none; font-size: 1.5rem; line-height: 1;"
                        data-bs-dismiss="alert" aria-label="Close">
                        &times;
                    </button>
                </div>
            @endif
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Transaksi</th>
                            <th scope="col">Total Item</th>
                            <th scope="col">Total Quantity</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <th scope="row">{{ $transaction->id }}</th>
                                <td>{{ $transaction->no_transaction }}</td>
                                <td>{{ $transaction->total_item }}</td>
                                <td>{{ $transaction->total_quantity }}</td>
                                <td>
                                    <a href="{{ route('programming.show', $transaction->id) }}" class="btn btn-info">View</a> ||
                                    <a href="{{ route('programming.edit', $transaction->id) }}" class="btn btn-warning">Edit</a> ||
                                    <form action="{{ route('programming.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Anda yakin ingin menghapus transaksi ini?')" class="btn btn-danger">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>
