<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .tbl1 {
            border: 2px solid #ddd;
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
        }

        a:hover {
            background-color: #0056b3;
        }
        .update{
            background-color:rgb(143, 77, 166);
        }
        .delete{
            background-color:red;
        }

        @media (max-width: 768px) {
            .tbl1 th, .tbl1 td {
                padding: 8px;
                font-size: 12px;
            }

            .container {
                margin-left: 0;
                margin-right: 0;
            }

            h1 {
                font-size: 1.5rem;
            }

            a {
                font-size: 12px;
            }
        }

        @media (max-width: 576px) {
            .tbl1 th, .tbl1 td {
                padding: 6px;
                font-size: 10px;
            }

            h1 {
                font-size: 1.2rem;
            }

            a {
                font-size: 10px;
            }
        }
</style>
<body>
    <?php
    $host='localhost';
    $username='root';
    $password='';
    $dbname='crudlisi';
    $table='tbl1';

    try{
        $dsn="mysql:host=$host; dbname=$dbname";
        $conn=new PDO($dsn,$username,$password);

        $sql="SELECT * FROM $table";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $data=$stmt->fetchAll();

        if($data){
            echo "<h1 style='text-align:center; margin-top:30px'>Table </h1><table class='tbl1'>
                <tr>
                <th>Name</th> <th>Surname</th> <th>Gender</th> <th>Prnumber</th> <th>Product</th> <th>Price</th> <th>Amount</th>  <th>Status</th> <th>Total €</th> 
                  <th>Update / Delete</th>  
                </tr>";

            foreach($data as $x){
                echo "<tr>
                <td>{$x['Name']} </td>
                <td>{$x['Surname']} </td>
                <td>{$x['Gender']} </td>
                <td>{$x['Prnumber']} </td>
                <td>{$x['Product']} </td>
                <td>{$x['Price']}€ </td>
                <td>{$x['Amount']} </td>
                <td>{$x['Status']} </td>
                <td>{$x['Total']}€ </td>
                <td>
                <a href='update.php?ID={$x['ID']}' class='update'>UPDATE</a>
                <a href='delete.php?ID={$x['ID']}' class='delete'>DELETE</a>
                </td>
                </tr>";
            }
            echo "</table>";
        }
        else{
            echo "Rekordi nuk u gjet";
        }
    }
    catch (PDOException $a){
        echo "Error ".$a->getMessage();
    }
    ?>
    <?php
    if(isset($_GET['accept'])){
        echo "<h2 id='h1' style='text-align:center'>Record deleted successfully </h1>";
    
    echo "<script>
    setTimeout(function(){
    document.getElementById('h1').style.display='none';
    },5000); 
     </script>";
    }
    if(isset($_GET['message']))
   

    ?>
    <a href="create.php">Create a user </a>
</body>
</html>