<?php
  $conn = mysqli_connect( "localhost", "root", "111111", "opentutorials" );

  // to secure => mysqli_real_escape_string($conn, [])
  $filtered = array(
  'title'=>mysqli_real_escape_string($conn, $_POST['title']),
  'description'=>mysqli_real_escape_string($conn, $_POST['description']),
  'author_id'=>mysqli_real_escape_string($conn, $_POST['author_id'])
  );

  $sql = "
    INSERT INTO topic
      (title, description, created, author_id)
    VALUES(
        '{$filtered['title']}',
        '{$filtered['description']}',
        NOW(),
        {$filtered['author_id']}
    )";

  $result = mysqli_query( $conn, $sql );
  if( $result === false ){
    echo '<script>alert("Problem has been happened when it was saved. Please call administrator.")</script>';
    error_log(mysqli_error($conn));
  } else {
    header('Location: index.php?id='.$_POST['$next_id']);
  }
 ?>
