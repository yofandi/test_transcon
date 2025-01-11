<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Add Transaction</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Card Form -->
        <div class="card">
            <div class="card-header">
                <h4>Form Example</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('programming.store') }}" method="POST">
                    @csrf
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="number" class="form-label">Transaction No</label>
                        <input type="number" class="form-control" id="transaction_no" name="transaction_no">
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Transaction Date</label>
                        <input type="date" class="form-control" id="date" name="transaction_date">
                    </div>

                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Transaction Items</h4>
                            </div>
                            <div class="card-body">
                                <button id="clickAddItem" class="btn btn-primary mb-3">Add Item</button>
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered" id="itemTable">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control" name="item[]">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="quantity[]">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
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
            // Add a new row when the button is clicked
            $("#clickAddItem").click(function() {
                var newRow = `
                    <tr>
                        <td><input type="text" class="form-control" name="item[]" required></td>
                        <td><input type="number" class="form-control" name="quantity[]" required></td>
                    </tr>
                `;
                // Append the new row to the table body
                $("#itemTable tbody").append(newRow);
            });
        });
    </script>
</body>

</html>
