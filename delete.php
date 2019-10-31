<?php
require 'inc/functions.php';
include 'inc/header.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$selected= get_entry($id);

/*if(isset($_GET['id'])){
    list($id,$title,$date,$time_spent,$learned,$resources) = get_entry(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
}*/
    if(delete_entry($id)){
        header("location:index.php");
        exit;
    } else{
        echo 'Error deleting entry';
        exit;
    }
}
