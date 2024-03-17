<?php


//return json formate for every request from browser  
header('Content-Type : application/json');

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods : POST') ;

header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-with') ;

//any formate ar input accept korte pare and convert it into associative
 //formate and also read json
 $data = json_decode(file_get_contents("php://input"),true);

$name = $data['name'];
$id = $data['id'];
$blood = $data['blood'];
$number = $data['number'];
$department = $data['department'];
$email = $data['email'];
$password= $data['password'];
 

$conn=new mysqli("localhost","root","","bloodbank");

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//ete security jnne use korci 
//$password = password_hash($_POST['password'], PASSWORD_DEFAULT);



//akta email dea akber e registration kora jbe eta aikhne korci

//$check_duplicate = "SELECT * FROM mbstublood WHERE email='$email'";
//$duplicate_result = $conn->query($check_duplicate);

//if ($duplicate_result->num_rows > 0) {
  //  echo "Email address already exists. Please use a different email.";
//} 

//$sql = "INSERT INTO student (name,id,email) VALUES ('$name','$id','$email')";

$sql = "INSERT INTO mbstublood (name, student_id,blood_group,phone_number,department,email, password) VALUES ('$name', '$id', '$blood','$number','$department','$email','$password')";


if(mysqli_query($conn,$sql)){
    echo json_encode(array('message' => 'Data insert successfully' ,'status' => true));
}
else {
    echo json_encode(array('message' => 'Data  not insert successfully' ,'status' => false));
}

$conn->close();
?>
