<?php
    $tables['users'] = array(
        'models' => array('username', 'name', 'phone', 'email', 'image', 'password'),
        'titles' => array('Username', 'Name', 'Phone', 'Email', 'Picture', 'Password'),
        'filters' => array('username', 'name', 'phone', 'email'),
        'types' => array(
            'email' => 'email',
            'image' => 'image',
            'password' => 'password'
        ),
        'isEdit' => true,
        'isTrash' => true,
    );