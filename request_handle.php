<?php
session_start();
require_once 'class/Database.php';
require_once 'class/Auth.php';

$db=new Database();
$conn=$db->getConnection();
$auth =new Auth($conn);

if(isset($_POST['register'])){
$auth->name=$_POST['name'];
$auth->password=$_POST['pass'];
if($auth->register()){
    echo "register succesfully";
}
else{
    echo "not regiser";
}
}
if(isset($_POST['login'])){
    $auth->name=$_POST['name'];
$auth->password=$_POST['pass'];
if($auth->login()){
  $_SESSION['user']=[
    'id' => $auth->id,
    'name' => $auth->name
  ];
header('location: dashboard.php');
}
else{
    echo "username and password is incorrect";
}
}
if(isset($_GET['id'])){
   Auth::logout();

}
// Get the raw POST data from the request
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {


    // Assuming $auth is an object with properties `name` and `id`
    $auth->name = $data['name'];
    $auth->id =$data['id'];

    // Call the update method on the $auth object
    if ($auth->update()) {
        echo json_encode(['status' => 'success', 'message' => 'Updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Update failed']);
    }
}



?>