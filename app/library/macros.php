<?php

/**
 * Display Error / Success / Warn / Info messages / Help
 *
 * These messages are set using Session::flash(<message_type>, <message>);
 */
HTML::macro("notifications", function($errors = null, $template = 'partials.notifications') {
    $views =  '';
    $alert_types = array(
        "error" => 'notifications.title.error',
        "warning" => 'notifications.title.warning',
        "success" => 'notifications.title.success',
        "info" => 'notifications.title.info',
        "help" => 'notifications.title.help'
    );


    foreach ($alert_types as $type => $label) {
        $messages = array();
        if(Session::has($type)) {
            $flash = Session::get($type);
            $messages = is_array($flash) ? $flash : array($flash);
        }
        if ($errors != null and $type == 'error' and $errors->any()) {
            $messages = array_merge($messages, $errors->all());
        }

        if(!empty($messages)) {
            $views = View::make($template, array('type' => $type, 'label' => Lang::get($label), 'messages' => $messages));
        }
    }
    return empty($views) ? null : $views;
});