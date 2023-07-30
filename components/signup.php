
<?php 

require_once ('../MysqliDb.php');



$db = new MysqliDb ('localhost', 'root', '', 'spoonify');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['submit'] == 'insert') {

   
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT) ;


    $db->where('email', $email);

    //Check if the email exist/used already
    if(!($db->get('users'))){
      $info = Array(
        "firstname" => $first_name,
        "lastname" => $last_name,
        "email" => $email,
        "password" => $password,
      );
      //Insert the data
      $id = $db->insert ('users', $info);

      if($id){
        header('Location: http://localhost/GetRecipe/components/login.php');
      }
    } else {
      echo "<script>alert('Email exist! Use different email.'); </script>";
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
      <form  class="p-2 w-10/12" method="POST">
        <div class="font-bold text-2xl text-center mb-4">
          <p>Sign Up</p>
        </div>

        <input
          class="input pl-4 mb-4"
          type="text"
          name="firstname"
          id="firstname"
          placeholder="First Name"
          required
        />

        <input
          class="input pl-4 mb-4"
          type="text"
          name="lastname"
          id="lastname"
          placeholder="Last Name"
          required
        />

        <input
          class="input pl-4 mb-4"
          type="email"
          name="email"
          id="email"
          placeholder="Email"
          required
        />
        <input
          class="input pl-4 mb-4"
          type="password"
          name="password"
          id="password"
          placeholder="Password"
          required
        />
        <p id="status"></p>
        <input
          class="confirm input pl-4 mb-4"
          type="password"
          name="confirm"
          id="confirm"
          placeholder="Confirm Password"
          required
        />

        <button
          type="submit"
          class="h-8 w-full bg-yellow-400 font-bold text-lg rounded-lg"
          value="insert"
          name="submit"
          id="submitbtn"
        >
          Sign Up
        </button>
      </form>
      <div class="text-center">
        <p class="text-sm">
          Have an account?
          <a class="text-blue-400" href="login.php">Login</a>
        </p>
      </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

    <script>
      // For confirm password
      $("#confirm").on("input propertychange", function () {
        var password = document.getElementById("password").value;
        var confirmpass = document.getElementById("confirm").value;

        if (password == confirmpass) {
          document.getElementById("status").innerHTML = "Password matched!";
          document.getElementById("status").style.color = "green";
          document.getElementById("submitbtn").disabled = false;
          document.getElementById("submitbtn").style.backgroundColor =
            "#ffc300";
        } else {
          document.getElementById("status").innerHTML =
            "Password does not match!";
          document.getElementById("status").style.color = "red";
          document.getElementById("submitbtn").disabled = true;
          document.getElementById("submitbtn").style.backgroundColor = "gray";
        }
      });
      // $(".confirm").change(function () {});
    </script>
  </body>
</html>
