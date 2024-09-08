<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection from routes/connect.php
    require_once __DIR__ . '/../connect.php';

    // Retrieve and sanitize input
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    // Validate input
    if (empty($username) || empty($password)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'ล็อกอินไม่สำเร็จ',
                    text: 'กรุณากรอกชื่อผู้ใช้และรหัสผ่าน.',
                    preConfirm: () => {
                        Swal.showValidationMessage(`Please enter username and password`);
                    }
                }).then(() => {
                    window.location.reload(); // Reload the page to allow user to try again
                });
              </script>";
        exit;
    }

    // Check if the username exists in the database
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // If the user exists and the password is correct, redirect to Mainselect.php
        echo "<script>
                window.location.href = 'Mainselect.php'; // Redirect to Mainselect.php
              </script>";
        exit;
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'ล็อกอินไม่สำเร็จ',
                    text: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง.'
                }).then(() => {
                    toastr.error('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง.');
                });
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/franken-ui-releases@0.0.13/dist/default.min.css"/>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="script.js"></script>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">POS</a>
        <iconify-icon icon="mdi:cart-outline" class="text-3xl">
        </iconify-icon>
    </div>
  </nav>
<br>

  <div class="flex min-h-[80dvh] flex-col items-center justify-center">
    <div class="mx-auto w-full max-w-md space-y-6">
      <div class="text-center">
        <h1 class="text-3xl font-bold tracking-tight text-foreground">Welcome back</h1>
        <p class="mt-2 text-muted-foreground">Sign in to your account to continue</p>
      </div>

      <form class="space-y-6" action="login.php" method="POST">
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input type="text" name="username" id="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm hover:border-blue-500" required>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm hover:border-blue-500" required>
        <br>
        <button type="submit" id="login-button" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Sign in</button>
        <p class="text-center mt-4">Do you have an account? <a href="register.php" class="text-blue-600 hover:text-blue-800">Click here</a> to Register.</p>
      </div>
      </form> 
    </div>
  </div>
   <footer class="border-t py-6 px-1 text-sm text-muted-foreground fade-in">
          <div class="container mx-auto flex justify-between">
            <p>&copy; 2024 POS. All rights reserved.</p>
            <div class="flex gap-4">
              <a href="#" class="text-muted-foreground">
                Privacy Policy
              </a>
              <a href="#" class="text-muted-foreground">
                Terms of Service
              </a>
            </div>
          </div>
        </footer>

</html>
