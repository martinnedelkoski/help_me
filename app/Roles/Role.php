<?php

namespace App\Roles;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'privileges';

    public function getId()
    {
        return $this->getId();
    }

    public function getName()
    {
        return $this->getAttribute('name');
    }

    public function setName($name)
    {
        $this->setAttribute('name', $name);
    }

    public function isActive()
    {
        return $this->getAttribute('active') == true;
    }

    public function markAsActive()
    {
        $this->setAttribute('active', true);
    }

    public function markAsNotActive()
    {
        $this->setAttribute('active', false);
    }
}
