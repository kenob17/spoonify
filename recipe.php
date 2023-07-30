<?php 

session_start();

$key = $_GET['key'];

if($key != 1){
  if(!(isset($_SESSION['email'])) && !(isset($_SESSION['password']))){
    header("Location: http://localhost/GetRecipe/components/login.php");
  } 
}

require_once ('MysqliDb.php');
  $db = new MysqliDb ('localhost', 'root', '', 'spoonify');

  date_default_timezone_get();

  $db->where('email', $_SESSION['email']);
  $user = $db->getOne('users');

 
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- AJAX -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
      integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- <link
      href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css"
      rel="stylesheet"
    /> -->

    <!-- Daisy UI -->
    <link
      href="https://cdn.jsdelivr.net/npm/daisyui@3.3.1/dist/full.css"
      rel="stylesheet"
      type="text/css"
    />

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
      tailwind.config = {
        theme: {
          extend: {
            listStyleImage: {
              checkmark: 'url("images/checkmark.png")',
            },
          },
        },
      };
    </script>

    <!-- Fontawesome -->
    <script
      src="https://kit.fontawesome.com/269238eb9d.js"
      crossorigin="anonymous"
    ></script>

    <!-- CSS -->
    <link rel="stylesheet" href="recipe.css" />

    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

  </head>

  <body class="">
    <!-- NavBar -->
    <nav
      class="fixed top-0 z-50 w-full bg-white dark:bg-gray-800 dark:border-gray-700"
    >
      <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
          <button class="text-2xl" onclick="history.back()">
            <svg
              width="30"
              height="30"
              fill="none"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path d="M5 9h11a4 4 0 1 1 0 8h-1"></path>
              <path d="M9 13 5 9l4-4"></path>
            </svg>
          </button>
          <div class="flex">
            <img class="h-8 w-8" src="images/spoons.png" alt="" />
            <p class="font-bold text-2xl">Spoonify</p>
          </div>

          <!-- Menu Button -->
          <button
            data-drawer-target="logo-sidebar"
            data-drawer-toggle="logo-sidebar"
            aria-controls="logo-sidebar"
            type="button"
            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          >
            <span class="sr-only">Open sidebar</span>
            <svg
              class="w-6 h-6"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                clip-rule="evenodd"
                fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
              ></path>
            </svg>
          </button>
        </div>
      </div>
    </nav>

    <aside
      id="logo-sidebar"
      class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700"
      aria-label="Sidebar"
    >
      <div
        class="h-full grid px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800"
      >
        <ul class="space-y-2 font-medium">
          <!-- Homepage -->
          <li>
            <a
              href="index.php?key=<?php echo $key;?>"
              class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            >
              <svg
                width="24"
                height="24"
                fill="#8f8f8f"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M12.46 1.66a.757.757 0 0 0-.933 0L.75 10.065l.932 1.178L3 10.216V19.5A1.503 1.503 0 0 0 4.5 21h15a1.503 1.503 0 0 0 1.5-1.5v-9.277l1.318 1.027.932-1.179-10.79-8.41ZM13.5 19.5h-3v-6h3v6Zm1.5 0v-6a1.502 1.502 0 0 0-1.5-1.5h-3A1.502 1.502 0 0 0 9 13.5v6H4.5V9.046L12 3.204l7.5 5.85V19.5H15Z"
                ></path>
              </svg>
              <span class="ml-3">Homepage</span>
            </a>
          </li>

          <!-- Search -->
          <li>
            <button
              type="button"
              class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
              aria-controls="dropdown-example"
              data-collapse-toggle="dropdown-example"
            >
              <svg
                width="24"
                height="24"
                fill="#8f8f8f"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="m21.75 20.692-5.664-5.664a8.264 8.264 0 1 0-1.06 1.061l5.664 5.664 1.06-1.06ZM3 9.753a6.75 6.75 0 1 1 6.75 6.75A6.758 6.758 0 0 1 3 9.753Z"
                ></path>
              </svg>
              <span class="flex-1 ml-3 text-left whitespace-nowrap"
                >Search</span
              >
              <svg
                width="24"
                height="24"
                fill="#8f8f8f"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="m12 21.003-5.25-5.25 1.05-1.05 4.2 4.2 4.2-4.2 1.05 1.05-5.25 5.25Z"
                ></path>
              </svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2">
              <li class="flex items-center pl-8">
                <svg
                  width="24"
                  height="24"
                  fill="#8f8f8f"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M16.334 6a8.613 8.613 0 0 0-2.29.4c-.45.133-.906.236-1.368.31A4.504 4.504 0 0 0 8.25 3v1.5a2.995 2.995 0 0 1 2.87 2.175 15.098 15.098 0 0 1-1.213-.274A9.667 9.667 0 0 0 7.524 6C4.734 6 3 8.299 3 12c0 5.633 3.05 9 6 9h.002a5.367 5.367 0 0 0 1.867-.442A3.74 3.74 0 0 1 12 20.25a3.77 3.77 0 0 1 1.133.308c.59.258 1.223.408 1.867.442 2.948 0 6-3.367 6-9 0-2.768-1.222-6-4.666-6ZM15 19.5a4.128 4.128 0 0 1-1.343-.348A4.812 4.812 0 0 0 12 18.75a4.803 4.803 0 0 0-1.655.402A4.15 4.15 0 0 1 9 19.5h.001C6.788 19.5 4.5 16.694 4.5 12c0-1.353.295-4.5 3.024-4.5a8.427 8.427 0 0 1 2.01.354 9.737 9.737 0 0 0 2.287.396h.37a8.847 8.847 0 0 0 2.246-.402 7.386 7.386 0 0 1 1.897-.348c3.013 0 3.166 3.748 3.166 4.5 0 4.694-2.289 7.5-4.5 7.5Z"
                  ></path>
                  <path
                    d="M13.5 5.25h-.75V4.5a1.502 1.502 0 0 1 1.5-1.5H15v.75a1.502 1.502 0 0 1-1.5 1.5Z"
                  ></path>
                </svg>
                <a
                  href="searchbyingred.php?categ=name&key=<?php echo $key; ?>"
                  class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                >
                  Name</a
                >
              </li>
              <li class="flex items-center pl-8">
                <svg
                  width="24"
                  height="24"
                  fill="#8f8f8f"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18Zm7.5 8.25h-6.75V4.537a7.5 7.5 0 0 1 6.75 6.713Zm-7.935 8.25a7.5 7.5 0 0 1-.315-14.963v6.75a1.5 1.5 0 0 0 1.5 1.5h6.75a7.5 7.5 0 0 1-7.935 6.713Z"
                  ></path>
                </svg>
                <a
                  href="searchbyingred.php?categ=ingred&key=<?php echo $key; ?>"
                  class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                  >Ingredients</a
                >
              </li>
              <li class="flex items-center pl-8">
                <svg
                  width="24"
                  height="24"
                  fill="#8f8f8f"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path d="M7.5 21h-6v1.5h6V21Z"></path>
                  <path
                    d="M12.75 21.75a.75.75 0 0 1-.586-.281L9.39 18H1.5v-1.5h8.25a.75.75 0 0 1 .586.281l2.36 2.95 3.93-5.897a.75.75 0 0 1 1.224-.034l2.025 2.7H22.5V18h-3a.75.75 0 0 1-.6-.3l-1.614-2.152-3.912 5.868a.75.75 0 0 1-.591.333l-.033.001Z"
                  ></path>
                  <path
                    d="M8.25 12V8.25H9a3.003 3.003 0 0 0 3-3V3H9.75a2.983 2.983 0 0 0-2.06.83A4.503 4.503 0 0 0 3.75 1.5H1.5v2.25A4.505 4.505 0 0 0 6 8.25h.75V12H1.5v1.5H12V12H8.25Zm1.5-7.5h.75v.75A1.502 1.502 0 0 1 9 6.75h-.75V6a1.502 1.502 0 0 1 1.5-1.5ZM6 6.75a3.003 3.003 0 0 1-3-3V3h.75a3.003 3.003 0 0 1 3 3v.75H6Z"
                  ></path>
                </svg>
                <a
                  href="#"
                  class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                  >Nutrients</a
                >
              </li>
            </ul>
          </li>

          <!-- Saved Recipes -->
          <?php
            if($key == 0){
              echo '<li>
              <a
                href="savedrecipes.php?key='. $key .'"
                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
              >
                <svg
                  width="24"
                  height="24"
                  fill="#8f8f8f"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M18 1.5H6A1.5 1.5 0 0 0 4.5 3v19.5l7.5-3.79 7.5 3.79V3A1.5 1.5 0 0 0 18 1.5Z"
                  ></path>
                </svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Saved Recipes</span>
              </a>
            </li>

            <li>
              <a
                href="calendar.php?key='. $key .'"
                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
              >
              <svg width="24" height="24" fill="#8f8f8f" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M19.5 3h-3V1.5H15V3H9V1.5H7.5V3h-3A1.502 1.502 0 0 0 3 4.5v15A1.502 1.502 0 0 0 4.5 21h15a1.502 1.502 0 0 0 1.5-1.5v-15A1.502 1.502 0 0 0 19.5 3Zm-15 1.5h3V6H9V4.5h6V6h1.5V4.5h3v3h-15v-3Zm0 4.5h3.75v4.5H4.5V9Zm9.75 10.5h-4.5V15h4.5v4.5Zm0-6h-4.5V9h4.5v4.5Zm1.5 6V15h3.75v4.5h-3.75Z"></path>
            </svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Recipe Planner</span>
              </a>
            </li>
  
            <!-- Logout -->
            <li>
              <a
                href="components/logout.php"
                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
              >
                <svg width="24" height="24" fill="#ff0a0a" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4.5 22.5h9A1.502 1.502 0 0 0 15 21v-2.25h-1.5V21h-9V3h9v2.25H15V3a1.502 1.502 0 0 0-1.5-1.5h-9A1.502 1.502 0 0 0 3 3v18a1.502 1.502 0 0 0 1.5 1.5Z"></path>
                  <path d="m15.44 15.44 2.689-2.69H7.5v-1.5h10.629l-2.69-2.69L16.5 7.5 21 12l-4.5 4.5-1.06-1.06Z"></path>
                </svg>
                <span class="flex-1 ml-3 text-red-500 font-bold whitespace-nowrap">Logout</span>
              </a>
            </li>';
            } else {
              echo '<!-- Login -->
              <li>
                <a
                  href="components/login.php"
                  class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                >
                <svg width="24" height="24" fill="#8f8f8f" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19.5 22.5h-9A1.5 1.5 0 0 1 9 21v-2.25h1.5V21h9V3h-9v2.25H9V3a1.5 1.5 0 0 1 1.5-1.5h9A1.5 1.5 0 0 1 21 3v18a1.5 1.5 0 0 1-1.5 1.5Z"></path>
                  <path d="m10.943 15.443 2.684-2.693H3v-1.5h10.627l-2.684-2.693L12 7.5l4.5 4.5-4.5 4.5-1.057-1.057Z"></path>
                </svg>
                  <span class="flex-1 ml-3 whitespace-nowrap">Login</span>
                </a>
              </li>';
            }
          
          ?>
        </ul>

        <!-- Footer -->

        <footer class="grid content-end text-center text-center">
          <p class="text-md">Spoonify by Erv © 2023</p>
          <div class="w-full text-3xl">
            <i class="fa-brands fa-facebook-messenger"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-linkedin"></i>
          </div>
        </footer>
      </div>
    </aside>

    <!-- Image and title -->
    <section>
      <img class="mt-20 rounded-2xl object-contain" id="image" src="" alt="" />
      <div
        class="title relative -top-16 grid w-11/12 mx-auto h-16 content-center border-2 border-base-500 rounded-2xl"
      >
        <div class="flex justify-between px-4">
          <div>
            <p class="font-bold text-md" id="title"></p>
            <p class="font-bold text-xs" id="sourceName">Author:</p>
          </div>
          <div class="flex gap-4">
            <input type="text" hidden id="key" value=<?php echo $key; ?>
            <?php 
            if($key == 0){
              echo '<form method="POST">
              <input hidden type="text" id="food-id" value="">
              <input hidden type="text" id="user-id" value='.$user["id"].'>

              <button class="hidden" onclick="remtocalendar()" id="remtocalendar">
                <svg width="24" height="24" fill="#f1092c" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="m19.808 18.75 2.692-2.692L21.442 15l-2.692 2.692L16.058 15 15 16.058l2.692 2.692L15 21.442l1.058 1.058 2.692-2.692 2.692 2.692 1.058-1.058-2.692-2.692Z"></path>
                  <path d="M18.75 3.75H16.5V3A1.504 1.504 0 0 0 15 1.5H9A1.504 1.504 0 0 0 7.5 3v.75H5.25a1.504 1.504 0 0 0-1.5 1.5V21a1.504 1.504 0 0 0 1.5 1.5H12V21H5.25V5.25H7.5V7.5h9V5.25h2.25v7.5h1.5v-7.5a1.504 1.504 0 0 0-1.5-1.5ZM15 6H9V3h6v3Z"></path>
                </svg>
              </button>
              
              <!-- Modal -->
              <button class="" onclick="my_modal_2.showModal()" id="addtocalendar">
                <svg id="calendarsvg" width="24" height="24" fill="#09caf1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M23.25 18h-3v-3h-1.5v3h-3v1.5h3v3h1.5v-3h3V18Z"></path>
                  <path d="M18.75 3.75H16.5V3A1.504 1.504 0 0 0 15 1.5H9A1.504 1.504 0 0 0 7.5 3v.75H5.25a1.504 1.504 0 0 0-1.5 1.5V21a1.504 1.504 0 0 0 1.5 1.5h7.5V21h-7.5V5.25H7.5V7.5h9V5.25h2.25V12h1.5V5.25a1.504 1.504 0 0 0-1.5-1.5ZM15 6H9V3h6v3Z"></path>
                </svg>
              </button>
              <dialog id="my_modal_2" class="modal">
                <form method="dialog" class="modal-box text-center">
                  <p class="text-2xl font-bold mb-4">Add to calendar</p>
                  <input class="w-11/12 p-2 mb-4 border-2 border-slate-300" type="text" id="note" placeholder="Title" required>
                  <input class="w-11/12 p-2 mb-4 border-2 border-slate-300" type="date" id="date" required>
                  <button class="w-11/12 h-8 bg-green-400 font-bold" type="button" onclick="addtocalendar()" id="modal-button">Submit</button>
                </form>
                <form method="dialog" class="modal-backdrop">
                  <button id="closeBtn">close</button>
                </form>
              </dialog>

              <button type="button" onclick="submitForm()" id="submit">
                <svg
                id="savesvg"
                width="24"
                height="24"
                fill="#60C43A"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                  <path
                    d="M18 1.5H6A1.5 1.5 0 0 0 4.5 3v19.5l7.5-3.79 7.5 3.79V3A1.5 1.5 0 0 0 18 1.5Z"
                  ></path>
                </svg>
              </button>
            </form>';
            }
            ?>
          </div>
        </div>
      </div>
    </section>

    <!-- Accordion -->

    <div class="join join-vertical relative -top-16 w-full">
      <div class="collapse collapse-arrow join-item border border-base-300">
        <input type="radio" name="my-accordion-4" checked="checked" />
        <div class="collapse-title text-xl flex gap-2 font-medium">
          <img class="h-8 w-8" src="images/ingredient.png" alt="" />
          <p class="font-bold">Ingredients</p>
        </div>

        <!-- Ingredients Content -->
        <div class="collapse-content text-md">
          <!-- Glass bg for modal -->
          <!-- <div
            class="hidden glassBg absolute w-inherit h-inherit left-0 right-0 mx-auto z-10"
            id="glassBg"
          ></div> -->

          <!-- Ingred List -->
          <ul id="ingredients" class="list-image-checkmark px-12"></ul>

          <!-- Modal -->
          <!-- <section
            class="hidden absolute w-11/12 left-0 right-0 mx-auto p-4 items-center border-2 border-black bg-white rounded-lg z-50"
            id="modal"
          >
            <div class="flex justify-between">
              <p>
                Substitute ingredients for:
                <strong id="subIngredName">Butter</strong>
              </p>
              <button class="text-xl text-red-500" id="closeModalBtn">
                <i class="fa-solid fa-circle-xmark"></i>
              </button>
            </div>
            <div class="">
              <ul class="pl-8 list-disc" id="subIngredList"></ul>
            </div>
          </section> -->
        </div>
      </div>

      <div class="collapse collapse-arrow join-item border border-base-300">
        <input type="radio" name="my-accordion-4" />
        <div class="collapse-title text-xl flex gap-2 font-medium">
          <img class="h-8 w-8" src="images/recipe-book.png" alt="" />
          <p class="font-bold">Recipe</p>
        </div>

        <!-- Recipe Content -->
        <div class="collapse-content text-md">
          <ul id="steps" class="px-8 list-decimal"></ul>
        </div>
      </div>

      <div class="collapse collapse-arrow join-item border border-base-300">
        <input type="radio" name="my-accordion-4" />
        <div class="collapse-title text-xl flex gap-2 font-medium">
          <img class="h-8 w-8" src="images/nutrition.png" alt="" />
          <p class="font-bold">Nutritional Facts</p>
        </div>

        <!-- Nutritional Facts Content -->
        <div class="collapse-content">
          <!-- Nutrients Wrapper -->
          <div class="my-4 flex gap-2">
            <!-- First Half -->
            <div class="w-40 stats stats-vertical shadow">
              <div class="stat w-full">
                <div class="stat-title font-bold">Calories</div>
                <div class="stat-value nutriDiv text-xl" id="calValue"></div>
                <div class="stat-desc" id="calDailyValue"></div>
              </div>

              <div class="stat w-full">
                <div class="stat-title font-bold">Fat</div>
                <div class="stat-value nutriDiv text-xl" id="fatValue"></div>
                <div class="stat-desc" id="fatDailyValue"></div>
              </div>

              <div class="stat w-full">
                <div class="stat-title font-bold">Saturated Fat</div>
                <div class="stat-value nutriDiv text-xl" id="satFatValue"></div>
                <div class="stat-desc" id="satFatDailyValue"></div>
              </div>
            </div>
            <!-- Second Half -->
            <div class="w-40 stats stats-vertical shadow">
              <div class="stat w-full">
                <div class="stat-title font-bold">Carbohydrates</div>
                <div class="stat-value nutriDiv text-xl" id="carbsValue"></div>
                <div class="stat-desc" id="carbsDailyValue"></div>
              </div>

              <div class="stat w-full">
                <div class="stat-title font-bold">Sugar</div>
                <div class="stat-value nutriDiv text-xl" id="sugarValue"></div>
                <div class="stat-desc" id="sugarDailyValue"></div>
              </div>

              <div class="stat w-full">
                <div class="stat-title font-bold">Sodium</div>
                <div class="stat-value nutriDiv text-xl" id="sodiumValue"></div>
                <div class="stat-desc" id="sodiumDailyValue"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  </body>
  <script>
    const urlParams = new URLSearchParams(window.location.search);

    const sourceUrl = urlParams.get("details");
    console.log(sourceUrl);

    $.ajax({
      url:
        "https://api.spoonacular.com/recipes/extract?apiKey=9a73fd73b6214058aa415ecb28a85973&url=" +
        sourceUrl,
      success: function (result) {
        console.log(result);

        // For the image, title, hidden-id and summary
        const image = document.getElementById("image");
        const title = document.getElementById("title");
        const sourceName = document.getElementById("sourceName");
        const hiddenId = document.getElementById('food-id');

        const recipeName = result.title;

        // Get the key
        const key = document.getElementById('key').value;


        image.src = result.image;
        title.innerHTML = result.title;
        sourceName.innerHTML +=
          " " + "<span class='text-red-400'>" + result.sourceName + "</span>";

        if(key==0){
          hiddenId.setAttribute('value', result.id);
          
          //For the color of the save tag
          <?php 
            $db->where('user_id', $user['id']);
            $saved = $db->get('saved_recipes');
          ?>

          var saved = <?php echo json_encode($saved) ?>;
          const saveBtn = document.getElementById('savesvg');
          

          if(saved.length > 0){

            saved.forEach(checkifsaved);

            function checkifsaved(items){
              if(items.food_id == result.id){
                saveBtn.setAttribute("fill", "#60C43A");
              } 
            }
          } else {
            saveBtn.setAttribute("fill", "#8f8f8f");
          }
        }

        
        
        // For the ingredients
        const ingredients = result["extendedIngredients"];
        ingredients.forEach(ingreds);

        function ingreds(items) {
          //Initialize the values
          const name = items.originalName;
          const unit = items.measures.metric.unitShort;
          const value = items.measures.metric.amount;

          //Initialize the unordered list (ingredients)
          const ingredList = document.getElementById("ingredients");

          //create div node
          const listDiv = document.createElement("div");
          listDiv.classList.add(
            "flex",
            "justify-between",
            "items-center",
            "gap-2"
          );
          listDiv.setAttribute("id", "listDiv");

          // //create the modal
          // const modal =
          //   `
          //               <button class="text-xl" id="openModalBtn<%=count++%>" value="` +
          //   items.id +
          //   `">
          //                 <i class="fa-solid fa-circle-info"></i>
          //               </button>`;

          //create li node
          const ingredNode = document.createElement("li");
          ingredNode.classList.add("mb-2");

          //create the text
          const textNode = document.createTextNode(value + unit + " " + name);

          ingredNode.appendChild(textNode);
          listDiv.appendChild(ingredNode);
          // listDiv.innerHTML += modal;
          ingredList.appendChild(listDiv);
        }

        //For the Instructions
        const instructions = result["analyzedInstructions"][0]["steps"];
        instructions.forEach(steps);

        function steps(step) {
          //initialize the ordered list (steps)
          const stepList = document.getElementById("steps");

          //create li node
          const stepNode = document.createElement("li");
          stepNode.classList.add("mb-2");

          //create the text
          const textNode = document.createTextNode(step.step);

          //append the text and the li nodes to their parent
          stepNode.appendChild(textNode);
          stepList.appendChild(stepNode);
        }

        //For nutritional facts
        $.ajax({
          url:
            "https://api.spoonacular.com/recipes/" +
            "1003464" +
            "/nutritionWidget.json?apiKey=9a73fd73b6214058aa415ecb28a85973",
          success: function (res) {
            //console.log(res);

            // Nutrients Array
            const nutrients = res["nutrients"];
            //console.log(nutrients);

            //Selected all nutrients div
            const nutriValDiv = document.querySelectorAll(".nutriDiv");
            const nutriValConverted = Array.from(nutriValDiv); //converted the nodelist to array

            //Selected all percent of daily needs
            const statDescDiv = document.querySelectorAll(".stat-desc");
            const statDescConverted = Array.from(statDescDiv);

            for (let i = 0; i < nutriValConverted.length; i++) {
              nutriValConverted[i].innerHTML =
                nutrients[i].amount + nutrients[i].unit;
              statDescConverted[i].innerHTML =
                "Needed daily(%) " + nutrients[i].percentOfDailyNeeds;
            }
          },
        });
      },
    });

    function submitForm(){
    
      var id = document.getElementById('food-id').value;
      var user_id = document.getElementById('user-id').value;

      console.log(id);
      console.log(user_id);

      $.ajax({
        type: "post",
        url: "http://localhost/GetRecipe/submissions/save_recipe.php",
        data: {
          id: id,
          user_id: user_id
        },
        success: function (result) {
          var parsed = JSON.parse(result);
          const saveBtn = document.getElementById('savesvg');
          
          if(parsed.success == true){
            saveBtn.setAttribute("fill", "#60C43A");

            Toastify({
              text: "Recipe Saved",
              duration: 2000,
              close: true,
              gravity: "bottom", // `top` or `bottom`
              style:{
                background: "linear-gradient(to right, #00b09b, #96c93d)"
              }
              }).showToast();

          } else {
            saveBtn.setAttribute("fill", "#8f8f8f");
           
          }
          ;
        }
      });


    };

    function addtocalendar(){
      var id = document.getElementById('food-id').value;
      var user_id = document.getElementById('user-id').value;
      var date = document.getElementById('date').value;
      var note = document.getElementById('note').value;
  

      var closeBtn = document.getElementById('closeBtn');
      var addtocalendar = document.getElementById('addtocalendar');
      var remtocalendar = document.getElementById('remtocalendar');


      $.ajax({
        type: "post",
        url: "http://localhost/GetRecipe/submissions/addtocalendar.php",
        data: {
          id: id,
          user_id: user_id,
          note: note,
          source: sourceUrl,
          date: date
        },
        success: function (result) {
          var parsed = JSON.parse(result);
         
          closeBtn.click();
          if(parsed.success){
            // addtocalendar.classList.add("hidden");
            // remtocalendar.classList.remove("hidden");
            Toastify({
              text: "Added to calendar.",
              duration: 2000,
              close: true,
              gravity: "bottom", // `top` or `bottom`
              style:{
                background: "linear-gradient(to right, #00b09b, #96c93d)"
              }
            }).showToast();
          }
           else {

          }
        },
   
      })
    }

    // function remtocalendar(){
    //   $.ajax({
    //     type: "post",
    //     url: "http://localhost/GetRecipe/submissions/remtocalendar.php",
    //     data: {
    //       id: id
    //     },
    //     success: function (result) {
    //       var parsed = JSON.parse(result);
        
    //       if(parsed.success){
    //         addtocalendar.classList.remove("hidden");
    //         remtocalendar.classList.add("hidden");
    //       }
    //     },
    //   })
    // }

    // //For the substitute ingredients
    // const modal = document.getElementById("modal");
    // const overlay = document.getElementById("glassBg");
    // const openModalBtn = document.getElementById("openModalBtn");
    // const closeModalBtn = document.getElementById("closeModalBtn");

    // $(document).on("click", 'button[id^="openModalBtn"]', function (e) {
    //   var ingredId = $(this).val();
    //   var listDivId = document.getElementById($(this).parent()[0].id);

    //   if (modal.classList[0] != "hidden") {
    //     modal.classList.add("hidden");
    //   }

    //   //console.log(ingredId);

    //   const subIngredName = document.getElementById("subIngredName");
    //   const subIngredList = document.getElementById("subIngredList");

    //   $(subIngredList).empty();

    //   $.ajax({
    //     url:
    //       "https://api.spoonacular.com/food/ingredients/" +
    //       ingredId +
    //       "/substitutes?apiKey=9a73fd73b6214058aa415ecb28a85973",
    //     success: function (items) {
    //       //console.log(items);

    //       document.getElementById("subIngredName").innerHTML = items.ingredient;

    //       // check the status of the request
    //       if (items.status == "failure") {
    //         //Empty string for the title
    //         document.getElementById("subIngredName").innerHTML = "";

    //         const ingredNode = document.createElement("li");
    //         ingredNode.innerHTML = "No substitute ingredients";
    //         ingredNode.classList.add("text-red-500");

    //         subIngredList.appendChild(ingredNode);
    //         modal.classList.remove("hidden");
    //         overlay.classList.remove("hidden");
    //         return 0;
    //       }

    //       const substitutes = items["substitutes"];
    //       substitutes.forEach(subList);

    //       function subList(list) {
    //         //console.log(items);
    //         const ingredNode = document.createElement("li");
    //         ingredNode.innerHTML = list;
    //         subIngredList.appendChild(ingredNode);
    //       }
    //       listDivId.parentNode.insertBefore(modal, listDivId.nextSibling);
    //       modal.classList.remove("hidden");
    //       overlay.classList.remove("hidden");
    //     },
    //   });
    // });

    // const closeModal = function () {
    //   modal.classList.add("hidden");
    //   overlay.classList.add("hidden");
    // };

    // closeModalBtn.addEventListener("click", closeModal);

    // //For pre loader
    // const preloader = document.getElementById("preloader");

    // //Add an event listener when the page loads
    // window.addEventListener("load", function () {
    //   //added a delay for testing purposes
    //   setTimeout(function () {
    //     preloader.classList.add("hidden");
    //   }, 2000);
    // });
  </script>
</html>
