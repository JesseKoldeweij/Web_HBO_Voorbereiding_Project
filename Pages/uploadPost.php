<?php
//function to upload the movie to the database
function uploadPost()
{
    global $con;

    $title = $_POST['title'];
    $content = $_POST['content'];
    $values = array();

    $target_dir = "uploads/";
    $target_file = $target_dir . $_FILES["image"]["name"];
    $baseEncode = base64_encode($target_file);
// Select file type
    $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Valid file extensions
    $extensions_arr = array("jpeg", "jpg", "png");
// Check extension
    if (in_array($FileType, $extensions_arr)) {
// Upload
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
// Insert record
            $query = "INSERT INTO post(title,content,image) VALUES ('$title','$content','$baseEncode')";
            $stmt = $con->prepare($query);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $output = json_encode($result);

        } else {
            echo "Someting went wrong";
        }
    } else {
        echo "No jpeg, jpg of png";
    }
}

//if submit is clicked use function
if (isset($_POST['submit'])) {
    uploadPost();
}
?>