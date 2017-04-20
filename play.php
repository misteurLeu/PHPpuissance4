<?php
    include_once("puissance4.php");
    session_start();
    if (!isset($_SESSION["puissance4"]))
    {
        $_SESSION["puissance4"] = new puissance4();
        echo($_SESSION["puissance4"]->getHTML());
    }
    else if  (isset($_GET["column"]) && $_GET["column"] == -1)
    {
        $_SESSION["puissance4"]->reset();
        echo($_SESSION["puissance4"]->getHTML());
    }
    else if (isset($_GET["column"]))
        echo($_SESSION["puissance4"]->play($_GET["column"]));
    else
        echo ("error");
?>