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
    <li><a href="explorer_page.php"><h1>Explorer</h1></a></li>
    <li><a href="transfert_functions.php"><h1 class="hover">Transfert Functions</h1></a></li>
    <li><a href="Documentation html/documentation.php"><h1>Documentation</h1></a></li>
</ul>
<div class="center">
    <h1>Transfert Functions</h1>
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
        Creates the "transfert_functions" table.
    */
    $explorer->run_sql_query("CREATE TABLE IF NOT EXISTS transfert_functions (
        field_name VARCHAR(50),
        brut VARCHAR(50),
        label VARCHAR(50)
    )");
?>
<form method='POST'>
    <table>
        <tr>
            <th colspan="2">
                Select the fields to work on
            </th>
        </tr>
        <tr>
<?php
    try 
    {
        $counter = 0;
        foreach ($explorer->run_sql_query("SELECT old, new FROM field_names") as $field)
        {
            echo "<td><label><input type='checkbox' name='field_names[]' value='";
            
            if ($field["new"] == "")
            {   
                echo htmlspecialchars($field['old'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($field['old'], ENT_QUOTES, 'UTF-8');
            }
            else
            {
                echo htmlspecialchars($field['old'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($field['new'], ENT_QUOTES, 'UTF-8');
            }
        
            echo "</td></label>";

            if ((++$counter % 2) == 0)
            {
                echo "</tr><tr>";
            }
        }
    } 
    catch (\Throwable $th) 
    {
        $counter = 0;

        foreach (array("frame_date",
            "bench_3",
            "bench_5",
            "frame_size",
            "MAC_dest",
            "MAC_src",
            "field_1",
            "field_2",
            "field_3",
            "field_4",
            "field_5",
            "field_6",
            "IP_src",
            "IP_dest",
            "field_9",
            "field_10",
            "field_11",
            "field_14",
            "field_16",
            "field_17",
            "field_18",
            "field_20",
            "field_21",
            "field_23",
            "field_25",
            "field_26",
            "field_27",
            "field_28",
            "field_29",
            "field_30",
            "field_32",
            "field_33",
            "field_34",
            "field_35",
            "packet_date",
            "msg_type") as $field_name)
        {
            echo "<td><label><input type='checkbox' name='field_names[]' value='$field_name'>$field_name</label></td>";

            if ((++$counter % 2) == 0)
            {
                echo "</tr><tr>";
            }
        }
    }
?>
</tr>
</table>
</div>
    <div class="flex">
        <h1>Brut :</h1>
        <input name='brut' require>

        <h1>Label :</h1>
        <input name='label' require>
    </div>
    <button type="submit">Apply Changes</button>
</form>
</div>
<?php

    foreach (array("frame_date",
        "bench_3",
        "bench_5",
        "frame_size",
        "MAC_dest",
        "MAC_src",
        "field_1",
        "field_2",
        "field_3",
        "field_4",
        "field_5",
        "field_6",
        "IP_src",
        "IP_dest",
        "field_9",
        "field_10",
        "field_11",
        "field_14",
        "field_16",
        "field_17",
        "field_18",
        "field_20",
        "field_21",
        "field_23",
        "field_25",
        "field_26",
        "field_27",
        "field_28",
        "field_29",
        "field_30",
        "field_32",
        "field_33",
        "field_34",
        "field_35",
        "packet_date",
        "msg_type") as $field_name)
    {
        if (in_array($field_name, $_POST["field_names"]))
        {
            $explorer->run_sql_query("DELETE FROM transfert_functions WHERE field_name = '$field_name'");
            
            $explorer->run_sql_query("INSERT INTO transfert_functions ('field_name', 'brut', 'label') 
                VALUES (:field_name, :brut, :label)", 
                array(
                    ":field_name" => $field_name,
                    ":brut" => isset($_POST["brut"]) ? $_POST["brut"] : "",
                    ":label" => isset($_POST["label"]) ? $_POST["label"] : ""
                ));
       }
    }

    require("footer.php");
?>
