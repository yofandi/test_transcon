<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View -  Transaction No - {{ $transactionmix->no_transaction }}</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Card Form -->
        <div class="card">
            <div class="card-header">
                <h4>View </h4>
            </div>
            <div class="card-body">
                <form @disabled(true)>
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Transaction No</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $transactionmix->no_transaction }}" disabled>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Transaction Date</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ $transactionmix->transaction_date }}" disabled>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-border">
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                    </tr>
                                    @if ($transactionmix && $transactionmix->transactionDetails->count() > 0)
                                        @foreach ($transactionmix->transactionDetails as $transactionItem)
                                            <tr>
                                                <td>{{ $transactionItem->transaction_id }}</td>
                                                <td>{{ $transactionItem->item }}</td>
                                                <td>{{ $transactionItem->quantity }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">No transaction details available.</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <a href="{{ route('programming.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
