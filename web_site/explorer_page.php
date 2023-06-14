<!DOCTYPE html>
<html>
    <head>
        <title>Thales</title>
        <link href="thales.css" rel="stylesheet">
    </head>
<body>
<header>
<h1><a href="index.html">Thales</a></h1>
<img class="hamburger_menu" src="picture/menu.png">
</header>
<ul>
    <img class="close" src="picture/close.png">
    <li><a href="index.html"><h1>Home</h1></a></li>
    <li><a href="explorer_page.php"><h1 class="hover">Explorer</h1></a></li>
    <li><a href="transfert_functions.php"><h1>Transfert Functions</h1></a></li>
    <li><a href="Documentation html/documentation.php"><h1>Documentation</h1></a></li>
</ul>
<div class="center">
    <h1>Explorer</h1>
    <section></section>
    <div class="tab_container">
<?php
    require("explorer.php");

    $explorer = new Explorer("../db.sql");
    
    /*
        Opens the database.    
    */
    if (! $explorer->open_database())
    {
        $explorer->display_error("Opening the database");
        exit();
    }

    /*
        Displays the available tests.
    */
    echo "
        <table>
            <tr>
                <th>Test Name</th>
                <th>Execution Date</th>
                <th></th>
            </tr>\n";

    foreach ($explorer->run_sql_query("SELECT * FROM tests") as $item)
    {
        $id = $item["id"];
        $name = $item["name"];
        $execution_date = $item["execution_date"];

        echo "
            <tr>
                <td>$name</td>
                <td>$execution_date</td>
                <td>
                    <form action=\"results.php\" method=\"GET\">
                        <button type=\"submit\" name=\"id\" value=\"$id\">Open</button>
                    </form>
                </td>
            </tr>\n";
    }

    echo "</table>\n";
?>
</div>
<a class="switch_page" href="transfert_functions.php">Transfert Functions</a>
</div>
<?php
    require("footer.php");
?>
