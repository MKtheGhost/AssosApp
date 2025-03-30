<?php

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Finally, destroy the session.
session_unset();
session_destroy();

//header("Location: index.php");
exit();

?>