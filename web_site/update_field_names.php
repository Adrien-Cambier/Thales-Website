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
        Creates the "field_names" table.
    */
    $explorer->run_sql_query("CREATE TABLE IF NOT EXISTS field_names (
        old VARCHAR(50),
        new VARCHAR(50)
    )");

    $explorer->run_sql_query("DELETE FROM field_names");

    /*
        Inserts the new field names.
    */
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
        $explorer->run_sql_query("INSERT INTO field_names ('old', 'new') 
            VALUES ('$field_name', :new_name)", 
            array(":new_name" => (isset($_POST[$field_name]) && $_POST[$field_name] !== $field_name) ? $_POST[$field_name] : ""));
    }

    /*
        Go back to the previous page.
    */
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
?>
