<?php


//return json formate for every request from browser  
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);


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

$check_duplicate = "SELECT * FROM blood WHERE email='$email'";
$duplicate_result = $conn->query($check_duplicate);
$ans=0;


$length = strlen($email);

// Initialize an empty variable to store characters one by one
$individualCharacters = '';

// Traverse the email address and store each character
for ($i = 0; $i < $length; $i++) {
    if($email[$i] == '@') {
        break;
    }
    $currentCharacter = $email[$i];
    // Store the current character in the new variable or perform any other operations
    $individualCharacters .= $currentCharacter;
}
$individualCharacters =strtoupper($individualCharacters);
$id =strtoupper($id);






if ($duplicate_result->num_rows > 0) {
    echo json_encode(array('message' => 'Email Address Already Exits' ,'status' => false));
    $ans=-1;
} 
else if($individualCharacters != $id){
    echo json_encode(array('message' => 'ID AND EMAIL NOT MATCHH ' ,'status' => false));
}

//$sql = "INSERT INTO student (name,id,email) VALUES ('$name','$id','$email')";
else {
$sql = "INSERT INTO blood (name, student_id,blood_group,phone_number,department,email, password) VALUES ('$name', '$id', '$blood','$number','$department','$email','$password')";


if(mysqli_query($conn,$sql) and $ans == 0){
    echo json_encode(array('message' => 'Data Insert Successfully' ,'status' => true));
}
else {
    echo json_encode(array('message' => 'Data  Not Insert Successfully' ,'status' => false));
}
}
?>