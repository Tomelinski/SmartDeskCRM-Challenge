<?php  

    //redirect to new location
    function redirect($url){
        header("location:". $url);
        ob_flush();
    }


?>