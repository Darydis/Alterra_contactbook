<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8">
        <link rel="stylesheet" href="./styles/index.css">
    </head>
    <body>
        <?php
    $host = 'localhost';  // Хост, у нас все локально
    $user = 'root';    // Имя созданного вами пользователя
    $pass = '';  //Установленный вами пароль пользователю
    $db_name = 'Alterra';   // Имя базы данных
    $link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

    // Ругаемся, если соединение установить не удалось
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }
  ?>
        <div class="wrap">
            <div class="form">
                <div class="header">
                    <span>Добавить контакт</span>
                </div>
                
                <form action="" method="post">
                    <div class="inputs">
                        <input type="text" name="name" placeholder="Имя">
                        <input type="text" name="phone" placeholder="Телефон">
                        <div class="submit">
                        <?php
  //Если переменная Name передана
  if (isset($_POST["name"])) {
    //Вставляем данные, подставляя их в запрос
    $sql = mysqli_query($link, "INSERT INTO `contact_book` (`name`, `phone`) VALUES ('{$_POST['name']}', '{$_POST['phone']}')");
    //Если вставка прошла успешно
    if ($sql) {
       // $_POST = array();
        header("Location: index.php");
        echo '<p>Новый контакт успешно добавлен в БД.</p>';
        echo "<script type='text/javascript'>console.log('lalala');</script>";
    //   sleep(2);
     
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
    
  }
?>
                        
                        <input class="button" type="submit" value="Добавить">
                        </div>
                    </div>
                </form>
            </div>
            <div class="data">
                <div class="header">Список контактов</div>
                <div class="list">
                <?php
  //Удаляем, если что
  if (isset($_GET['del'])) {
    $name = mysqli_fetch_row(mysqli_query($link, "SELECT `name` FROM `contact_book` WHERE `id` = {$_GET['del']}"));
    $sql = mysqli_query($link, "DELETE FROM `contact_book` WHERE `id` = {$_GET['del']}");
   
    if ($sql) {
      echo "<p>Контакт <strong>{$name[0]}</strong> удален.</p>";
      sleep(2);
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
  }
?>
<?php
  //Получаем данные
  $sql = mysqli_query($link, 'SELECT `id`,`name`, `phone` FROM `contact_book`');
  while ($result = mysqli_fetch_array($sql)) {
      echo "<div class='contact'>
      <div class='name'> {$result['name']}
      <form action='delete.php' method='post'>
      <input type='hidden' name='id' value={$result['id']}>
      <input class='cross' type='submit' value='x'>
      </form>
      </div>
      
       <div class='phone'> {$result['phone']} </div> 
       </div> ";
  }
?>
                    
                    </div>
            </div>
        </div>
 
    </body>
</html>