<?php
session_start();
if (!$_SESSION['username'] == 'admin') header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome</title>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
<style>
input[type=text], select {

  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

</style>
</head>
<body class="h-screen bg-slate-800">
<div class="py-32">
<div class="form-container w-1/3 mx-auto text-center rounded-lg shadow-md shadow-white text-white p-5">
    
    <h1 class="font-black text-2xl">Welcome, <?= $_SESSION['username'] ?></h1>
    <form >


    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name.."><br>
    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name.."><br>
    <label for="lname">Give Adress</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name.."><br>
   

    <input class="btn btn-sm bg-green-500 text-white" type="submit" value="Submit">
    <a class="btn btn-sm bg-red-500 text-white" href="logout.php">Logout</a>
  </form>
  </div>
</div>
</body></html>
