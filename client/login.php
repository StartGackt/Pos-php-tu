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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
  
  <div class="flex min-h-[80dvh] flex-col items-center justify-center">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="mx-auto w-full max-w-md space-y-6">
      <div class="text-center">
        <h1 class="text-3xl font-bold tracking-tight text-foreground">Welcome back</h1>
        <p class="mt-2 text-muted-foreground">Sign in to your account to continue</p>
      </div>

      <form class="space-y-6" action="" method="POST">
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>

          <input type="text" name="username" id="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm hover:border-blue-500" required>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm hover:border-blue-500" required>
        </div>
        <button type="submit" id="login-button" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Sign in</button>
        <p class="text-center mt-4">Do you have an account? <a href="register.php" class="text-blue-600 hover:text-blue-800">Click here</a> to Register.</p>
      </form> 
    </div>
  </div>

  <?php
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $connectFile = $_SERVER['DOCUMENT_ROOT'] . '/Pos-php-tu/connect.php';
      if (file_exists($connectFile)) {
          include $connectFile;
      } else {
          echo "<script>
                  Swal.fire({
                      title: 'Error!',
                      text: 'Connection file not found',
                      icon: 'error',
                      confirmButtonText: 'OK'
                  });
                </script>";
          exit;
      }

      $username = $_POST['username'];
      $password = $_POST['password'];

      // Create table if not exists
      $createTableSQL = "CREATE TABLE IF NOT EXISTS users (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          username VARCHAR(30) NOT NULL,
          email VARCHAR(50) NOT NULL,
          password VARCHAR(255) NOT NULL,
          reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      )";
      $conn->exec($createTableSQL);

      $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
      $stmt->bindParam(':username', $username);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user && password_verify($password, $user['password'])) {
          echo "<script>
                  Swal.fire({
                      title: 'Login Successful',
                      text: 'You have successfully logged in!',
                      icon: 'success',
                      confirmButtonText: 'OK'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          window.location.href = 'main.php';
                      }
                  });
                </script>";
      } else {
          echo "<script>
                  Swal.fire({
                      title: 'Error!',
                      text: 'Invalid username or password',
                      icon: 'error',
                      confirmButtonText: 'OK'
                  });
                </script>";
      }
  }
  ?>

</body>
</html>
