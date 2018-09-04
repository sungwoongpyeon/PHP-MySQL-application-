<?php
  $conn = mysqli_connect( "localhost", "root", "111111", "opentutorials" );
  $sql = "SELECT * FROM topic LIMIT 1000";
  $result = mysqli_query( $conn, $sql );
  $list = "";
  while($row = mysqli_fetch_array($result)){
    $list .= "<li><a href = \"index.php?id={$row['id']}\">{$row['title']}</a></li>";
  }

  $article = array(
    'title' => 'WELCOME PHP',
    'description' => 'This website is built to connect PHP with Database(MySQL).'
  );

  $update_link = '';
  $delete_link = '';
  $author = '';
  if( isset($_GET['id']) ){
    // to secure => mysqli_real_escape_string($conn, [])
    $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id = {$filtered_id}";
    $result = mysqli_query( $conn, $sql );
    $row = mysqli_fetch_array($result);
    $article['title'] = htmlspecialchars($row['title']);
    $article['description'] = htmlspecialchars($row['description']);
    $article['name'] = htmlspecialchars($row['name']);

    $update_link = '<a href = "update.php?id='.$_GET['id'].'">update</a>';
    $delete_link = '
      <form action="delete_process.php" method="post">
        <input type="hidden" name="id" value="'.$_GET['id'].'">
        <input type="submit" value="delete">
      </form>
    ';
    $author = "<p>by {$article['name']}</p>";

  }

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB - <?=$article['title']?></title>
  </head>
  <body>
    <h1><a href="index.php">WEB</a></h1>
    <p><a href="author.php">author</a></p>
    <ol>
      <?=$list?>
    </ol>

    <a href="create.php">create</a>
    <?=$update_link?>
    <?=$delete_link?>
    <h2>
      <?=$article['title']?>
    </h2>
      <?=$article['description']?>
      <?=$author?>
  </body>
</html>
