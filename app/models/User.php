<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;
    use HasRole;

    /*
     * User statuses
     */
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
}
