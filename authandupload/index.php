<?php
session_start();
if (isset($_POST['submit'])  && $_POST['username'] == 'admin' && $_POST['password'] == 'admin') {
    $_SESSION['username'] = 'admin';
    header("Location: welcome.php");
    exit();
}
$error = isset($_POST['submit'])  && $_POST['username'] !== 'admin' && $_POST['password'] !== 'admin' ? "Invalid username or password. Please try again." : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-800 h-screen">
    <div class="py-32">
        <div class="form-container w-1/3 mx-auto  p-5  text-center rounded-lg shadow-md shadow-white text-white">
            <h2 class="text-2xl font-black">Admin Login</h2>
            <p class="text-red-500"><?php echo ($error) ?></p>
            <form class="space-y-3 space-x-3 *:rounded-lg" method="post" action="">
                <label class="ml-3" for="username">Username:</label>
                <input type="text" class="p-1" id="username" name="username" required><br>
                <label for="password">Password:</label>
                <input class="p-1" type="password" id="password" name="password"><br>
                <input class="btn btn-sm bg-green-500 text-white" type="submit" name="submit" value="Login">
            </form>
            <div>
            </div>
        </div>
</body>

</html>