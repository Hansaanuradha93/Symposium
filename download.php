<?php
    $file_name = 'Daily Record 23.09.2019.pdf';

    $file = ("files/$file_name");

    $file_type = filetype($file);

    $file_base_name = basename($file);

    echo $file_name.'<br>'.$file.'<br>'.$file_type.'<br>'.$file_base_name;

    header ("Content-Type: ".$file_type);

    header ("Content-Length: ".filesize($file));

    header ("Content-Disposition: attachment; filename=".$file_base_name);

    readfile($file);

?>