<?php

namespace Ijdb\Controllers;

use \Ninja\DatabaseTable;

class Register
{
    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable) {
        $this->authorsTable = $authorsTable;
    }

    public function __registrationForm() {
        return ['template' => 'register.html.php', 'title' => 'Register an account'];
    }

    public function success() {
        return ['template' => 'registersuccess.html.php', 'title' => 'Registration Successful'];
    }

    
}
