<?php
    $tables['users'] = array(
        'models' => array('username', 'email'),
        'titles' => array('Username', 'Email'),
        'filters' => array('username', 'email'),
        'isEdit' => true,
        'isTrash' => true,
    );