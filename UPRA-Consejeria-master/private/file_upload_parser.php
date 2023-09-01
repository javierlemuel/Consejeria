<?php
$stdnt_recordName = $_stdnt_recordS["stdnt_record1"]["name"]; // The stdnt_record name
$stdnt_recordTmpLoc = $_stdnt_recordS["stdnt_record1"]["tmp_name"]; // stdnt_record in the PHP tmp folder
$stdnt_recordType = $_stdnt_recordS["stdnt_record1"]["type"]; // The type of stdnt_record it is
$stdnt_recordSize = $_stdnt_recordS["stdnt_record1"]["size"]; // stdnt_record size in bytes
$stdnt_recordErrorMsg = $_stdnt_recordS["stdnt_record1"]["error"]; // 0 for false... and 1 for true
if (!$stdnt_recordTmpLoc) { // if stdnt_record not chosen
    echo "ERROR: Please browse for a stdnt_record before clicking the upload button.";
    exit();
}
if(move_uploaded_stdnt_record($stdnt_recordTmpLoc, "../AdminUPRA/stdnt_record.txt")){
    //echo "$stdnt_recordName upload is complete";
    header('Location: ../AdminUPRA/inc/add_stdnt_record.php');
} else {
    echo "move_uploaded_stdnt_record function failed";
}
