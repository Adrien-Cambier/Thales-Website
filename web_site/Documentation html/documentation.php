<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../thales.css">
	<title>Documentation</title>
</head>
<body>
<header>
<h1><a href="../index.html">Thales</a></h1>
<img class="hamburger_menu" src="../picture/menu.png">
</header>
<ul>
    <img class="close" src="../picture/close.png">
    <li><a href="../index.html"><h1>Home</h1></a></li>
    <li><a href="../explorer_page.php"><h1>Explorer</h1></a></li>
    <li><a href="../transfert_functions.php"><h1>Transfert Functions</h1></a></li>
    <li><a href="../Documentation html/documentation.php"><h1 class="hover">Documentation</h1></a></li>
</ul>
<div class="center">
    <h1>Documentation</h1>
    <section></section>
	<div class="square_container">
        <div class="white_square">
            <h1>INTRODUCTION</h1>
            <p>Few words to describe our product and in which approach</p>
        </div> 		
		<div class="white_square">
            <h1>THE EXTRACTOR</h1>
            <p>Some explainations of how works the python extractor with a visualisaton of the code.</p>
        </div>
        <div class="white_square">
            <h1>THE WEBSITE</h1>
            <p>A guide to introduce you how is built our web interface and where you can find what you're looking for.</p>
        </div>
        <div class="white_square">
            <h1>ALL NEEDED CONTENTS</h1>
            <p>These are all the contents that we needed to realize this product.</p>
        </div>
    </div>
	<h1 class="title">Introduction</h1>
    <section></section>
	<div class="presentation_container">
        <div class="presentation">
            <img src="https://www.syrlinks.com/images/medias/thumbs/1200xauto_logo-tas_AERO20190522142504.jpg">
            <div class="text_container">
                <h1>The utility and the target customers</h1>
                <p>This project was carried out as part of a university project for the Sophia Antipolis Institute of Technology, in collaboration with Thales Alenia Space.<br>
				Our solution involves reading a binary frame, deciphering it using a Python extractor, sending it to a database and displaying the database on a web interface specially designed to display the requested records.
            </p>
            </div>
        </div>
    </div>
	<h1 class="title">The Extractor</h1>
    <section></section>
	<div class="presentation_container">
	<div class="code_container">
		<div class="top_code">
		<h2>Extractor.py | 12.1 KB</h2>
		</div>
		<div class="bottom_code">
		<p>
		<?php
		$fichier = fopen("../../extractor/extractor.py", "r");
		if ($fichier) {
		while (($ligne = fgets($fichier)) !== false) {
    	echo $ligne . "<br>";
		}
		fclose($fichier);
		} else {
		echo "Impossible d'ouvrir le fichier.";
		}
		?>
		</p>
		</div>
	</div>
	</div>
	<div class="text_explanation">
	<p>This code represents an Ethernet frame extractor from a binary file. It extracts Ethernet frames from the file, performs certain transformations on the extracted data, and adds them to an SQL database.
	<br><br>
	The code is divided into several parts:
	<br><br>
    Module Imports: The code begins by importing various necessary modules such as frame (a custom module), sql (an SQL database management module), argparse (a module for command-line argument parsing), os, sys, termcolor (a module for console output coloring), bitstring (a module for bit manipulation), macaddress (a module for MAC address manipulation), and datetime (a module for date and time manipulation).
	<br><br>
    - Extractor Class: This class represents the extractor itself. It contains several methods to perform the extraction of Ethernet frames from the binary file and add them to the SQL database.
	<br><br>
    - __init__() Method: The constructor of the class initializes the instance variables.
	<br><br>
    - run() Method: This method executes the extractor. It calls other methods to parse the command-line arguments, extract frames from the binary file, and add them to the database.
	<br><br>
    - parse_cmd_line_args() Method: This method parses the command-line arguments provided when running the program. It uses the argparse module to parse and validate the arguments.
	<br><br>
    - extract_frames_from_file_and_add_them_to_db() Method: This method extracts frames from the binary file and adds them to the database. It uses the bitstring module to read bits from the binary file and the Frame class (defined elsewhere) to store frame information.
	<br><br>
    - insert_frames_into_db() Method: This method adds the extracted frames to the SQL database using the sql module.
	<br><br>
    - calculate_frame_date(), calculate_packet_date(), calculate_msg_type(), calculate_MACs_and_IPs() Methods: These methods perform calculations and transformations on the extracted values from the Ethernet frames to make them more readable.
	<br><br>
    - find_test_name_and_execution_date() Method: This method searches for the test name and execution date from the command-line arguments or a report file and adds them to the corresponding fields of the current frame.
	<br><br>
    - Frame Class: This class represents an Ethernet frame. It contains fields to store specific frame information such as source and destination MAC addresses, source and destination IP addresses, frame date, packet date, message type, etc.
	<br><br>
    - Main Code: The main code creates an instance of the Extractor class and calls its run() method to execute the extractor.
	<br><br>
	The code is used to extract Ethernet frames from a binary file, perform transformations on the extracted data, and store it in an SQL database. It can be used as a foundation to develop additional features such as Ethernet frame analysis, report generation, etc.</p>
	</div>
	<div class="presentation_container">
	<div class="code_container">
		<div class="top_code">
		<h2>Frame.py | 3.3 KB</h2>
		</div>
		<div class="bottom_code">
		<p>
		<?php
		$fichier = fopen("../../extractor/frame.py", "r");
		if ($fichier) {
		while (($ligne = fgets($fichier)) !== false) {
    	echo $ligne . "<br>";
		}
		fclose($fichier);
		} else {
		echo "Impossible d'ouvrir le fichier.";
		}
		?>
		</p>
		</div>
	</div>
	</div>
	<div class="text_explanation">
	<p>The Frame class represents an Ethernet frame and contains the specific information about that frame. This class is used in the context of an Ethernet frame extractor from a binary file. Here is a detailed explanation of this class:
	<br><br>
	Class attributes:
	<br><br>
    - HEADER_SIZE_IN_BYTES: The size of the frame header in bytes (28 bytes).<br>
    - NBR_OF_BYTES_BEFORE_MSG: The number of bytes before the message in the frame (90 bytes).
	<br><br>
	- __init__() method:
	The constructor of the class initializes the instance variables of each Frame instance.
	<br><br>
	Attributes of each instance:
	<br><br>
    - fields: A dictionary representing the different fields of the Ethernet frame with their information. Each field is defined by its name, the number of bits it occupies, its current value, and an optional indication of its usefulness.
    - message_type: The message type associated with the frame.
    - packet_date: The packet date associated with the frame.
    - test_name: The test name associated with the frame.
    - test_execution_date: The test execution date associated with the frame.
	<br><br>
	The fields dictionary contains different fields with their properties. Each field is identified by a key corresponding to its name. The properties associated with each field are:
	<br><br>
    - "bits": The number of bits occupied by the field.
    - "value": The current value of the field.
    - "useless": An optional indication to indicate if the field is useless in the current context.
	<br><br>
	This class is used in the context of an Ethernet frame extractor to store the extracted information from each frame. Each Frame instance represents a frame with its specific information, such as source and destination MAC addresses, source and destination IP addresses, frame date, message type, etc.
	<br><br>
	These pieces of information can be used to perform calculations, transformations, or further analysis on the Ethernet frames extracted from a binary file. The Frame class provides an organized structure to store this information and facilitates access and manipulation of it.
	<br><br>
	This class can be extended or adapted based on the specific needs of the project or application in which it is used.</p>
	</div>
	<div class="presentation_container">
	<div class="code_container">
		<div class="top_code">
		<h2>Sql.py | 5.95 KB</h2>
		</div>
		<div class="bottom_code">
		<p>
		<?php
		$fichier = fopen("../../extractor/sql.py", "r");
		if ($fichier) {
		while (($ligne = fgets($fichier)) !== false) {
    	echo $ligne . "<br>";
		}
		fclose($fichier);
		} else {
		echo "Impossible d'ouvrir le fichier.";
		}
		?>
		</p>
		</div>
	</div>
	</div>
	<div class="text_explanation">
	<p>The SQL class facilitates interactions with a SQL database. It is used to create, open, and interact with a SQLite database.
	<br><br>
	Here is a detailed explanation of this class:
	<br><br>
	Class attributes:
	<br><br>
    - TESTS_TABLE_NAME: The name of the table for tests.<br>
    - TESTS_TABLE_STRUCT: The structure of the tests table, specifying the columns (id, name, execution_date) and their data types.<br>
    - FRAMES_TABLE_NAME: The name of the table for frames.<br>
    - FRAMES_TABLE_STRUCT: The structure of the frames table, specifying the columns corresponding to Ethernet frame fields and their data types.
	<br><br>
	- __init__() method:
	The constructor of the SQL class initializes the instance variables. It takes the path to the SQLite database as a parameter. By default, it is set to use a database file named "db.sql" located in the parent directory.
	<br><br>
	- __del__() method:
	The destructor of the SQL class closes the database connection when an SQL object is deleted.
	<br><br>
	- open_db() method:
	This method opens the database and creates the necessary tables if they don't already exist. It returns True on success and False on error.
	<br><br>
	- execute_query(query: str) -> bool method:
	This method facilitates the execution of SQL queries. It takes a SQL query as a string parameter and submits it to the database via the cursor. It returns True on success and False on error.
	<br><br>
	- insert_frame(frame: frame.Frame) -> bool method:
	This method inserts a frame into the "frames" table of the database. It first checks if the associated test already exists in the "tests" table. If the test doesn't exist, it creates a new entry in the "tests" table for that test. Then, it inserts the frame into the "frames" table using the values of the frame fields.
	<br><br>
	This class is used in the context of an Ethernet frame extractor to store extracted frames in a database. The SQL class facilitates the creation of the database, insertion of new frames, and execution of queries on the database.
	<br><br>
	It's important to note that this class uses the sqlite3 module to interact with SQLite. Make sure you have the sqlite3 module installed to use this class correctly.
	<br><br>
	This class can be extended or adapted based on the specific needs of the project or application in which it is used.</p>
	</div>
	<h1 class="title">All Needed Contents</h1>
    <section></section>
	<div class="presentation_container">
        <div class="presentation">
            <img src="https://logowik.com/content/uploads/images/python.jpg">
            <div class="text_container">
                <h1>Python Programming Language - Simplicity and Power Combined</h1>
                <p>Python is a dynamic, high-level programming language renowned for its simplicity, readability, and versatility. With its elegant syntax and extensive standard library, Python empowers developers to create robust and efficient solutions for various domains. Whether you're a beginner or an experienced programmer, Python offers a friendly and productive environment for building everything from simple scripts to complex applications.
            </p>
            </div>
        </div>
    </div>
	<div class="presentation_container">
        <div class="presentation">
            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/Sql_data_base_with_logo.png">
            <div class="text_container">
                <h1>The Language for Efficient Database Management</h1>
                <p>SQL (Structured Query Language) is a powerful and standardized language designed for managing and manipulating relational databases. With SQL, developers and data professionals can efficiently store, retrieve, modify, and analyze data stored in databases. It serves as the backbone of modern data-driven applications and plays a crucial role in data management and analysis.
            </p>
            </div>
        </div>
    </div>
	<div class="presentation_container">
        <div class="presentation">
            <img src="https://1.bp.blogspot.com/-TDlxyhiJu9c/X-1LpOwT8wI/AAAAAAAAlMM/JJ6Dg9nSxJ08Isren0ScOpeLiwx-uMJRgCLcBGAsYHQ/w1200-h630-p-k-no-nu/free%2BHTML%2BCSS%2Band%2BJavaScript%2Bcourse%2BUdemy.webp">
            <div class="text_container">
                <h1> HTML, CSS, and JavaScript for Web Development</h1>
                <p>In the world of web development, three essential languages play a crucial role in creating visually appealing and interactive websites: HTML, CSS, and JavaScript. Each language serves a unique purpose and works harmoniously to bring websites to life. Let's take a closer look at these languages and understand their significance in web development.
            </p>
            </div>
        </div>
    </div>
	<div class="presentation_container">
        <div class="presentation">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1200px-PHP-logo.svg.png">
            <div class="text_container">
                <h1>PHP - Empowering Dynamic Web Applications</h1>
                <p>PHP (Hypertext Preprocessor) is a powerful server-side scripting language widely used for web development. It allows developers to create dynamic and interactive websites by embedding PHP code within HTML. With its extensive features and broad community support, PHP has become one of the most popular languages for web programming.
            </p>
            </div>
        </div>
    </div>
</div>
</body>
<footer>
    <p>Copyright © 2023 All right reserved - Adrien Cambier - Jeremy Gardas - Evan Valerino
</footer>
<script src="../thales.js"></script>
</html>
