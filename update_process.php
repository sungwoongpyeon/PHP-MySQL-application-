<?php
  $conn = mysqli_connect( "localhost", "root", "111111", "opentutorials" );

  // to secure => mysqli_real_escape_string($conn, [])
  $filtered = array(
  'id'=>  mysqli_real_escape_string($conn, $_POST['id']),
  'title'=> mysqli_real_escape_string($conn, $_POST['title']),
  'description'=> mysqli_real_escape_string($conn, $_POST['description'])
  );
  $sql = "
    UPDATE topic
      SET
        title = '{$filtered['title']}',
        description = '{$filtered['description']}'
      WHERE
        id = {$filtered['id']}
  ";

  $result = mysqli_query( $conn, $sql );
  if( $result === false ){
    echo '<script>alert("Problem has been happened when it was saved. Please call administrator.")</script>';
    error_log(mysqli_error($conn));
  } else {
    header('Location: index.php?id='.$_POST['id']);
  }
 ?>
