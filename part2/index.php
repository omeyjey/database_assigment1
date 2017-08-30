<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Test</title>
  </head>
  <body>
    <?php

    $a = 6;
    $b = 3;

    echo $a + $b . '<br>';

    // == checks if same value
    if($a == $b) {
      echo "Equal" . '<br>';
    } else {
      echo "not Equal" . '<br>';
    }

    // checks if same value and type
    if($a === $b) {
      echo "Equal and same type" . '<br>';
    } else {
      echo "Could be equal but not same type" . '<br>';
    }

    // You have to define if you are using global variables or not
    function globals() {
      global $a; // 6
      $b = 10; // !3

      echo $a . '<br>';
      echo $b . '<br>';
    }

    globals();
    echo $b; // 3

    ?>
  </body>
</html>
