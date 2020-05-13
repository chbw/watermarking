<?php
// SOURCE + DESTINATION
$source = $_FILES["file-upload"]["tmp_name"];
$destination = $_FILES["file-upload"]["name"];
$error = "";

// ALLOWED FILE EXTENSIONS
if ($error == "") {
  $allowed = ["pdf"];
  $ext = strtolower(pathinfo($_FILES["file-upload"]["name"], PATHINFO_EXTENSION));
  if (!in_array($ext, $allowed)) {
    $error = "$ext file type not allowed - " . $_FILES["file-upload"]["name"];
  }
}

// FILE SIZE CHECK
if ($error == "") {
  // 1,000,000 = 1MB
  if ($_FILES["file-upload"]["size"] > 50000000) {
    $error = $_FILES["file-upload"]["name"] . " - file size too big!";
  }
}

// ALL CHECKS OK - WATERMARK FILE
if ($error == "") {
  passthru("./mark.sh $source | base64");
}

?>
