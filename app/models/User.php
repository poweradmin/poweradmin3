<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;

class User extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;

    /*
     * User statuses
     */
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
}
