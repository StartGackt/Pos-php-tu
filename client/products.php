<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard POS Interface</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.comปรับสี/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/franken-ui-releases@0.0.13/dist/default.min.css" />
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
    <aside class="fixed inset-y-0 left-0 z-10 hidden w-14 flex flex-col border-r bg-background sm:flex">
      <nav class="flex flex-col items-center gap-4 px-2 sm:py-5">
        <a class="group flex h-9 w-9 shrink-0 items-center justify-center gap-2 rounded-full bg-primary text-lg font-semibold text-primary-foreground md:h-8 md:w-8 md:text-base"
          href="Maim.html" rel="ugc">
          <i class="fas fa-shopping-basket h-4 w-4 transition-all group-hover:scale-110"></i>
          <span class="sr-only">POS</span>
        </a>
        <a class="flex h-9 w-9 items-center justify-center rounded-lg bg-accent text-accent-foreground transition-colors hover:text-foreground md:h-8 md:w-8"
          data-state="closed" href="products.html" rel="ugc">
          <i class="fas fa-box-open h-5 w-5"></i>
          <span class="sr-only">Products</span>
        </a>
        <a class="flex h-9 w-9 items-center justify-center rounded-lg text-muted-foreground transition-colors hover:text-foreground md:h-8 md:w-8"
          href="#" rel="ugc">
          <i class="fas fa-chart-line h-5 w-5"></i>
          <span class="sr-only">Order Details</span>
        </a>
        <a class="flex h-9 w-9 items-center justify-center rounded-lg text-muted-foreground transition-colors hover:text-foreground md:h-8 md:w-8"
          data-state="closed" href="#" rel="ugc">
          <i class="fas fa-cog h-5 w-5"></i>
          <span class="sr-only">Settings</span>
        </a>
      </nav>
    </aside>
    <div class="flex flex-col sm:gap-4 sm:py-4 sm:pl-14">
      <header
        class="sticky top-0 z-30 flex h-14 items-center gap-4 border-b bg-background px-4 sm:static sm:h-auto sm:border-0 sm:bg-transparent sm:px-6">
        <button
          class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 w-10 sm:hidden"
          type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="radix-:rr:" data-state="closed">
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
                Products
              </span>
            </li>
          </ol>
        </nav>
        <div class="relative ml-auto flex-1 md:grow-0">
          <i class="fas fa-search absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground"></i>
          <input
            class="flex h-10 border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full rounded-lg bg-background pl-8 md:w-[200px] lg:w-[336px]"
            placeholder="Search products..." type="search" />
        </div>
        <button
          class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 w-10 overflow-hidden rounded-full"
          type="button" id="radix-:ru:" aria-haspopup="menu" aria-expanded="false" data-state="closed">

          <img src="/images/1.jpg" width="36" height="36" alt="Avatar" class="overflow-hidden rounded-full"
            style="aspect-ratio: 36 / 36; object-fit: cover;" />
        </button>
      </header>
      <div class="flex flex-wrap justify-center gap-4 mt-4">
        <!-- Content dynamically generated from backend -->
         
      </div>
      </main>
    </div>
  </div>
</body>

</html>