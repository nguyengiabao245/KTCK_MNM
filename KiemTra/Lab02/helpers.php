<?php // IDEA:
    function GetNextUserID(){
        static $userID = 1;
        return $userID++;
    }
?>