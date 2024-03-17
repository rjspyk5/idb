<?php
session_start();
if (!$_SESSION['username'] == 'admin') header("Location: index.php");
if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: index.php");
  exit();
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
  <link rel="stylesheet" href="style.css">
  <style>
    th,
    td,
    body {
      border: 1px solid white;
      border-collapse: collapse;
      padding: 10px;
    }
  </style>
</head>

<body class="">
  <h1 id="wellcome" class="font-black text-2xl text-center pb-10 text-white">Welcome, <?php echo $_SESSION['username'] ?></h1>
  <?php
  // Handle image upload
  $formData = [];
  if (isset($_POST["submit"])) {
    $foldar = "uploads/";
    $path = $foldar . $_FILES["image"]["name"];
    if ($_FILES["image"]["size"] < 2000 * 1024) {
      move_uploaded_file($_FILES["image"]["tmp_name"], $path);
    } else {
      echo "<h1 class='text-center text-red-500 pb-5'>File must be under 2000kb</h1>";
    }
    // Handle form data
    $formData = json_decode(file_get_contents('form_data.txt'), true) ?: [];
    array_push($formData, $_POST);
    file_put_contents('form_data.txt', json_encode($formData) . PHP_EOL);
  }
  ?>
  <div class="flex justify-around">
    <form method="post" class="pb-10" enctype="multipart/form-data">
      <div class="rounded-lg *:text-white *:font-bold shadow-md shadow-white  mx-auto p-2">
        <label for="name" class="">Name :</label>
        <input type="text" id="name" name="name">
        <label for="number" class="">Number:</label>
        <input type="number" id="number" name="number">
        <div class="flex jusstify-center">
          <label for="image" class="text-white font-bold">Upload Image :</label><br>
          <input type="file" id="image" name="image">
        </div>

        <input class="btn btn-sm bg-green-500 text-white" type="submit" name="submit" value="Submit">
      </div>
      <button class="rounded-lg px-3 py-1 bg-red-500 text-white fixed bottom-10 right-12" name="logout" type="submit">Logout</button>
    </form>
    <div class="text-white shadow-md shadow-white p-4">
      <?php
      if (!empty($formData)) {
        echo '<h2 class="text-2xl py-4">Submitted Form Data:</h2><table><tr >';
        foreach (array_keys($formData[0] ?? []) as $header) {
          if ($header != "submit") {
            echo '<th class="text-bold text-lg uppercase text-green-500">' . $header . '</th>';
          }
        }
        echo '</tr>';
        foreach ($formData as $submission) {
          echo '<tbody> <tr>';
          foreach ($submission as $value) {
            if ($value != "Submit") {
              echo '<td>' . $value . '</td>';
            }
          }
          echo '</tr>';
        }
        echo '</tbody> </table>';
      }
      ?>
    </div>
  </div>

  <div class="gallery grid grid-cols-3 gap-10 min-h-[435px] rounded-lg shadow-md shadow-white container mx-auto p-5">
    <?php
    $foldar = "uploads/";
    $images = scandir($foldar);
    foreach ($images as $image) {
      if ($image != "." && $image != "..") {
        echo "<img src='$foldar/$image' class='w-[400px] h-[350px] rounded-xl'>";
      }
    }
    ?>
  </div>

  <!-- my special functionality -->
  <script>
    let wellcome = document.getElementById("wellcome");
    const handleTimeout = () => {
      wellcome.innerText = ``
    }
    setTimeout(handleTimeout, 3000);
  </script>
</body>

</html>