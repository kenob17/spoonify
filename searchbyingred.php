<?php 

session_start();
$key = $_GET['key'];

if($key != 1){
  if(!(isset($_SESSION['email'])) && !(isset($_SESSION['password']))){
    header("Location: http://localhost/GetRecipe/components/login.php");
  } 
}

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
    <link rel="stylesheet" href="searchbyingred.css" />
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

    <!-- Search Bar -->
    <section class="mt-20 px-4">
      <div class="group w-full">
        <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
          <g>
            <path
              d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
            ></path>
          </g>
        </svg>
        <input
          placeholder="Search by Ingredients"
          type="search"
          id="search"
          class="input"
        />
      </div>
    </section>

    <!-- For the Key -->
    <input type="text" hidden id="key" value=<?php echo $key; ?>>

    <!-- Card Wrapper -->
    <section class="mt-12 w-screen" id="output">
      <!-- Card -->
      <!-- <div class="flex shadow-xl mx-4 mb-4 rounded-xl">
        <img class="w-32 h-28 object-cover rounded-xl" src="images/orangechicken.jpg" alt="" />
        <div class="w-60 grid content-between h-full p-2">
          <p class="">Orange Chicken</p>
          <p class="text-sm">Author: Sample Author</p>

          <div class="flex gap-4">
            <div class="flex content-center gap-1">
              <img class="" src="images/clock.png" alt="" />
              <p>40 mins</p>
            </div>
            <div class="flex content-center gap-1">
              <img src="images/laughing.png" alt="" />
              <p>Easy</p>
            </div>
          </div>
        </div>
      </div> -->
    </section>

    <!-- Image and title -->
    <!-- <section>
      <img class="w-32 h-28 object-cover rounded-xl" id="image" src="" alt="" />
      <div
        class="title relative -top-16 grid w-11/12 mx-auto h-16 content-center border-2 border-base-500 rounded-2xl"
      >
        <div class="flex justify-between px-4">
          <div>
            <p class="font-bold text-md" id="title"></p>
            <p class="font-bold text-xs" id="sourceName">Author:</p>
          </div>
          <div class="grid content-center">
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
          </div>
        </div>
      </div>
    </section> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

    <script>
      //Recipe API

      //Get the passed parameter
      const searchCateg = new URLSearchParams(window.location.search);
      const categ = searchCateg.get("categ");
    
      //Get the key 
      const key = document.getElementById('key').value;

      //Get the id of the input
      const search = document.getElementById("search");

      const searchByName =
        "https://api.spoonacular.com/recipes/complexSearch?apiKey=9a73fd73b6214058aa415ecb28a85973&query=";
      const searchByIngred =
        "https://api.spoonacular.com/recipes/search?apiKey=9a73fd73b6214058aa415ecb28a85973&query=";
      const searchByNutrients =
        "https://api.spoonacular.com/recipes/findByNutrients?apiKey=9a73fd73b6214058aa415ecb28a85973";
      let urlCateg = "";
      let type = 1;

      if (categ == "name") {
        urlCateg = searchByName;
        $(search).attr("placeholder", "Search by Recipe Name");
      } else if (categ == "ingred") {
        urlCateg = searchByIngred;
        type = 2;
      } else {
        urlCateg = searchByNutrients;
      }

      function getrecipe(id) {
        //document.getElementById("output").innerHTML = "";


        $.ajax({
          url: urlCateg + id,
          success: function (res) {
            console.log(res);
            const results = res["results"];
            const baseUri = res["baseUri"];
            results.forEach(bricks);

            function bricks(items) {
              //console.log(items);

              // Create the link
              const link = document.createElement("a");

              if (type == 1) {
                $.ajax({
                  url:
                    "https://api.spoonacular.com/recipes/" +
                    items.id +
                    "/information?apiKey=9a73fd73b6214058aa415ecb28a85973&includeNutrition=false",
                  success: function (result) {
                    console.log(result);

                    // link.setAttribute("target", "_blank");
                    link.href = "recipe.php?details=" + result.sourceUrl + "&key=" + key;
                    console.log(link.href);
                  },
                });
              } else {
                // link.setAttribute("target", "_blank");
                link.href = "recipe.php?details=" + items.sourceUrl + "&key=" + key;
                console.log(link.href);
              }

              console.log(link);

              //Create the Card
              const card = document.createElement("div");
              card.classList.add(
                "flex",
                "shadow-xl",
                "mx-4",
                "mb-4",
                "rounded-xl"
              ); //Add the tailwind class

              //Create the image tag
              const image = document.createElement("img");
              image.classList.add("w-32", "h-28", "object-cover", "rounded-xl");
              if (type == 1) {
                image.src = items.image;
              } else {
                image.src = baseUri + items.image;
              }

              //Create the description div
              const description = document.createElement("div");
              description.classList.add(
                "w-60",
                "grid",
                "content-between",
                "h-full",
                "p-2"
              );

              //Creating elements inside the description div
              //Creating the id and title
              const title = document.createElement("p");
              title.classList.add("font-bold", "text-lg");
              title.innerHTML = items.title;

              const author = document.createElement("p");
              author.classList.add("text-sm");
              author.innerHTML = "Author: " + items.author;

            
              //Appending id and title to
              description.appendChild(title);
              description.appendChild(author);


              // Append the image and description to the card div
              card.appendChild(image);
              card.appendChild(description);

              // Append the card div to the link
              link.appendChild(card);

              // Append the link to the container
              const containter = document.getElementById("output");
              containter.appendChild(link);
            }
          },
        });
      }

      // Get the input field
      var input = document.getElementById("search");

      // Execute a function when the user presses a key on the keyboard
      input.addEventListener("keypress", function (event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
          //console.log("sample text");
          getrecipe(input.value);
        }
      });
    </script>
  </body>
</html>
