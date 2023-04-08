<?php
    $tables['users'] = array(
        'models' => array('username', 'email', 'image', 'password'),
        'titles' => array('Username', 'Email', 'Picture', 'Password'),
        'filters' => array('username', 'email'),
        'types' => array(
            'email' => 'email',
            'image' => 'image',
            'password' => 'password'
        ),
        'isEdit' => true,
        'isTrash' => true,
    );