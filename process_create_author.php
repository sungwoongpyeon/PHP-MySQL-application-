<?php
  $conn = mysqli_connect( "localhost", "root", "111111", "opentutorials" );

  // to secure => mysqli_real_escape_string($conn, [])
  $filtered = array(
  'name'=>mysqli_real_escape_string($conn, $_POST['name']),
  'profile'=>mysqli_real_escape_string($conn, $_POST['profile'])
  );

  $sql = "
    INSERT INTO author
      (name, profile)
    VALUES(
        '{$filtered['name']}',
        '{$filtered['profile']}'
    )";

  $result = mysqli_query( $conn, $sql );
  if( $result === false ){
    echo '<script>alert("Problem has been happened when it was saved. Please call administrator.")</script>';
    error_log(mysqli_error($conn));
  } else {
    header('Location: author.php');
  }
 ?>
