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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    </style>
</head>
<body>
    <div class="flex min-h-screen w-full flex-col bg-muted/40">
        <aside class="fixed inset-y-0 left-0 z-10 hidden w-14 flex-col border-r bg-background sm:flex">
          <nav class="flex flex-col items-center gap-4 px-2 sm:py-5">
            <a
              class="group flex h-9 w-9 shrink-0 items-center justify-center gap-2 rounded-full bg-primary text-lg font-semibold  md:h-8 md:w-8 md:text-base"
              href="#"
              rel="ugc"
            >
              <i class="fas fa-shopping-basket h-4 w-4 transition-all group-hover:scale-110"></i>
              <span class="sr-only"> POS</span>
            </a>
            <a
              class="flex h-9 w-9 items-center justify-center rounded-lg bg-accent  transition-colors  md:h-8 md:w-8"
              data-state="closed"
              href="allproduct.html"
              rel="ugc"
            >
              <i class="fas fa-box-open h-5 w-5"></i>
              <span class="sr-only">จัดการสินค้า</span>
            </a>
           
            <a class="flex h-9 w-9 items-center justify-center rounded-lg text-muted-foreground transition-colors hover:text-foreground md:h-8 md:w-8"
              href="addproducts.html"
              rel="ugc"
            >
              <i class="fas fa-plus-circle h-5 w-5"></i>
              <span class="sr-only">หมวดหมู่สินค้า</span>
            </a>
            <a
              class="flex h-9 w-9 items-center justify-center rounded-lg text-muted-foreground transition-colors hover:text-foreground md:h-8 md:w-8"
              data-state="closed"
              href="#"
              rel="ugc"
            >
              <i class="fas fa-cog h-5 w-5"></i>
              <span class="sr-only">ตัดสต็อก</span>
            </a>
          </nav>
        </aside>
        <div class="flex flex-col sm:gap-4 sm:py-4 sm:pl-14">
          <header class="sticky top-0 z-30 flex h-14 items-center gap-4 border-b bg-background px-4 sm:static sm:h-auto sm:border-0 sm:bg-transparent sm:px-6">
            <button
              class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 w-10 sm:hidden"
              type="button"
              aria-haspopup="dialog"
              aria-expanded="false"
              aria-controls="radix-:rr:"
              data-state="closed"
            >
              <i class="fas fa-bars h-5 w-5"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <nav aria-label="breadcrumb" class="hidden md:flex">
              <ol class="flex flex-wrap items-center gap-1.5 break-words text-sm text-muted-foreground sm:gap-2.5">
                <li class="inline-flex items-center gap-1.5">
                  <a class="transition-colors hover:text-foreground" href="#" rel="ugc">
                    Dashboard
                  </a>
                </li>
                <li aria-hidden="true" class="[&amp;>svg]:size-3.5" role="presentation">
                  <i class="fas fa-chevron-right"></i>
                </li>
                <li class="inline-flex items-center gap-1.5">
                  <span aria-current="page" aria-disabled="true" class="font-normal text-foreground" role="link">
                    จัดการสินค้า
                  </span>
                </li>
              </ol>
            </nav>
            <div class="relative ml-auto flex-1 md:grow-0">
              <i class="fas fa-search absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground"></i>
              <input
                class="flex h-10 border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full rounded-lg bg-background pl-8 md:w-[200px] lg:w-[336px]"
                placeholder="ค้นหาสินค้า..."
                type="search"
              />
            </div>
            <button
              class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 w-10 overflow-hidden rounded-full"
              type="button"
              id="radix-:ru:"
              aria-haspopup="menu"
              aria-expanded="false"
              data-state="closed"
            >

              <img
                src="/images/1.jpg"
                width="36"
                height="36"
                alt="Avatar"
                class="overflow-hidden rounded-full"
                style="aspect-ratio: 36 / 36; object-fit: cover;"
              />
            </button>
          </header>
          <main class="flex-1 p-6">
            <div class="flex flex-col space-y-1.5">
              <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">รายการสินค้า</h3>
              <p class="text-sm text-muted-foreground">จัดการสินค้าของคุณ</p>
            </div>
            <div class="p-6">
              <div class="relative w-full overflow-auto">
                <table class="w-full caption-bottom text-sm border border-gray-300 rounded-lg shadow-md">
                  <thead class="bg-gray-100">
                    <tr class="border-b transition-colors hover:bg-gray-200">
                      <th class="h-12 px-4 text-left align-middle font-medium text-gray-700">
                        <span class="font-bold">ภาพ</span>
                      </th>
                      <th class="h-12 px-4 text-left align-middle font-medium text-gray-700">
                        <span class="font-bold">ชื่อสินค้า</span>
                      </th>
                      <th class="h-12 px-4 text-left align-middle font-medium text-gray-700">
                        <span class="font-bold">ราคา</span>
                      </th>
                      <th class="h-12 px-4 text-left align-middle font-medium text-gray-700">
                        <span class="font-bold">จำนวนสต็อก</span>
                      </th>
                      <th class="h-12 px-4 text-left align-middle font-medium text-gray-700">
                        <span class="font-bold">หมวดหมู่</span>
                      </th>
                      <th class="h-12 px-4 text-left align-middle font-medium text-gray-700">
                        <span class="font-bold">การดำเนินการ</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="[&amp;_tr:last-child]:border-0">
                    <?php
                    // Include the database connection
                    require_once __DIR__ . '/../connect.php';

                    // Fetch products from the database
                    $stmt = $db->prepare("SELECT * FROM products");
                    $stmt->execute();
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Display each product
                    foreach ($products as $product) {
                        echo '<tr class="border-b transition-colors hover:bg-muted/50">';
                        echo '<td class="h-12 px-4"><img src="' . (isset($product['image_path']) ? htmlspecialchars($product['image_path']) : 'default.jpg') . '" alt="' . (isset($product['product_name']) ? htmlspecialchars($product['product_name']) : 'ไม่มีชื่อ') . '" class="h-10 w-10 object-cover"></td>';
                        echo '<td class="h-12 px-4">' . (isset($product['product_name']) ? htmlspecialchars($product['product_name']) : 'ไม่มีชื่อ') . '</td>';
                        echo '<td class="h-12 px-4">' . (isset($product['price']) ? htmlspecialchars($product['price']) : 'N/A') . '</td>';
                        echo '<td class="h-12 px-4">' . (isset($product['stock_quantity']) ? htmlspecialchars($product['stock_quantity']) : 'N/A') . '</td>';
                        echo '<td class="h-12 px-4">' . (isset($product['category']) ? htmlspecialchars($product['category']) : 'ไม่ทราบ') . '</td>';
                        echo '<td class="h-12 px-4"><a href="editproduct.php?id=' . (isset($product['id']) ? $product['id'] : '') . '" class="text-blue-600 hover:underline">แก้ไข</a> | <a href="deleteproduct.php?id=' . (isset($product['id']) ? $product['id'] : '') . '" class="text-red-600 hover:underline">ลบ</a></td>';
                        echo '</tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </main>
      </div>
</body>
</html>