<?php 

session_start();

require_once ('../MysqliDb.php');
$db = new MysqliDb ('localhost', 'root', '', 'spoonify');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['submit'] == 'login') {

    //Initialized the input values
    $email = $_POST['email'];
    $password = $_POST['password'] ;

    $db->where('email', $email);
    $result = $db->getOne('users');

    
    $verify = password_verify($password, $result['password']);
    
    if($verify == true){
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
      //echo "correct";
      header('Location: http://localhost/GetRecipe/index.php?key=0');
     
    } else {
      //header('Location: http://localhost/GetRecipe/components/login.php');
    }
    
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
    <link rel="stylesheet" href="../searchbyingred.css" />
  </head>

  <body class="h-screen">
    <div class="grid justify-items-center mt-4">
      <div class="flex">
        <img class="h-8 w-8" src="../images/spoons.png" alt="" />
        <p class="font-bold text-2xl">Spoonify</p>
      </div>
    </div>

    <!-- Card Wrapper -->
    <section class="mt-20 grid justify-items-center w-screen" id="output">
      <form class=" w-10/12" method="POST">
        <div class="font-bold text-2xl text-center mb-4">
          <p>Login</p>
        </div>
        <input
          class="input pl-4 mb-4"
          type="email"
          name="email"
          id="email"
          placeholder="Email"
        />
        <input
          class="input pl-4"
          type="password"
          name="password"
          id="password"
          placeholder="password"
        />
        <div class="w-full mb-2 grid justify-items-end">
          <a class="text-red-400" href="">Forgot Password?</a>
        </div>
        <button
          type="submit"
          class="h-8 w-full bg-yellow-400 font-bold text-lg rounded-lg"
          name="submit"
          value="login"

        >
          Login
        </button>
      </form>

      <div class="flex flex-col w-11/12 border-opacity-50">
        <div class="divider">Or</div>
      </div>

      <div class="h-8 w-10/12 text-center font-bold text-lg rounded-lg border-2 border-slate-300">
        <a class="" href="../index.php?key=1">Continue as guest</a>
      </div>


      <div class="absolute bottom-8 text-center">
        <p class="text-sm">
          Don't have an account?
          <a class="text-blue-400" href="signup.php">Create Account.</a>
        </p>
        <p class="text-sm">フィビーさん に インスピレエションうけました</p>
      </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
  </body>
</html>
