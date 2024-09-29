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

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $ingredient_id = $_POST['ingredient_id'] ?? null;
        $name = $_POST['name'] ?? null;
        $stock = $_POST['stock'] ?? null;
        $used_today = $_POST['used_today'] ?? null;
        $remaining_stock = $_POST['remaining_stock'] ?? null;

        try {
            if ($action == 'create') {
                $stmt = $conn->prepare("INSERT INTO ingredients (name, stock, used_today, remaining_stock) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $stock, $used_today, $remaining_stock]);
                echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Ingredient added successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                      </script>";
            } elseif ($action == 'update' && $ingredient_id) {
                $stmt = $conn->prepare("UPDATE ingredients SET name = ?, stock = ?, used_today = ?, remaining_stock = ? WHERE id = ?");
                $stmt->execute([$name, $stock, $used_today, $remaining_stock, $ingredient_id]);
                echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Ingredient updated successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                      </script>";
            } elseif ($action == 'delete' && $ingredient_id) {
                $stmt = $conn->prepare("DELETE FROM ingredients WHERE id = ?");
                $stmt->execute([$ingredient_id]);
                echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Ingredient deleted successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                      </script>";
            }
        } catch (PDOException $e) {
            echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Database error: " . $e->getMessage() . "',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                  </script>";
        }
    }
}

// Fetch ingredients data
try {
    $stmt = $conn->prepare("SELECT * FROM ingredients");
    $stmt->execute();
    $ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Database error: " . $e->getMessage() . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
          </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
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
        <a href="productcate.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-utensils fa-fw mr-3"></i>
          List Menu
        </a>
        <a href="cate.php" class="w-full flex items-center px-3 py-2 bg-blue-50 text-blue-600 rounded-md" aria-current="page" aria-label="Current page: Food Stock">
          <i class="fas fa-warehouse fa-fw mr-3" aria-hidden="true"></i>
          Food Stock
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

        <!-- Create Ingredient Form -->
        <form method="POST" class="mb-6">
          <input type="hidden" name="action" value="create">
          <div class="mb-4">
            <label class="block text-gray-700">Ingredient Name</label>
            <input type="text" name="name" class="w-full px-3 py-2 border rounded-md" required>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Stock</label>
            <input type="number" name="stock" class="w-full px-3 py-2 border rounded-md" required>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Used Today</label>
            <input type="number" name="used_today" class="w-full px-3 py-2 border rounded-md" required>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Remaining Stock Today</label>
            <input type="number" name="remaining_stock" class="w-full px-3 py-2 border rounded-md" required>
          </div>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Add Ingredient</button>
        </form>

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
            <?php foreach ($ingredients as $ingredient): ?>
              <tr>
                <td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'><?= $ingredient['name'] ?></td>
                <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'><?= $ingredient['stock'] ?></td>
                <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'><?= $ingredient['used_today'] ?></td>
                <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'><?= $ingredient['remaining_stock'] ?></td>
                <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>
                  <form method='POST' class='inline'>
                    <input type='hidden' name='ingredient_id' value='<?= $ingredient['id'] ?>'>
                    <input type='hidden' name='action' value='delete'>
                    <button type='submit' class='text-red-600 hover:text-red-900'>Delete</button>
                  </form>
                  <button onclick="editIngredient(<?= $ingredient['id'] ?>, '<?= $ingredient['name'] ?>', <?= $ingredient['stock'] ?>, <?= $ingredient['used_today'] ?>, <?= $ingredient['remaining_stock'] ?>)" class='text-blue-600 hover:text-blue-900 ml-4'>Edit</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <!-- Edit Ingredient Modal -->
  <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-md">
      <h2 class="text-xl font-semibold mb-4">Edit Ingredient</h2>
      <form method="POST">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="ingredient_id" id="editIngredientId">
        <div class="mb-4">
          <label class="block text-gray-700">Ingredient Name</label>
          <input type="text" name="name" id="editName" class="w-full px-3 py-2 border rounded-md" required>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Stock</label>
          <input type="number" name="stock" id="editStock" class="w-full px-3 py-2 border rounded-md" required>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Used Today</label>
          <input type="number" name="used_today" id="editUsedToday" class="w-full px-3 py-2 border rounded-md" required>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Remaining Stock Today</label>
          <input type="number" name="remaining_stock" id="editRemainingStock" class="w-full px-3 py-2 border rounded-md" required>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update Ingredient</button>
        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-600 text-white rounded-md ml-2">Cancel</button>
      </form>
    </div>
  </div>

  <script>
    function editIngredient(id, name, stock, used_today, remaining_stock) {
      document.getElementById('editIngredientId').value = id;
      document.getElementById('editName').value = name;
      document.getElementById('editStock').value = stock;
      document.getElementById('editUsedToday').value = used_today;
      document.getElementById('editRemainingStock').value = remaining_stock;
      document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
      document.getElementById('editModal').classList.add('hidden');
    }
  </script>
</body>
</html>
