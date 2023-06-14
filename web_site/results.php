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
        Exit if no test id was sent.
    */
    if (! isset($_GET["id"]))
    {
        exit();
    }

    /*
        Displays an error if the test id doesn't exist.
    */
    if (count($explorer->run_sql_query("SELECT id FROM tests WHERE id = :test_id", array(":test_id" => $_GET["id"]))) == 0)
    {
        $explorer->display_error("The given test id doesn't exist");
        exit();
    }
 
    /* 
        Displays the table headers.
    */
    $limit = (isset($_GET["limit"]) && is_numeric($_GET["limit"])) ? (int) $_GET["limit"] : 15;
    $page = (isset($_GET["limit"]) && is_numeric($_GET["page"])) ? (int) $_GET["page"] : 1;
    
    $offset = ($page - 1) * $limit;

    $frame_nbr = $explorer->run_sql_query("SELECT COUNT(*) as total 
        FROM frames 
        WHERE test_id = :test_id", array(":test_id" => $_GET["id"]))[0]["total"];
    
    $page_nbr = ceil($frame_nbr / $limit);

    $test_name = $explorer->run_sql_query("SELECT name FROM tests WHERE id = :test_id", array(":test_id" => $_GET["id"]))[0]["name"];
    
    echo "<h2>[ Test: $test_name / Page: $page of $page_nbr / Frames: $frame_nbr ] (Hexa Values)</h2>";
	echo "<div class=\"flex_button\">";
    /*
        Previous/Next button.
    */
    if ($page >= 2)
    {
        echo "<a class=\"switch_page\" href=\"?id=" . $_GET["id"] . "&limit=$limit&page=" . ($page - 1) ."\">Previous</a> ";
    }

    if ($page < $page_nbr)
    {
        echo "<a class=\"switch_page\" href=\"?id=" . $_GET["id"] . "&limit=$limit&page=" . ($page + 1) . "\">Next</a>";
    }


?>
</div>
 <div class="tab_container">
        <form action="update_field_names.php" id="update_field_names" method="POST">       
        <table>
        <thead>
            <tr>
                <th>ID</th>
<?php
    /*
        Displays the headers.
    */
    try 
    {
        foreach ($explorer->run_sql_query("SELECT old, new FROM field_names") as $field)
        {
            echo "<th><input name=\"" . $field['old'] . "\" value=\"";
            
            if ($field["new"] == "")
            {   
                echo htmlspecialchars($field['old'], ENT_QUOTES, 'UTF-8');
            }
            else
            {
                echo htmlspecialchars($field['new'], ENT_QUOTES, 'UTF-8');
            }
        
            echo "\"></th>";
        }
    } 
    catch (\Throwable $th) 
    {
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
            echo "<th><input name=\"$field_name\" value=\"$field_name\"></th>";
        }
    }
    
    echo "</tr>
        </thead>";

    $frame_id = $offset + 1;

    /* 
        Displays the frames.
    */
    foreach ($explorer->run_sql_query("SELECT * FROM frames 
        WHERE test_id = :test_id
        LIMIT :offset, :limit", array(":test_id" => $_GET["id"], ":offset" => $offset, ":limit" => $limit)) as $item)
    {
        echo "<tr>";

        echo "<td>$frame_id</td>";
        
        foreach ($item as $field_name => $value)
        {
            if (! in_array($field_name, array("test_id")))
            {
                echo "<td>$value";
                
                try 
                {
                    $transfert_functions = $explorer->run_sql_query("SELECT brut, label FROM transfert_functions WHERE field_name = '$field_name'");
               
                    if (count($transfert_functions) == 1)
                    {
                        if ($transfert_functions[0]["brut"] === $value)
                        {
                            echo " (" . $transfert_functions[0]["label"] . ")";
                        } 
                    }
                } 
                catch (\Throwable $th) 
                {
                    ;
                }

                echo "</td>";
            }
        }
        
        echo "</tr>";

        $frame_id++;
    }
?>   
</table>
        
</form>
</div>
<a class="switch_page" href="transfert_functions.php">Transfert Functions</a>
</div>
        <script>
            document.getElementById('update_field_names').addEventListener('keypress', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault()
                document.getElementById('update_field_names').submit();
            }
            });
        </script>
<?php     
    require("footer.php");
?>
