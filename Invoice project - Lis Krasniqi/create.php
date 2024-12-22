<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
     /* Siguro që html dhe body të kenë lartësinë 100% */
     html, body {
            height: 100%; /* Për të mundësuar centrimin vertikal */
            margin: 0; /* Heq ndonjë margjinë që mund të ketë ndikuar */
            display: flex;
            justify-content: center; /* Qendra horizontale */
            align-items: center; /* Qendra vertikale */
            background-color: #f4f4f9; /* Ngjyrë e butë për background-in */
        }
        

        /* Formati i formularit */
        form {
            width: 400px; /* Gjerësi për formularin */
            height: 570px; /* Lartësia e formularit */
            border: 2px solid black;
            border-radius: 15px;
            background-color:rgb(93, 164, 95);           ;
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            align-items: center;
            padding: 20px; /* Përdorim padding për të krijuar hapësirë brenda formularit */
        }

        /* Stilimi i inputeve */
        input {
            margin: 10px;
            border-radius: 8px;
            padding: 10px;
            width: 100%; /* Inputet mbushin të gjithë hapësirën */
            color:white;
        }
        select{
            text-align:center;
        }
        /* Stilimi i butonit të dërgimit */
        #btn {
            width: 150px;
            color: white;
            border: 2px solid black;

        }
        @media (max-width: 768px) {
            form {
                width: 90%; /* For smaller screens, use 90% width */
                max-width: 400px; /* Adjust max-width for smaller devices */
            }

            input, select {
                padding: 8px; /* Slightly smaller padding on smaller screens */
            }

            h3 {
                font-size: 1.5rem; /* Adjust heading size for smaller screens */
            }
        }

        @media (max-width: 576px) {
            form {
                width: 100%; /* Full width for very small screens */
                padding: 15px; /* Adjust padding for very small screens */
            }

            h3 {
                font-size: 1.2rem; /* Smaller font size for heading */
            }
        }
</style>
<body>
    
    <form action="create.php" method="post">
        <h3>Create a user</h3>
        <input type="text" name="name" placeholder="Client Name" class="btn btn-light">
        <input type="text" name="surname" placeholder="Client Surname" class="btn btn-light">
        <select name="gender" class="form-control bg-light" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        <input type="number" name="prnumber" placeholder="Personal Number" class="btn btn-light">
        <input type="text" name="product" placeholder="Product" class="btn btn-light">
        <input type="number" name="price" placeholder="Price" class="btn btn-light">
        <input type="number" name="amount" placeholder="Amount" class="btn btn-light">
        <input type="text" name="status" placeholder="Status" class="btn btn-light">
        <input type="submit" name="register" value="Register" id="btn" class="btn btn-primary">
    </form>
    <?php
        $host='localhost';
        $username='root';
        $password='';
        $dbname='crudlisi';
        $table='tbl1';

        if(isset($_POST['register'])){
            $name=$_POST['name'];
            $surname=$_POST['surname'];
            $gender=$_POST['gender'];
            $product=$_POST['product'];
            $amount=$_POST['amount'];
            $prnumber=$_POST['prnumber'];
            $status=$_POST['status'];
            $price=$_POST['price'];
            
            $register=$_POST['register'];


            if(empty($name) || empty($surname) || empty($gender) || empty($product) || empty($amount) || empty($prnumber) || 
            empty($status) || empty($price)){
                die("Ju lutem plotesoni te gjitha inputet");
            }
            $total= $price*$amount;

            try{
                $dsn="mysql:host=$host; dbname=$dbname";
                $conn=new PDO($dsn,$username,$password);

                $sql="INSERT INTO $table (Name,Surname,Gender,Product,Amount, Prnumber, Status,Total,Price)
                VALUES(:name,:surname,:gender,:product,:amount,:prnumber,:status,:total,:price)";

                $stmt=$conn->prepare($sql);
                $stmt->execute([':name'=>$name,':surname'=>$surname,':gender'=>$gender,':product'=>$product,':amount'=>$amount,
                ':prnumber'=>$prnumber,':status'=>$status,':total'=>$total,':price'=>$price]);
                echo "<h3 style='text-align:center; padding-top:10px;'>Added to the table successfully<h3>";
                header("Location:read.php");
            }
            catch(PDOException $a){
                echo "ERROR: ".$a->getMessage();
            }
        }
    ?>
</body>
</html>
