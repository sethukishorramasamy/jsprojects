<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <!-- Include Bootstrap and jQuery libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="details.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">User Data</h1>
        <table class="table table-success table-striped table-bordered table-hover mt-4">
            <thead>
                <tr>
                    <th style='padding:17px;'>Email Address</th>
                    <th style='padding:17px;'>Number</th>
                    <th style='padding:17px;'>Action</th>
                </tr>
            </thead>
            <tbody id="userTable">
                <!-- Table rows will be added here using JavaScript -->
            </tbody>
        </table>
    </div>
    
    <script>
        // JavaScript function to load user data and create table rows
        $(document).ready(function () {
            // Fetch and populate user data on page load
            fetchUserData();
        });

        // Function to fetch user data from the server
        function fetchUserData() {
            $.ajax({
                url: 'getUsers.php',
                type: 'GET',
                success: function (data) {
                    $('#userTable').html(data);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // JavaScript function to delete a row
        function deleteRow(id) {
            if (confirm("Are you sure you want to delete this row?")) {
                $.ajax({
                    url: 'deleteRow.php',
                    type: 'POST',
                    data: { id: id },
                    success: function (response) {
                        // Remove the row from the table
                        fetchUserData();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        }
    </script>
</body>
</html>
