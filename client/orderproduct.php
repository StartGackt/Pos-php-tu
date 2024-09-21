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
        <a href="productcate.php" class="w-full flex items-center px-3 py-2 hover:bg-blue-50 hover:text-blue-600 rounded-md" aria-current="page">
          <i class="fas fa-tags fa-fw mr-3"></i>
          Categories
        </a>
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
          <span class="mr-2 text-sm font-medium">Admin User</span>
          <img
            alt="Admin avatar"
            class="h-8 w-8 rounded-full"
            src="/placeholder.svg?height=32&width=32"
          />
        </button>
        <div class="absolute right-0 mt-2 w-56 bg-white shadow-lg rounded-lg">
          
        </div>
      </div>
    </header>

    
    <main class="flex-1 overflow-y-auto bg-gradient-to-r from-gray-100 to-gray-200 p-6">
        <h2 class="mb-6 text-3xl font-bold text-gray-800">Order Products</h2>
        <div class="container mx-auto p-4">
          <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            
            
            <div class="lg:col-span-3 bg-white rounded-lg shadow-lg p-6">
              <h2 class="text-2xl font-semibold mb-6 text-gray-700">รายการสินค้า</h2>
              <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                
                
                <div class="bg-white rounded-lg shadow hover:shadow-xl transition-shadow duration-300 cursor-pointer p-4 flex flex-col items-center" data-id="1" data-name="กาแฟดำ" data-price="35">
                  <img src="https://via.placeholder.com/80" alt="กาแฟดำ" class="w-24 h-24 object-cover mb-4 rounded-full border-2 border-gray-200">
                  <h3 class="font-medium text-center text-gray-800">กาแฟดำ</h3>
                  <p class="text-sm text-gray-500">฿35</p>
                </div>
      
                
                <div class="bg-white rounded-lg shadow hover:shadow-xl transition-shadow duration-300 cursor-pointer p-4 flex flex-col items-center" data-id="2" data-name="ลาเต้" data-price="45">
                  <img src="https://via.placeholder.com/80" alt="ลาเต้" class="w-24 h-24 object-cover mb-4 rounded-full border-2 border-gray-200">
                  <h3 class="font-medium text-center text-gray-800">ลาเต้</h3>
                  <p class="text-sm text-gray-500">฿45</p>
                </div>
                
                
                

              </div>
            </div>
            
            
            <div class="bg-white rounded-lg shadow-lg p-6">
              <h2 class="text-2xl font-semibold mb-6 text-gray-700">สรุปรายการ</h2>
              <div class="h-[300px] overflow-y-auto pr-2 mb-4 border-b border-gray-200">
                <div id="cart-items">
                  
                </div>
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
      
        <script>
          const products = [
            { id: 1, name: 'กาแฟดำ', price: 35 },
            { id: 2, name: 'ลาเต้', price: 45 },
            { id: 3, name: 'คาปูชิโน', price: 50 },
            { id: 4, name: 'ชาเขียว', price: 40 },
            { id: 5, name: 'ชานม', price: 45 },
            { id: 6, name: 'น้ำส้ม', price: 30 },
            { id: 7, name: 'เค้กช็อคโกแลต', price: 60 },
            { id: 8, name: 'แซนด์วิชทูน่า', price: 50 },
          ]
      
          const cart = {}
          let cash = 0
      
          const cartItemsContainer = document.getElementById('cart-items')
          const totalItemsSpan = document.getElementById('total-items')
          const totalPriceSpan = document.getElementById('total-price')
          const cashInput = document.getElementById('cash-input')
          const checkoutButton = document.getElementById('checkout-button')
      
          // ฟังก์ชันเพิ่มสินค้าในตะกร้า
          function addToCart(productId) {
            if (cart[productId]) {
              cart[productId] += 1
            } else {
              cart[productId] = 1
            }
            renderCart()
          }
      
          // ฟังก์ชันลดสินค้าในตะกร้า
          function removeFromCart(productId) {
            if (cart[productId] > 1) {
              cart[productId] -= 1
            } else {
              delete cart[productId]
            }
            renderCart()
          }
      
          // ฟังก์ชันอัพเดตตะกร้า
          function renderCart() {
            cartItemsContainer.innerHTML = ''
            let totalItems = 0
            let totalPrice = 0
            for (const [productId, quantity] of Object.entries(cart)) {
              const product = products.find(p => p.id === Number(productId))
              if (product) {
                totalItems += quantity
                totalPrice += product.price * quantity
                const itemDiv = document.createElement('div')
                itemDiv.className = 'flex justify-between items-center mb-3'
                itemDiv.innerHTML = `
                  <span class="text-gray-800">${product.name}</span>
                  <div class="flex items-center">
                    <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-1 rounded" onclick="removeFromCart(${product.id})">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                      </svg>
                    </button>
                    <span class="mx-2 text-gray-700">${quantity}</span>
                    <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-1 rounded" onclick="addToCart(${product.id})">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                      </svg>
                    </button>
                  </div>
                `
                cartItemsContainer.appendChild(itemDiv)
              }
            }
            totalItemsSpan.textContent = `${totalItems} ชิ้น`
            totalPriceSpan.textContent = `฿${totalPrice.toFixed(2)}`
            
            // อัพเดตปุ่มชำระเงิน
            if (totalItems === 0) {
              checkoutButton.disabled = true
            } else {
              const cashValue = Number(cashInput.value)
              checkoutButton.disabled = cashValue < totalPrice && cashValue < totalPrice  // Adjusted condition
            }
          }
      
          // ฟังก์ชันจัดการการป้อนจำนวนเงิน
          cashInput.addEventListener('input', (e) => {
            cash = Number(e.target.value)
            const totalPrice = products.reduce((sum, product) => sum + (cart[product.id] || 0) * product.price, 0)
            if (cash >= totalPrice && Object.keys(cart).length > 0) {
              checkoutButton.disabled = false
            } else {
              checkoutButton.disabled = true
            }
          })
      
          // ฟังก์ชันตรวจสอบการชำระเงิน
          function processCashPayment(totalPrice) {
            Swal.fire({
              title: 'ยืนยันการชำระเงิน',
              html: `ยอดรวม: <strong>฿${totalPrice.toFixed(2)}</strong>`,
              icon: 'info',
              showCancelButton: true,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก'
            }).then((result) => {
              if (result.isConfirmed) {
                const change = cash - totalPrice
                Swal.fire({
                  title: 'ชำระเงินสำเร็จ',
                  text: `เงินทอน: ฿${change.toFixed(2)}`,
                  icon: 'success',
                  confirmButtonText: 'ตกลง'
                })
                // รีเซ็ตตะกร้าและจำนวนเงิน
                for (const key in cart) {
                  delete cart[key]
                }
                cashInput.value = ''
                cash = 0
                renderCart()
              }
            })
          }
      
          function processPrompayPayment(totalPrice) {
            // สร้างวันที่ปัจจุบัน
            const currentDate = new Date().toLocaleString('th-TH', { timeZone: 'Asia/Bangkok' })
      
            // สร้าง QR Code URL (จำลองสำหรับตัวอย่าง)
            const qrCodeUrl = `https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=PROMPAY_PAYMENT_URL?amount=${totalPrice}`
      
            // แสดงรายละเอียดการชำระเงินพร้อม QR Code
            Swal.fire({
              title: 'ชำระผ่านพร้อมเพย์',
              html: `
                <p>วันที่: ${currentDate}</p>
                <p>ยอดต้องชำระ: <strong>฿${totalPrice.toFixed(2)}</strong></p>
                <img src="${qrCodeUrl}" alt="QR Code" class="mx-auto my-4">
                <p>กรุณาชำระเงินภายใน 3 นาที</p>
              `,
              showConfirmButton: false,
              allowOutsideClick: false,
              didOpen: () => {
                // เริ่มนับเวลา 3 นาที
                const timer = setTimeout(() => {
                  Swal.close()
                  Swal.fire({
                    title: 'หมดเวลา',
                    text: 'ไม่พบการชำระเงินภายในเวลาที่กำหนด',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                  })
                  // รีเซ็ตตะกร้าและจำนวนเงิน
                  for (const key in cart) {
                    delete cart[key]
                  }
                  cashInput.value = ''
                  cash = 0
                  renderCart()
                }, 180000) // 180000 มิลลิวินาที = 3 นาที
      
                // จำลองการตรวจสอบการชำระเงินทุกๆ 10 วินาที
                const checkInterval = setInterval(() => {
                  // ในที่นี้เราจำลองว่าไม่ได้ชำระเงิน จึงไม่ทำอะไร
                  // ในการใช้งานจริง คุณต้องตรวจสอบสถานะการชำระเงินจากระบบของคุณ
                }, 10000)
      
                // เมื่อ popup ถูกปิด, ล้าง interval
                Swal.getPopup().addEventListener('close', () => {
                  clearTimeout(timer)
                  clearInterval(checkInterval)
                })
              }
            }).then((result) => {
              // จำลองการชำระเงินสำเร็จ
              // คุณสามารถแทนที่ส่วนนี้ด้วยการตรวจสอบสถานะการชำระเงินจริง
              if (result.isDismissed) {
                // ไม่มีอะไรทำ
              }
            })
          }
      
          checkoutButton.addEventListener('click', () => {
            const totalPrice = products.reduce((sum, product) => sum + (cart[product.id] || 0) * product.price, 0)
            Swal.fire({
              title: 'เลือกวิธีการชำระเงิน',
              showCancelButton: true,
              showDenyButton: true,
              confirmButtonText: 'เงินสด',
              denyButtonText: 'พร้อมเพย์',
              cancelButtonText: 'ยกเลิก',
              icon: 'question'
            }).then((result) => {
              if (result.isConfirmed) {
                // เลือกชำระด้วยเงินสด
                processCashPayment(totalPrice)
              } else if (result.isDenied) {
                // เลือกชำระด้วยพร้อมเพย์
                processPrompayPayment(totalPrice)
              }
            })
          })
      
          // การจัดการคลิกสินค้าจากรายการสินค้า
          document.querySelectorAll('[data-id]').forEach(productEl => {
            productEl.addEventListener('click', () => {
              const productId = Number(productEl.getAttribute('data-id'))
              addToCart(productId)
            })
          })
        </script>
      </main>
  </div>
</body>
</html>