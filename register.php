<?php

include 'config.php';

// Define arrays for place of birth options and educational background options
$placeOfBirthOptions = array(
   '111 : langroud',
   '222 : roudsar',
   '333 : rasht',
   '444 : tehran',
   '555 : yazd'
);

$educationalBackgroundOptions = array(
   '11 : software',
   '22 : hardware',
   '33 : Network',
   '44 : Artificial intelligence',
   '55 : security'
);

if(isset($_POST['submit'])){
   // Retrieve form data
   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $fathername = mysqli_real_escape_string($conn, $_POST['fathername']);
   $nationalid = mysqli_real_escape_string($conn, $_POST['nationalid']);
   $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
   $place_of_birth = mysqli_real_escape_string($conn, $_POST['place_of_birth']);
   $educational_background = mysqli_real_escape_string($conn, $_POST['educational_background']);
   $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code']);
   $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
   $landline_number = mysqli_real_escape_string($conn, $_POST['landline_number']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exists.'; 
    }else{
         $insert = mysqli_query($conn, "INSERT INTO `user_form` (firstname, lastname, fathername, nationalid, birth_date, place_of_birth, educational_background, postal_code, mobile_number, landline_number, email) VALUES ('$firstname', '$lastname', '$fathername', '$nationalid', '$birth_date', '$place_of_birth', '$educational_background', '$postal_code', '$mobile_number', '$landline_number', '$email')") or die('query failed');

         if($insert){
            $message[] = 'Registered successfully!';
            header('location: home.php');
         }else{
            $message[] = 'Registration failed!';
         }
      }
   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Register Now</h3>
      <?php
      if(isset($message)){
         foreach($message as $msg){
            echo '<div class="message">'.$msg.'</div>';
         }
      }
      ?>
      <input type="text" name="firstname" placeholder="Enter First Name" class="box" required>
      <input type="text" name="lastname" placeholder="Enter Last Name" class="box" required>
      <input type="text" name="fathername" placeholder="Enter Father's Name" class="box" required>
      <input type="text" name="nationalid" placeholder="Enter National ID" class="box" required>
      <input type="date" name="birth_date" placeholder="Enter Birth Date" class="box" required>
      <select name="place_of_birth" class="box" required>
         <option value="">Select Place of Birth</option>
         <?php
            foreach ($placeOfBirthOptions as $option) {
               echo '<option value="'.$option.'">'.$option.'</option>';
            }
         ?>
      </select>
      <select name="educational_background" class="box" required>
         <option value="">Select Educational Background</option>
         <?php
            foreach ($educationalBackgroundOptions as $option) {
               echo '<option value="'.$option.'">'.$option.'</option>';
            }
         ?>
      </select>
      <input type="text" name="postal_code" placeholder="Enter Postal Code" class="box" required>
      <input type="text" name="mobile_number" placeholder="Enter Mobile Number" class="box" required>
      <input type="text" name="landline_number" placeholder="Enter Landline Number" class="box">
      <input type="email" name="email" placeholder="Enter Email" class="box" required>
      <input type="submit" name="submit" value="Register" class="btn">
      <p>Already have an account? <a href="home.php">Login now</a></p>
   </form>

</div>

</body>
</html>