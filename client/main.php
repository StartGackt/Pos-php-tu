<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="flex h-screen overflow-hidden bg-gray-50">
  
  <aside class="hidden w-64 flex-shrink-0 bg-white shadow-lg lg:block">
    <div class="flex h-full flex-col">
      <div class="flex items-center justify-center p-6">
        <h1 class="text-2xl font-bold text-blue-600">Inventory Pro</h1>
      </div>
      <nav class="flex-1 space-y-2 px-3">
        <a href="main.php" class="w-full flex items-center px-3 py-2 bg-blue-50 text-blue-600 rounded-md" aria-current="page">
            <i class="fas fa-tachometer-alt fa-fw mr-3" aria-hidden="true"></i>
            Dashboard
          </a>
        <a href="orderproduct.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-box fa-fw mr-3"></i>
          Order products
        </a>
        <button class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-tags fa-fw mr-3"></i>
          Categories
        </button>
        <a href="productcate.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-utensils fa-fw mr-3"></i>
          ListMenu
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

  
  <div class="flex flex-1 flex-col overflow-hidden">
    
    <header class="flex h-16 items-center justify-between bg-white px-6 shadow-sm">
      <button class="lg:hidden">
        <i class="fas fa-bars h-6 w-6"></i>
      </button>
      <div class="flex items-center">
        <div class="relative">
          <i class="fas fa-search absolute left-2.5 top-2.5 h-4 w-4 text-gray-500"></i>
          <input
            class="w-72 pl-8 py-2 border border-gray-300 rounded-md"
            placeholder="Search inventory..."
            type="search"
          />
        </div>
      </div>
      <div class="relative">
        <button class="flex items-center">
          <span class="mr-2 text-sm font-medium">
            <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>
          </span>
          <img
            alt="Admin avatar"
            class="h-8 w-8 rounded-full"
            src="/placeholder.svg?height=32&width=32"
          />
        </button>
        <div class="absolute right-0 mt-2 w-56 bg-white shadow-lg rounded-lg">
          <!-- Dropdown content can be added here -->
        </div>
      </div>
    </header>

    
    <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
      <h2 class="mb-6 text-2xl font-semibold text-gray-800">Dashboard Overview</h2>

      
      <div class="mb-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-lg">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium">Total Products</h3>
            <i class="fas fa-box fa-fw text-white"></i>
          </div>
          <p class="text-3xl font-bold">150</p>
          <p class="mt-1 text-sm opacity-80">10% increase from last month</p>
        </div>
        <div class="bg-gradient-to-br from-red-500 to-red-600 text-white p-6 rounded-lg shadow-lg">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium">Out of Stock</h3>
            <i class="fas fa-exclamation-triangle fa-fw text-white"></i>
          </div>
          <p class="text-3xl font-bold">5</p>
          <p class="mt-1 text-sm opacity-80">2 less than last week</p>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-lg shadow-lg">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium">Total Sales</h3>
            <i class="fas fa-chart-line fa-fw text-white"></i>
          </div>
          <p class="text-3xl font-bold">\$12,500</p>
          <p class="mt-1 text-sm opacity-80">15% increase from last month</p>
        </div>
      </div>

      
      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="flex justify-between p-6">
          <h3 class="text-xl font-medium">Inventory Status</h3>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Wireless Earbuds</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Electronics</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  In Stock
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">\$99.99</td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Smart Watch</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Electronics</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                  Low Stock
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">\$199.99</td>
             
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Bluetooth Speaker</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Audio</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                  Out of Stock
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">\$79.99</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>