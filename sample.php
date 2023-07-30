<?php 

require_once ('MysqliDb.php');
  $db = new MysqliDb ('localhost', 'root', '', 'spoonify');

  $db->where('user_id', 7);
  $calendar = $db->get('calendar');

  $key = 0;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Flowbite and Tailwind -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/daisyui@3.4.0/dist/full.css"
      rel="stylesheet"
      type="text/css"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <script
      src="https://kit.fontawesome.com/269238eb9d.js"
      crossorigin="anonymous"
    ></script>

    <!-- CSS Link -->
    <link rel="stylesheet" href="recipe.css" />

    <script>
      tailwind.config = {
        theme: {
          extend: {},
        },
      };
    </script>

    <!-- FullCalendar -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  </head>

  <body>
    <p>Sample</p>
  
    <div class="p-8" id="calendar"></div>

    <div class="h-1/3 mt-4 p-4">
      <p class="font-bold text-2xl text-red-400 border-b-2 border-slate-300">
        Meals to cook today:
      </p>
      <!-- Hidden Items -->
      <input type="text" id="hiddenid" value="" hidden>
      <button class="hidden" id="remevent" onclick="remevent()">
        <svg width="24" height="24" fill="#fd3f3f" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 1.5C6.15 1.5 1.5 6.15 1.5 12S6.15 22.5 12 22.5 22.5 17.85 22.5 12 17.85 1.5 12 1.5Zm4.05 15.75L12 13.2l-4.05 4.05-1.2-1.2L10.8 12 6.75 7.95l1.2-1.2L12 10.8l4.05-4.05 1.2 1.2L13.2 12l4.05 4.05-1.2 1.2Z"></path>
        </svg>
      </button>

      <div class="mt-4" id="events"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script>
      const randomColor = Math.floor(Math.random()*16777215).toString(16);
      // const tag = document.getElementById('tag');
      // tag.style.backgroundColor = "#"+randomColor;

      $(document).ready(function () {

        $("#calendar").fullCalendar({
          selectable: true,
          dayClick: function(){
            console.log('day');
          },
          eventClick: function (event) {
            getevents(event);
          },
          events: [
           <?php 
           foreach($calendar as $info){
            ?>{
                'id': '<?php echo $info['id'] ?>',
                'title': '<?php echo $info['note'] ?>',
                'start': '<?php echo $info['date'] ?>',
                'description': '<?php echo $info['sourcelink'] ?>'          
              },
            <?php }?>
            
          ],
        });
      });

      function getevents(event){
        console.log(event);

        const deleteBtn = document.getElementById('remevent');
        if(!(deleteBtn.classList.contains)){
          deleteBtn.classList.add('hidden');
        }

        // container
        const container = document.getElementById('events');
        container.innerHTML = ""; // to make sure that the events is cleared.

        // Wrapper 
        const wrapper = document.createElement('div');
        wrapper.classList.add("w-full", "h-20", "flex", "shadow-xl", "rounded-2xl");

        // For the link
        const link = document.createElement('a');
        link.classList.add("w-full", "flex", "gap-2");
        link.href = "recipe.php?details=" + event.description + "&key=1";

        // Tag
        const tag = document.createElement('div');
        tag.classList.add("w-12", "h-full", "rounded-lg");
        tag.style.backgroundColor = "#"+randomColor;

        // Description
        const desc = document.createElement('div');
        desc.classList.add("w-full","h-full", "p-2", "grid", "content-center");

        // Hidden id
        // console.log(event.id);
        const hiddenid = document.getElementById('hiddenid');
        hiddenid.value = event.id;
        
        // title
        const descTitle = document.createElement('p');
        descTitle.classList.add("text-3xl");
        descTitle.innerHTML = event.title;

        // Delete div
        const deletediv = document.createElement('div');
        deletediv.classList.add("w-16", "p-2", "grid", "justify-items-center", "content-center");

        // Delete Button
        deleteBtn.classList.remove('hidden');

        // Append
        deletediv.appendChild(deleteBtn);

        desc.appendChild(descTitle);

        link.appendChild(tag);
        link.appendChild(desc);


        wrapper.appendChild(link);
        wrapper.appendChild(deletediv);

        container.appendChild(wrapper);

      }

      function remevent(){
        const toberem = document.getElementById('hiddenid').value;
        
        $.ajax({
          type:"post",
          url: "http://localhost/GetRecipe/submissions/remtocalendar.php",
          data:{
            id: toberem
          },

          success: function(result){
            const parsed = JSON.parse(result);
            console.log(parsed);
            location.reload(true);
          }
          
        })
      }
    </script>
  </body>
</html>
