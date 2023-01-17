<?php

try {
     $db = new PDO("mysql:host=localhost;dbname=smurfdeals;charset=utf8", "root", "",);
} catch ( PDOException $e ){
     print $e->getMessage();
}

// try {
//      $db = new PDO("mysql:host=51.89.96.168;dbname=smurfdea_smurfdeals;charset=utf8", "smurfdea_yes", "Sinop5757.",);
// } catch ( PDOException $e ){
//      print $e->getMessage();
// }

?>
