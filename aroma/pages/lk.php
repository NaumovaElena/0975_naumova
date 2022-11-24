<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
      integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn"
      crossorigin="anonymous"
    />
    <title>Личный кабинет</title>
    <style>
        p {
            font-size: 1.2rem;
        }
        input {
          font-size: 1.2rem;
          font-weight: 500;
        }
    </style>
  </head>
  <body>
    <div class="container mt-5">
        <h1 class="text-center mb-3 shadow-sm text-success">Личный кабинет</h1>
        <p>Имя: &nbsp; <span><?php echo$_SESSION["name"];?></span>
        <span class="edit-buttons btn btn-danger ml-5">Редактировать</span>
        <!-- сами придумываем атрибут data-item="name", js воспринимает атрибут data как свойство объекта -->
        <span class="save-buttons btn btn-success ml-5" hidden data-item="name">Сохранить</span>
        <span class="cancel-buttons btn btn-info ml-2" hidden>Отменить</span>
      </p>
        <!-- второй вариант записи php функции -->
        <p>Фамилия: &nbsp; <span><?= $_SESSION["lastname"];?></span>
        <span class="edit-buttons btn btn-danger ml-5">Редактировать</span>
        <span class="save-buttons btn btn-success ml-5"hidden data-item="lastname">Сохранить</span>
        <span class="cancel-buttons btn btn-info ml-2"hidden>Отменить</span>
      </p>
        <p>E-mail: &nbsp; <?php echo$_SESSION["email"];?></p>
        <p>Id: <?php echo$_SESSION["id"];?></p>
    </div>

    <script>
      let edit_buttons = document.querySelectorAll(".edit-buttons");
      let save_buttons = document.querySelectorAll(".save-buttons");
      let cancel_buttons = document.querySelectorAll(".cancel-buttons");
 
      for(let i = 0; i < edit_buttons.length; i++) {
        let inputValue = edit_buttons[i].previousElementSibling.innerText;
                
        edit_buttons[i].addEventListener("click", ()=> {          
         
          edit_buttons[i].previousElementSibling.innerHTML = `<input type= "text" value= "${inputValue}">`;
         
          save_buttons[i].hidden = false;
          cancel_buttons[i].hidden = false;
          edit_buttons[i].hidden = true;

    
        });

          save_buttons[i].addEventListener("click", async ()=> {
            let newInputValue = edit_buttons[i].previousElementSibling.firstChild.value;
            edit_buttons[i].previousElementSibling.innerText = newInputValue;
                       
            save_buttons[i].hidden = true;
            cancel_buttons[i].hidden = true;
            edit_buttons[i].hidden = false;
            
            let itemName = save_buttons[i].dataset.item;
            let formData = new FormData();
            //добавляем ключи, которые ловим в обработчике lk_obr.php
            formData.append("item", itemName);
            formData.append("value", newInputValue);            
            
            let response = await fetch("php/classes/User.php", {
              method: 'POST',
              body: formData
            });
          
         }); 

         cancel_buttons[i].addEventListener("click", ()=> {
          edit_buttons[i].previousElementSibling.innerText = inputValue;  
            save_buttons[i].hidden = true;
            cancel_buttons[i].hidden = true;
            edit_buttons[i].hidden = false;             
            
         });           
      }


    </script>

    <script
      src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
