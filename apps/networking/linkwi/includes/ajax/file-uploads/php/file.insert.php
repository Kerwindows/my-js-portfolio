<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require('../../../../../includes/linkwi.php');

if ($_POST['linkFilesCount'] <= 2 || $_POST['rle'] == 1) {

    $userid         = custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV);
    $cl_name        = clean(sanitize($_POST["filename"]));


    if ((is_null($_FILES['fileupload']['name'])) || ($_FILES['fileupload']['name'] == "")) {

        echo json_encode(["error" => "Please attach a file first"]);
        exit();
    } else {
        $raw_file        = $_FILES['fileupload']['name'];
        $FileType         = pathinfo($raw_file, PATHINFO_EXTENSION);

        if ($_FILES['fileupload']['size'] > 8000000) {
            echo json_encode(["error" => "The file attached is too large"]);
            exit();
        }

        //Check file type
        if (
            $FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "docx" && $FileType != "pdf"
            && $FileType != "gif" && $FileType != "csv"  && $FileType != "xls" && $FileType != "xlsx" && $FileType != "zip" && $FileType != "rar"  && $FileType != "txt"
        ) {
            echo json_encode(["error" => "Sorry , this file type is not allowed"]);
            exit();
        }
        switch ($FileType) {
            case "docx":
                $cl_icon = "fa fa-file-word-o";
                break;
            case "xls":
                $cl_icon = "fa fa-file-excel-o";
                break;
            case "xlsx":
                $cl_icon = "fa fa-file-excel-o";
                break;
            case "csv":
                $cl_icon = "fa fa-file-excel-o";
                break;
            case "pdf":
                $cl_icon = "fa fa-file-pdf-o";
                break;
            case "zip":
                $cl_icon = "fa fa-file-archive-o";
                break;
            case "rar":
                $cl_icon = "fa fa-file-archive-o";
                break;
            case "txt":
                $cl_icon = "fa fa-file-text-o";
                break;
            default:
                $cl_icon = "far fa-fw fa-image";
        }



        $new_file         = sanitize_upload_filename($raw_file);
        $new_file         =

            basename($new_file, $FileType) . $FileType;
        $cl_file         =
            str_replace(' ', '-', strtolower($new_file));

        $temp_folder     = $_FILES['fileupload']['tmp_name'];
        $folder         = LINKWI_FILES_PATH . "/";

        move_uploaded_file($temp_folder, $folder . $cl_file);

        $db         = new dbase;
        $db->query("INSERT INTO `User_Files` (`UniqueID`, `icons`, `files`, `name`) VALUES (:userid, :icon, :file, :name)");
        $db->bind(':userid', $userid, PDO::PARAM_STR);
        $db->bind(':icon', $cl_icon, PDO::PARAM_STR);
        $db->bind(':file', $cl_file, PDO::PARAM_STR);
        $db->bind(':name', $cl_name, PDO::PARAM_STR);

        $run         = $db->execute();
        if ($run) {
            echo json_encode(["error" => ""]);
        } else {
            echo json_encode(["error" => "Error uploading file"]);
            exit();
        }
    }
    exit();
} else {
    echo json_encode(["error" => "Cannot add anymore files"]);
}
}