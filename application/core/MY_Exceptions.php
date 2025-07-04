<?php

class MY_Exceptions extends CI_Exceptions {
    function show_error($heading, $messages, $template = 'error_general', $status_code = '500') {
        log_message('debug', print_r($messages, true));
        throw new Exception(is_array($messages) ? $messages[1] : $messages, $status_code);
    }
}
