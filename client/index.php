<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main POS Interface</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/franken-ui-releases@0.0.13/dist/default.min.css"/>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .fade-in {
            animation: fadeIn 2s ease-in-out;
        }
        .bg-custom {
            background-color: #f8f9fa; /* Light background for better contrast */
        }
        .text-custom {
            color: #343a40; /* Darker text for better readability */
        }
        .button-custom {
            transition: background-color 0.3s, transform 0.3s;
        }
        .button-custom:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: scale(1.05); /* Slightly enlarge button on hover */
        }
    </style>
</head>
<body class="bg-custom">
    <div class="flex min-h-screen flex-col fade-in">
        <header class="flex items-center justify-between px-6 py-4 border-b fade-in bg-custom">
          <div class="flex items-center">
            <iconify-icon icon="mdi:cart" class="text-2xl mr-2 text-blue-600"></iconify-icon>
            <span class="text-lg font-semibold text-custom">Your Cart</span>
          </div>
          <div class="flex items-center gap-4">
            <a href="login.php" class="inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow-sm button-custom">
              <iconify-icon icon="mdi:login" class="mr-2"></iconify-icon> Log In
            </a>
            <a href="register.php" class="inline-flex items-center justify-center rounded-md border border-input bg-background px-4 py-2 text-sm font-medium shadow-sm button-custom">
              <iconify-icon icon="mdi:account-plus" class="mr-2"></iconify-icon> Sign Up
            </a>
          </div>
        </header>
        <br>
        <main class="flex-1 px-6 py-12 md:px-10 lg:px-16 fade-in">
          <div class="mx-auto max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
              <h1 class="text-4xl font-bold tracking-tight text-primary fade-in">Streamline Your Business with Our POS System</h1>
              <p class="text-custom text-lg fade-in">
                Our powerful POS system helps you manage your sales, inventory, and customer data with ease. Boost your efficiency and grow your business.
              </p>
              <div class="flex gap-4">
                <a href="https://github.com" class="inline-flex items-center justify-center " target="_blank" rel="noopener noreferrer">
                  <iconify-icon icon="mdi:github" class="text-3xl"></iconify-icon>
                </a>
                <a href="https://www.facebook.com" class="inline-flex items-center justify-center " target="_blank" rel="noopener noreferrer">
                  <iconify-icon icon="mdi:facebook" class="text-3xl"></iconify-icon>
                </a>
                <a href="https://www.linkedin.com" class="inline-flex items-center justify-center " target="_blank" rel="noopener noreferrer">
                  <iconify-icon icon="mdi:linkedin" class="text-3xl"></iconify-icon>
                </a>
                <a href="https://oatport.vercel.app/" class="inline-flex items-center justify-center " target="_blank" rel="noopener noreferrer">
                  <iconify-icon icon="mdi:account" class="text-3xl"></iconify-icon>
                </a>
              </div>
            </div>
            <div>
              <img src="/images/1.jpg" width="800" height="600" alt="POS System Screenshot" class="rounded-lg shadow-lg fade-in" style="aspect-ratio: 800/600; object-fit: cover;">
            </div>
          </div>
        </main>
        <footer class="border-t py-6 px-6 text-sm text-muted-foreground fade-in">
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
    </div>
</body>
</html>