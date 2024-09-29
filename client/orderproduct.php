<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/lucide@0.244.0/dist/lucide.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="flex h-screen overflow-hidden bg-gray-50">
  
  <aside class="hidden w-64 flex-shrink-0 bg-white shadow-lg lg:block">
    <div class="flex h-full flex-col">
      <div class="flex items-center justify-center p-6">
        <h1 class="text-2xl font-bold text-blue-600">Inventory Pro</h1>
      </div>
      <nav class="flex-1 space-y-2 px-3">
        <a href="main.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
            <i class="fas fa-tachometer-alt fa-fw mr-3" ></i>
            Dashboard
          </a>
        <a href="orderproduct.php" class="w-full flex items-center px-3 py-2 bg-blue-50 text-blue-600 ">
          <i class="fas fa-box fa-fw mr-3" aria-hidden="true"></i>
          Order products
        </a>
        <a href="productcate.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-utensils fa-fw mr-3"></i>
          ListMenu
        </a>
        <a href="cate.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600">
          <i class="fas fa-warehouse fa-fw mr-3"></i>
          Food stock
        </a>
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
          <span class="mr-2 text-sm font-medium">Admin User</span>
          <img
            alt="Admin avatar"
            class="h-8 w-8 rounded-full"
            src="/placeholder.svg?height=32&width=32"
          />
        </button>
        <div class="absolute right-0 mt-2 w-56 bg-white shadow-lg rounded-lg"></div>
      </div>
    </header>

    <main class="flex-1 overflow-y-auto bg-gradient-to-r from-gray-100 to-gray-200 p-6">
        <h2 class="mb-6 text-3xl font-bold text-gray-800">Order Products</h2>
        <div class="container mx-auto p-4">
          <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <div class="lg:col-span-3 bg-white rounded-lg shadow-lg p-6">
              <h2 class="text-2xl font-semibold mb-6 text-gray-700">รายการสินค้า</h2>
              <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
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

                // Fetch products from the menu table
                try {
                    $stmt = $conn->query("SELECT menu_name, price FROM menu");
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "<script>
                            Swal.fire({
                                title: 'Error!',
                                text: 'Error fetching products: " . $e->getMessage() . "',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                          </script>";
                    exit;
                }

                // Display products
                foreach ($products as $product) {
                    echo '<div class="bg-white rounded-lg shadow hover:shadow-xl transition-shadow duration-300 cursor-pointer p-4 flex flex-col items-center" onclick="addToCart(\'' . htmlspecialchars($product['menu_name']) . '\', ' . htmlspecialchars($product['price']) . ')">';
                    echo '<img src="https://via.placeholder.com/80" alt="' . htmlspecialchars($product['menu_name']) . '" class="w-24 h-24 object-cover mb-4 rounded-full border-2 border-gray-200">';
                    echo '<h3 class="font-medium text-center text-gray-800">' . htmlspecialchars($product['menu_name']) . '</h3>';
                    echo '<p class="text-sm text-gray-500">฿' . htmlspecialchars($product['price']) . '</p>';
                    echo '</div>';
                }
                ?>
              </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
              <h2 class="text-2xl font-semibold mb-6 text-gray-700">สรุปรายการ</h2>
              <div class="h-[300px] overflow-y-auto pr-2 mb-4 border-b border-gray-200">
                <div id="cart-items"></div>
              </div>
              <div class="flex justify-between mb-4">
                <span class="text-gray-700">จำนวนสินค้า:</span>
                <span id="total-items" class="font-semibold text-gray-900">0 ชิ้น</span>
              </div>
              <div class="flex justify-between mb-6">
                <span class="text-gray-700">ยอดรวม:</span>
                <span id="total-price" class="font-semibold text-gray-900">฿0.00</span>
              </div>
              <input
                type="number"
                id="cash-input"
                placeholder="จำนวนเงินที่รับ (฿)"
                class="w-full p-3 border border-gray-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
              <div class="mb-4">
                <label class="block text-gray-700 mb-2">เลือกวิธีการชำระเงิน:</label>
                <select id="payment-method" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="cash">เงินสด</option>
                  <option value="transfer">โอน</option>
                </select>
              </div>
              <button
                id="checkout-button"
                class="w-full bg-blue-600 text-white p-3 rounded-lg flex justify-center items-center space-x-2 transition-transform transform hover:scale-105 disabled:bg-blue-300 disabled:cursor-not-allowed"
                disabled
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m4-9v9m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3" />
                </svg>
                <span>ชำระเงิน</span>
              </button>
            </div>
            </div>
          </div>
        </div>
    </main>
  </div>

  <script>
    let cartItems = [];
    let totalItems = 0;
    let totalPrice = 0;

    function addToCart(name, price) {
        cartItems.push({ name, price });
        totalItems++;
        totalPrice += price;
        updateCart();
    }

    function updateCart() {
        const cartItemsContainer = document.getElementById('cart-items');
        cartItemsContainer.innerHTML = '';
        cartItems.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'flex justify-between mb-2';
            itemElement.innerHTML = `<span>${item.name}</span><span>฿${item.price.toFixed(2)}</span>`;
            cartItemsContainer.appendChild(itemElement);
        });
        document.getElementById('total-items').innerText = `${totalItems} ชิ้น`;
        document.getElementById('total-price').innerText = `฿${totalPrice.toFixed(2)}`;
        document.getElementById('checkout-button').disabled = totalItems === 0;
    }

    document.getElementById('checkout-button').addEventListener('click', function() {
        const cashInput = document.getElementById('cash-input').value;
        const paymentMethod = document.getElementById('payment-method').value;

        if (paymentMethod === 'cash' && (cashInput === '' || parseFloat(cashInput) < totalPrice)) {
            Swal.fire({
                title: 'Error!',
                text: 'Insufficient cash amount',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }

        fetch('update_stock.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cartItems, paymentMethod, cashInput })
        })
        .then(response => response.text())
        .then(text => {
            try {
                const data = JSON.parse(text);
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Payment successful and stock updated',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'An error occurred while updating the stock',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            } catch (error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while processing the payment: ' + error.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while processing the payment: ' + error.message,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
  </script>
</body>
</html>