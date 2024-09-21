<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventory Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/lucide@0.244.0/dist/lucide.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="flex h-screen overflow-hidden bg-gray-50">
  
  <!-- Sidebar -->
  <aside class="hidden w-64 flex-shrink-0 bg-white shadow-lg lg:block">
    <div class="flex h-full flex-col">
      <div class="flex items-center justify-center p-6">
        <h1 class="text-2xl font-bold text-blue-600">Inventory Pro</h1>
      </div>
      <nav class="flex-1 space-y-2 px-3">
        <a href="main.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-tachometer-alt fa-fw mr-3"></i>
          Dashboard
        </a>
        <a href="orderproduct.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-box fa-fw mr-3"></i>
          Order Products
        </a>     
        <a class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-tags fa-fw mr-3"></i>
          Categories
        </a>
        <a href="productcate.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-utensils fa-fw mr-3"></i>
          List Menu
        </a>
        <a href="cate.php" class="w-full flex items-center px-3 py-2 bg-blue-50 text-blue-600 rounded-md" aria-current="page" aria-label="Current page: Food Stock">
          <i class="fas fa-warehouse fa-fw mr-3" aria-hidden="true"></i>
          Food Stock
        </a>
        <button class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-shopping-cart fa-fw mr-3"></i>
          Orders
        </button>
      </nav>
    </div>
  </aside>

  <!-- Main Content -->
  <div class="flex flex-1 flex-col overflow-hidden">
    
    <!-- Header -->
    <header class="flex h-16 items-center justify-between bg-white px-6 shadow-sm">
      <button class="lg:hidden">
        <i class="fas fa-bars h-6 w-6"></i>
      </button>
      <div class="flex items-center">
        <div class="relative">
          <i class="fas fa-search absolute left-2.5 top-2.5 h-4 w-4 text-gray-500"></i>
          <input
            class="w-72 pl-8 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
            placeholder="Search products..."
            type="search"
          />
        </div>
      </div>
      <div class="relative">
        <button class="flex items-center">
          <span class="mr-2 text-sm font-medium">Admin User</span>
          <img
            alt="Admin avatar"
            class="h-8 w-8 rounded-full"
            src="https://via.placeholder.com/32"
          />
        </button>
      </div>
    </header>
    
    <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
      <h2 class="mb-6 text-2xl font-semibold text-gray-800">Dashboard Overview</h2>

      <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Food Stock Management System</h1>
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ingredient Name</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Used Today</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remaining Stock Today</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php
            require_once '../php/connect.php';
            $stmt = $db->query('SELECT * FROM ingredient');
            $ingredients = $stmt->fetchAll();
            foreach ($ingredients as $ingredient):
            ?>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($ingredient['ingredientName']); ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($ingredient['stock']); ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($ingredient['usedToday']); ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($ingredient['remainingStockToday']); ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              <button class="text-green-600 hover:text-green-900" onclick="updateStock('<?php echo htmlspecialchars($ingredient['ingredientName']); ?>', 1)">+</button>
              <button class="text-red-600 hover:text-red-900 ml-4" onclick="updateStock('<?php echo htmlspecialchars($ingredient['ingredientName']); ?>', -1)">-</button>
              </td>
            </tr>

            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
  
  <script>
    function updateStock(ingredientName, change) {
      fetch('../php/update_stock.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ ingredientName: ingredientName, change: change })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          Swal.fire({
            icon: 'success',
            title: 'Updated!',
            text: 'Stock has been updated successfully.',
          });
          location.reload(); // Reload the page to see the updated data
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: data.message,
          });
        }
      })
      .catch(error => console.error('Error:', error));
    }
  </script>
</body>
</html>
