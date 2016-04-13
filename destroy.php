<?php
unset($_SESSION['ids']);
unset($_SESSION['names']);
unset($_SESSION['cost']);
session_destroy();
session_unset();

    
    $_SESSION['totalCost'] =0;


header('Location: index.php?action=destroy&id' . $id . '&name=' . $name);

?>