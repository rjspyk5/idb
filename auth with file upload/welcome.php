<?php
session_start();
if (!$_SESSION['username'] == 'admin') header("Location: index.php");
if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: index.php");
  exit();
}
// Handle image upload
if (isset($_POST["submit"])) {
  $foldar = "uploads/";
  $path = $foldar . $_FILES["image"]["name"];
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $path)) {
    echo "The file " . $_FILES["image"]["name"] . " has been uploaded.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen bg-slate-800">
  <div class="py-32">
    <div class="form-container w-1/3 mx-auto text-center rounded-lg shadow-md shadow-white text-white p-5">
      <h1 class="font-black text-2xl">Welcome, <?= $_SESSION['username'] ?></h1>
      <form method="post" enctype="multipart/form-data">
        <label for="image">Upload Image</label>
        <input type="file" id="image" name="image"><br>
        <input class="btn btn-sm bg-green-500 text-white" type="submit" name="submit" value="Submit">
        <button class="btn btn-sm bg-red-500 text-white" name="logout" type="submit">Logout</button>
      </form>
    </div>
  </div>
  <div class="gallery mt-5">
    <?php
    $foldar = "uploads/";
    $images = scandir($foldar);
    foreach ($images as $image) {
      if ($image != "." && $image != "..") {
        echo "<image src='$foldar/$image' class='w-32 h-32'>";
      }
    }
    ?>
  </div>
</body>

</html>