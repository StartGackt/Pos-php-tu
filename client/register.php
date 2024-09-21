<?php
require_once '../php/connect.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

    if (empty($username)) {
        $errors['username'] = 'Username is required';
    }

    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required';
    }

    if ($password !== $confirmPassword) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        if ($stmt->execute([$username, $email, $hashedPassword])) {
            header('Location: login.php');
            exit;
        } else {
            $errors['general'] = 'Registration failed. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/franken-ui-releases@0.0.13/dist/default.min.css"/>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="script.js"></script>
</head>
<body>

  <div class="flex min-h-[80dvh] flex-col items-center justify-center">
   <br>
   <br>
   <br>
   
    <div class="mx-auto w-full max-w-md space-y-6">
      <div class="text-center">
        <h1 class="text-3xl font-bold tracking-tight text-foreground">Welcome to Registration</h1>
        <p class="mt-2 text-muted-foreground">Create your account to continue</p>
      </div>

      <form class="space-y-6" action="register.php" method="POST">
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm hover:border-blue-500" required>
            <small class="text-red-500" id="username-error"><?php echo $errors['username'] ?? ''; ?></small>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm hover:border-blue-500" required>
            <small class="text-red-500" id="email-error"><?php echo $errors['email'] ?? ''; ?></small>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm hover:border-blue-500" required>
            <small class="text-red-500" id="password-error"><?php echo $errors['password'] ?? ''; ?></small>
            <div id="password-strength" class="mt-1 text-sm"></div>
        </div>
        <div class="mb-4">
            <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="confirm-password" id="confirm-password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm hover:border-blue-500" required>
            <small class="text-red-500" id="confirm-password-error"><?php echo $errors['confirm_password'] ?? ''; ?></small>
        </div>
        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Register</button>
        <p class="text-center mt-4">Already have an account? <a href="login.php" class="text-blue-600 hover:text-blue-800">Click here</a> to login.</p>
    </form>

    </div>

  </div>
  

</body>
</html>
