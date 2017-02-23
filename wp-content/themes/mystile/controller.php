<?php

if( isset($_POST['requestType']) ) {

    if( $_POST['requestType'] == 'revision' ) {
        echo 'revision';
    }

    if( $_POST['requestType'] == 'register' ) {
        echo 'registro';
    }

    print_r($_POST);
    return;
}

?>