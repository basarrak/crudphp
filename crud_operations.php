<?php
// include เพื่อเชื่อมต่อกับฐานข้อมูล
include 'connectDB.php';
function readData(){
    $sql = "SELECT * FROM register";
    return $sql;
}
// ฟังก์ชันสำหรับเพิ่มข้อมูล
function addData($name, $email, $mobile, $password) {
    global $conn;
    $sql = "INSERT INTO register (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password')";
    if ($conn->query($sql) === TRUE) {
        // echo "Record added successfully";
        echo "<script>
        alert('Record added successfully');
        window.location.href='index.php'; // Redirect to the main page or wherever you want
      </script>";
        // header("location: index.php");
    } else {
        echo "Error adding record: " . $conn->error;
    }
}

// ฟังก์ชันสำหรับแก้ไขข้อมูล
function updateData($id, $name, $email, $mobile, $password) {
    global $conn;
    $sql = "UPDATE register SET name='$name', email='$email', mobile='$mobile', password='$password' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        
        // echo "Record updated successfully";
        echo "<script>
        alert('Record deleted successfully');
        window.location.href='index.php'; // Redirect to the main page or wherever you want
      </script>";
        // header("location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// ฟังก์ชันสำหรับลบข้อมูล
function deleteData($id) {
    global $conn;
    $sql = "DELETE FROM register WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        echo "<script>
        alert('Record deleted successfully');
        window.location.href='index.php'; // Redirect to the main page or wherever you want
      </script>";
        // header("location: index.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// $uID = $_GET['del'];
// echo("<script>console.log('PHP OUTPUT: " . $uID . "');</script>");

// Function to get a single record by ID
function getSingleData($id) {
    global $conn;
    $result = $conn->query("SELECT * FROM register WHERE id = $id");
    // echo $result ;
    return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
}

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่ ในการโพต์ส ข้อมูลขึ้นดาต้าเบส
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];    
    if($name != "" && $email != "" && $mobile != ""  && $password!= "" ){
        echo("<script>console.log('PHP OUTPUT: " .  $name  . "' .);</script>");
        addData($name, $email, $mobile, $password);
    }else{
        echo "All Data's cannot be empty!";
    }
}

// Handle edit and delete actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action === 'edit') {
        // Handle edit action
        if (isset($_POST['edit'])) {
            // If the edit form is submitted, update the data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $password = $_POST['password'];

            updateData($id, $name, $email, $mobile, $password);
        } else {
            // Display the edit form
            $editData = getSingleData($id);
            echo "<h3>Edit Data IDUser: $id</h3>
                <form action='crud_operations.php?action=edit&id=$id' method='post'>
                 
                    <div class='form-group'>
                        <label for='name'>Name:</label>
                        <input type='text' class='form-control' name='name' value='{$editData['name']}' required>
                    </div>

                    <div class='form-group'>
                        <label for='email'>Email:</label>
                        <input type='email' class='form-control' name='email' value='{$editData['email']}' required>
                    </div>

                    <div class='form-group'>
                        <label for='mobile'>Mobile:</label>
                        <input type='text' class='form-control' name='mobile' value='{$editData['mobile']}' required>
                    </div>

                    <div class='form-group'>
                        <label for='password'>Password:</label>
                        <input type='password' class='form-control' name='password' value='{$editData['password']}' required>
                    </div>

                    <button type='submit' class='btn btn-primary' name='edit'>Edit Data</button>
                </form>";
        }
    } elseif ($action === 'delete') {
        // Handle delete action
        deleteData($id);
    }
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
