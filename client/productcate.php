<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventory Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <a href="allcate.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600 " >
          <i class="fas fa-tags fa-fw mr-3"></i>
          Categories
        </a>
        <a href="productcate.php" class="w-full flex items-center px-3 py-2 bg-blue-50 text-blue-600 rounded-md" aria-current="page">
          <i class="fas fa-utensils fa-fw mr-3" aria-hidden="true"></i>
          List Menu
        </a>
        <a href="cate.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-warehouse fa-fw mr-3"></i>
          Food stock
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
            placeholder="ค้นหาสินค้า..."
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
        <div class="absolute right-0 mt-2 w-56 bg-white shadow-lg rounded-lg hidden">
          <!-- Dropdown Menu -->
        </div>
      </div>
    </header>

    <!-- Main Section -->
    <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
      <h2 class="mb-6 text-2xl font-semibold text-gray-800">Dashboard Overview</h2>
      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="flex justify-between p-6">
          <h3 class="text-xl font-medium">Inventory Status</h3>
          <button class="px-4 py-2 bg-blue-600 text-white rounded-md" onclick="openModal()">Add New Product</button>
        </div>

        <!-- Modal for Adding New Product -->
        <div id="productModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
          <div class="bg-white rounded-lg p-6">
            <h3 class="text-xl font-medium mb-4">Add New Product</h3>
            <form method="POST" action="productcate.php">
              <div class="mb-4">
                <label for="productName" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" id="productName" name="productName" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
              </div>
              <div class="mb-4">
                <label for="ingredients" class="block text-sm font-medium text-gray-700">Ingredients</label>
                <select id="ingredients" name="ingredients[]" class="mt-1 block w-full border border-gray-300 rounded-md p-2" multiple required>
                  <?php
                  require_once '../php/connect.php';
                  // Fetch ingredients from the database
                  $stmtIngredients = $db->query('SELECT ingredientName FROM ingredient');
                  $ingredientsList = $stmtIngredients->fetchAll(PDO::FETCH_COLUMN);
                  foreach ($ingredientsList as $ingredient):
                  ?>
                  <option value="<?php echo htmlspecialchars($ingredient); ?>"><?php echo htmlspecialchars($ingredient); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" id="price" name="price" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
              </div>
              <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Submit</button>
                <button type="button" class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md" onclick="closeModal()">Cancel</button>
              </div>
            </form>
          </div>
        </div>

        <script>
          function openModal() {
            document.getElementById('productModal').classList.remove('hidden');
          }
          function closeModal() {
            document.getElementById('productModal').classList.add('hidden');
          }

          // ฟังก์ชันอัปเดตสต๊อก
          function updateStock() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../php/update_stock.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.onreadystatechange = function () {
              if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Stock updated successfully');
              }
            };
            xhr.send(JSON.stringify(cart));
          }
        </script>

        <?php
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['action'])) {
            $productName = $_POST['productName'];
            $ingredients = $_POST['ingredients']; // This is now an array
            $price = $_POST['price'];
            
            // Convert the ingredients array to a comma-separated string
            $ingredientsList = implode(", ", $ingredients);

            $stmt = $db->prepare('INSERT INTO product (productName, ingredients, price) VALUES (?, ?, ?)');
            if ($stmt->execute([$productName, $ingredientsList, $price])) {
                echo '<script>
                        Swal.fire({
                          icon: "success",
                          title: "บันทึกสำเร็จ",
                          showConfirmButton: false,
                          timer: 1500
                        }).then(() => {
                          window.location.href = "productcate.php";
                        });
                      </script>';
                // Call updateStock function after successful product addition
                echo '<script>updateStock();</script>';
            }
        }

        // Fetch all products
        $stmt = $db->query('SELECT * FROM product');
        $products = $stmt->fetchAll();
        ?>

        <!-- Table displaying product data -->
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ingredients</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($products as $product): ?>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($product['productName']); ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($product['ingredients']); ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($product['price']); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
