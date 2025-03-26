<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["newfile"]["name"]);
$upload = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["newfile"]["tmp_name"]);


  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $upload = 1;
    
  } else {
    echo "File is not an image.";
    $upload = 0;
  }
}


if (file_exists($target_file)) {
  echo "File already exists.";
  $upload = 0;
}


if ($_FILES["newfile"]["size"] > 500000) {
  echo "Your file is too large.";
  $upload = 0;
}


if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  echo "Only JPG, JPEG, PNG & GIF files are allowed.";
  $upload = 0;
}


if ($upload == 0) {
  echo "Your file was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["newfile"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars(basename($_FILES["newfile"]["name"])) /*. " has been uploaded."*/ . header("Location:./Welcome.html");;
  } else {
    echo "Your file is not uploading.";
  }
}
