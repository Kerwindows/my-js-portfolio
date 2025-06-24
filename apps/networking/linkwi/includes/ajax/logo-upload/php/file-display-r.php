<?php
include "../../../../../../includes/databaseconnect.php";

	$organization = $_POST['organization'];
	$period = $_POST['period'];
	$year = $_POST['year'];
	
	$display_file_uploads  = "SELECT * FROM agenda_files WHERE (organization = '$organization' AND duration = '$period' AND year = '$year') ORDER BY id";
	if ( count(fetchAll($display_file_uploads)) > 0) {  
	foreach (fetchAll($display_file_uploads) as $row_display_file_uploads) {  
	
			$id      	= $row_display_file_uploads['id'];
			$duration    	= $row_display_file_uploads['duration']; 
			$icon   	= $row_display_file_uploads['icon']; 
			$files       	= $row_display_file_uploads['files']; 
			
		echo "<li><a href='files/agenda-files/$files' download='$files' class='btn-link text-secondary'><i class='$icon'></i>$files</a></li>";
        	}
 	}