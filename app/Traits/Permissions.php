<?php

namespace App\Traits;

trait Permissions
{
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->name == $role) {
                return true;
            }
        }

        return false;
    }

    public function hasPermission(string $permission)
    {
        return $this->roles->permissions->contains('name', $permission);
    }

}
