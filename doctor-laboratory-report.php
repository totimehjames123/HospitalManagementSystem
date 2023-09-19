<?php
    include "connect.php";

    $id = $_GET['id'];
    $diagnosticsReport = "";
    $diagnosticsDetails = "";

    $sql = "SELECT * FROM laboratory WHERE id = $id";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $diagnosticsReport = $row['diagnosticsReport'];
        $diagnosticsDetails = $row['diagnosticsDetails'];
    }

    mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Report Display</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center" style=" min-height: 80vh;">
                        <h2 class="card-title mb-4">Laboratory Report</h2>
                        <?php if (!empty($diagnosticsDetails)) { ?>
                            <h4>Diagnostic Report</h4>
                            <div class="rounded w-100 p-3" style="width: 100%; height: 50vh;">
                                <img class="rounded" src="uploads/<?php echo $diagnosticsReport ?>" alt="" style="width: 100%; height: 100%;">
                            </div>
                            <div class="">
                                <h4>Report Details</h4>
                               <?php echo $diagnosticsDetails ?>
                               
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-danger" role="alert">
                                No diagnostic report found for ID: <?php echo $id; ?>
                            </div>
                        <?php } ?>
                        <div class="">
                            <a href="laboratorist-request.php">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
