<?php

class PermissionRepository
{
    public function getAll()
    {
        return Permission::all();
    }
}
