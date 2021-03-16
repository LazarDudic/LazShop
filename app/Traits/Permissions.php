<?php

namespace App\Traits;

trait Permissions
{
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->role->name == $role) {
                return true;
            }
        }

        return false;
    }

    public function hasPermission(string $permission)
    {
        return $this->role->permissions->contains('name', $permission);
    }

}
