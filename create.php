<?php
  $conn = mysqli_connect( "localhost", "root", "111111", "opentutorials" );
  $sql = "SELECT * FROM topic LIMIT 1000";
  $result = mysqli_query( $conn, $sql );
  $list = "";
  $next_id='';
  while($row = mysqli_fetch_array($result)){
    $list .= "<li><a href = \"index.php?id={$row['id']}\">{$row['title']}</a></li>";
    $next_id = $row['id']+1;
  }

  $sql = "SELECT * FROM author LIMIT 1000";
  $result = mysqli_query($conn, $sql);
  $select_form ='<select name = "author_id">';
  while( $row = mysqli_fetch_array($result)){
    $select_form .= '<option value = "'.$row['id'].'">'.$row['name'].'</option>';
  }
  $select_form .= '</select>';

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB - Create</title>
  </head>
  <body>
    <h1><a href="index.php">WEB</a></h1>
    <ol>
      <?=$list?>
    </ol>

    <form action="create_process.php" method="POST">
      <input type="hidden" name="$next_id" value="<?=$next_id?>">
      <p><input type="text" name="title" placeholder="title"></p>
      <p><textarea name="description" placeholder="description"></textarea></p>
      <!-- name = author_id -->
      <?=$select_form?>
      <p><input type="submit"></p>
    </form>
  </body>
</html>
