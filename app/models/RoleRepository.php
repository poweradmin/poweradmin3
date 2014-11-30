<?php

class RoleRepository
{
    public function getAll()
    {
        $roles = Role::all();

        return $roles;
    }
}
