<?php
// Connect to the database
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

// Fetch ingredients from the database
$ingredients = [];
try {
    $stmt = $conn->query("SELECT id, name FROM ingredients");
    $ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error fetching ingredients: " . $e->getMessage() . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
          </script>";
    exit;
}

// Handle form submission to add a new product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menu_name = $_POST['menu_name'] ?? '';
    $ingredient1 = $_POST['ingredient1'] ?? '';
    $ingredient2 = $_POST['ingredient2'] ?? null;
    $ingredient3 = $_POST['ingredient3'] ?? null;
    $ingredient4 = $_POST['ingredient4'] ?? null;
    $price = $_POST['price'] ?? '';

    try {
        // Create table if not exists
        $conn->exec("CREATE TABLE IF NOT EXISTS menu (
            id INT AUTO_INCREMENT PRIMARY KEY,
            menu_name VARCHAR(255) NOT NULL,
            ingredient1 INT NOT NULL,
            ingredient2 INT,
            ingredient3 INT,
            ingredient4 INT,
            price DECIMAL(10, 2) NOT NULL,
            FOREIGN KEY (ingredient1) REFERENCES ingredients(id),
            FOREIGN KEY (ingredient2) REFERENCES ingredients(id),
            FOREIGN KEY (ingredient3) REFERENCES ingredients(id),
            FOREIGN KEY (ingredient4) REFERENCES ingredients(id)
        )");

        // Insert new product into menu table
        $stmt = $conn->prepare("INSERT INTO menu (menu_name, ingredient1, ingredient2, ingredient3, ingredient4, price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$menu_name, $ingredient1, $ingredient2, $ingredient3, $ingredient4, $price]);
        echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Product added successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
              </script>";
    } catch (PDOException $e) {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error adding product: " . $e->getMessage() . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
    }
}
?>

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
        <a href="productcate.php" class="w-full flex items-center px-3 py-2 bg-blue-50 text-blue-600 rounded-md" aria-current="page">
          <i class="fas fa-utensils fa-fw mr-3" aria-hidden="true"></i>
          List Menu
        </a>
        <a href="cate.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-warehouse fa-fw mr-3"></i>
          Food stock
        </a>
      
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
          <h3 class="text-xl font-medium text-center">Menu Status</h3>
        </div>
            <!-- Create Menu Form -->
        <form method="POST" class="mb-6 bg-white p-6 rounded-lg shadow-md">
          <input type="hidden" name="action" value="create">
          <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Menu Name</label>
            <input type="text" name="menu_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Ingredients 1</label>
            <select name="ingredient1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
              <?php foreach ($ingredients as $ingredient): ?>
                <option value="<?= $ingredient['id'] ?>"><?= $ingredient['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Ingredients 2</label>
            <select name="ingredient2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              <option value="">None</option>
              <?php foreach ($ingredients as $ingredient): ?>
                <option value="<?= $ingredient['id'] ?>"><?= $ingredient['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Ingredients 3</label>
            <select name="ingredient3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              <option value="">None</option>
              <?php foreach ($ingredients as $ingredient): ?>
                <option value="<?= $ingredient['id'] ?>"><?= $ingredient['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Ingredients 4</label>
            <select name="ingredient4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              <option value="">None</option>
              <?php foreach ($ingredients as $ingredient): ?>
                <option value="<?= $ingredient['id'] ?>"><?= $ingredient['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Price</label>
            <input type="number" name="price" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          </div>
          <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Add Menu</button>
        </form>
        <!-- Table displaying product data -->
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu Name</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ingredients 1</th> 
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ingredients 2</th> 
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ingredients 3</th> 
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ingredients 4</th> 
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php
              try {
                  $stmt = $conn->query("SELECT menu.menu_name as menu_name, i1.name as ingredient1, i2.name as ingredient2, i3.name as ingredient3, i4.name as ingredient4, menu.price 
                                        FROM menu 
                                        LEFT JOIN ingredients i1 ON menu.ingredient1 = i1.id 
                                        LEFT JOIN ingredients i2 ON menu.ingredient2 = i2.id 
                                        LEFT JOIN ingredients i3 ON menu.ingredient3 = i3.id 
                                        LEFT JOIN ingredients i4 ON menu.ingredient4 = i4.id");
                  $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($menus as $menu) {
                      echo "<tr>";
                      echo "<td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'>{$menu['menu_name']}</td>";
                      echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$menu['ingredient1']}</td>";
                      echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$menu['ingredient2']}</td>";
                      echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$menu['ingredient3']}</td>";
                      echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$menu['ingredient4']}</td>";
                      echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$menu['price']}</td>";
                      echo "</tr>";
                  }
              } catch (PDOException $e) {
                  echo "<script>
                          Swal.fire({
                              title: 'Error!',
                              text: 'Error fetching menu: " . $e->getMessage() . "',
                              icon: 'error',
                              confirmButtonText: 'OK'
                          });
                        </script>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
