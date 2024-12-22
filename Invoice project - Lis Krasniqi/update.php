<?php
// PHP code goes first to ensure header() works correctly
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'crudlisi';
$table = 'tbl1';

$rez = null;

// Check if an ID is passed to retrieve data
if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
    $dsn = "mysql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn, $username, $password);
    $sql = "SELECT * FROM $table WHERE ID=:id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    $rez = $stmt->fetch();
}

// Handle form submission for updating data
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $prnumber = $_POST['prnumber'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];
    $total = $price * $amount;

    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);

        $sql = "UPDATE $table SET
                Name = :name,
                Surname = :surname,
                Gender = :gender,
                Prnumber = :prnumber,
                Product = :product,
                Price = :price,
                Amount = :amount,
                Total = :total,
                Status = :status
                WHERE ID = :id";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':surname' => $surname,
            ':gender' => $gender,
            ':prnumber' => $prnumber,
            ':product' => $product,
            ':price' => $price,
            ':amount' => $amount,
            ':total' => $total,
            ':status' => $status,
            ':id' => $id
        ]);

        // Redirect to read.php after updating the record
        header("Location: read.php?message=Record update successfully");
        exit(); // Ensure no further code is executed after the redirect
    } catch (PDOException $a) {
        echo "Error: " . $a->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Styling as before */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f9;
        }
        form {
            width: 400px;
            border: 2px solid black;
            border-radius: 15px;
            background-color: rgb(93, 164, 95);
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }
        input, select {
            margin-bottom: 3px;
            border-radius: 8px;
            padding: 0px;
            width: 100%;
            color: white;
        }
        #btn {
            margin-top: 10px;
            width: 150px;
            color: black;
        }
        select {
            text-align: center;
        }
        @media (max-width: 768px) {
            form {
                width: 90%;
                max-width: 400px;
            }
        }
        @media (max-width: 576px) {
            form {
                width: 100%;
                padding: 15px;
            }
            .go-back {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="name" class="form-label">Client Name</label>
        <input type="text" name="name" placeholder="Client Name" class="btn btn-light" value="<?php echo htmlspecialchars($rez['Name']); ?>">

        <label for="surname" class="form-label">Client Surname</label>
        <input type="text" name="surname" placeholder="Client Surname" class="btn btn-light" value="<?php echo htmlspecialchars($rez['Surname']); ?>">

        <label for="gender" class="form-label">Gender</label>
        <select name="gender" class="form-control bg-light" required>
            <option value="Male" <?php echo $rez['Gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo $rez['Gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
        </select>

        <label for="prnumber" class="form-label">Personal Number</label>
        <input type="number" name="prnumber" placeholder="Personal Number" class="btn btn-light" max="10000000" value="<?php echo htmlspecialchars($rez['Prnumber']); ?>">

        <label for="product" class="form-label">Product</label>
        <input type="text" name="product" placeholder="Product" class="btn btn-light" value="<?php echo htmlspecialchars($rez['Product']); ?>">

        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" placeholder="Price" class="btn btn-light" value="<?php echo htmlspecialchars($rez['Price']); ?>">

        <label for="amount" class="form-label">Amount</label>
        <input type="number" name="amount" placeholder="Amount" class="btn btn-light" value="<?php echo htmlspecialchars($rez['Amount']); ?>">

        <label for="status" class="form-label">Status</label>
        <input type="text" name="status" placeholder="Status" class="btn btn-light" value="<?php echo htmlspecialchars($rez['Status']); ?>">

        <input type="submit" name="register" value="Update" class="btn btn-primary" id="btn">
        <a href="read.php" style="text-decoration:none;" class="go-back">Go back to dashboard</a>
    </form>
</body>
</html>
