<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - MYSQL - CRUD</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
          <!-- เพิ่ม Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
    /* เพิ่มสไตล์เสริม (CSS) ตามต้องการ */
    body {
        padding: 20px;
    }
    

    table {
        margin-top: 20px;
    }
</style>
</head>

<body>


<div class="container">
<div><h2>PHP MySQL - CRUD</h2></div> 

    <?php
    // include เพื่อเชื่อมต่อกับฐานข้อมูล connectDB.php 
    include 'connectDB.php';
    include 'crud_operations.php';
    ?>
<!-- Display Add/Edit Form -->

<?php
 
    if (isset($_GET['action']) && $_GET['action'] === 'edit') {
        // Edit Form
        $editId = $_GET['id'];
        
       
           
    } else {
        // Add Form
        echo "<div class='form-container'><h3>Add Data</h3>
            <form action='crud_operations.php?action=add' method='post'>
                <div class='form-group'>
                    <label for='name'>Name:</label>
                    <input type='text' class='form-control' name='name' required>
                </div>

                <div class='form-group'>
                    <label for='email'>Email:</label>
                    <input type='email' class='form-control' name='email' required>
                </div>

                <div class='form-group'>
                    <label for='mobile'>Mobile:</label>
                    <input type='text' class='form-control' name='mobile' required>
                </div>

                <div class='form-group'>
                    <label for='password'>Password:</label>
                    <input type='password' class='form-control' name='password' required>
                </div>

                <button type='submit' class='btn btn-primary' name='add'>Add Data</button>
            </form></div>";
            echo " <div class='table-container'><h3>Data Table</h3>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Password</th>
                        <th>Edit</th>
                        <th>Deleted</th>
                    </tr>
                </thead>
                <tbody>";
                // ตัวแปล สาธารณะ ที่ได้มาจาก connectDB.php
                global $conn;
           
                // สร้างการเชื่อมต่อ
                $conn = new mysqli($servername, $username, $password, $dbname);
                $sql = readData();
                $result = $conn->query($sql);
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['mobile']}</td>
                            <td>{$row['password']}</td>
                            <td><a href='index.php?action=edit&id={$row['id']}'>Edit</a></td>
                            <td><a href='crud_operations.php?action=delete&id={$row['id']}'>Delete</a></td>
                        </tr>";
                }
            }

            echo "</tbody>
            </table></div>";
    }
    ?>
   
   
      

</div>
    <!-- เพิ่ม Bootstrap JS และ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
