<?php
    session_start();

    function setFlash($message, $type){
        $_SESSION['msg'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    function flash(){
        if (isset($_SESSION['msg'])) {
            echo '<div class="alert alert-'.$_SESSION['msg']['type'].' alert-dismissible text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            '.$_SESSION['msg']['message'].'
        </div>';
        }
        unset($_SESSION['msg']);
    }

    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else{
            return false;
        }
    }