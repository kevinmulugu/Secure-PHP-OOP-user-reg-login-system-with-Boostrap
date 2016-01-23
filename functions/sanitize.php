<?php

//function to sanitize input to and from DB
function escape ($string) {

	return htmlentities($string, ENT_QUOTES, 'UTF-8');
	
}

function clean($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>