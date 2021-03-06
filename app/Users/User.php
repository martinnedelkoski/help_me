<?php

namespace App\Users;

use App\Roles\Role;
use App\Topics\Comments\Comment;
use App\Topics\Topic;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticableInterface;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticableInterface
{
    use Authenticatable;

    protected $table = 'users';

    public function getId()
    {
        return $this->getAttribute('id');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getAttribute('name');
    }

    public function setName($name)
    {
        $this->setAttribute('name', $name);
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->getAttribute('surname');
    }

    public function setSurname($surname)
    {
        $this->setAttribute('surname', $surname);
    }

    public function getUsername()
    {
        return $this->getAttribute('username');
    }

    public function setUsername($username)
    {
        $this->setAttribute('username', $username);
    }

    public function setPassword($password)
    {
        $this->setAttribute('password', $password);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->getAttribute('email');
    }

    public function setEmail($email)
    {
        $this->setAttribute('email', $email);
    }

    /**
     * @return Carbon
     */
    public function getBirthday()
    {
        return $this->getAttribute('birthday');
    }

    public function setBirthday(Carbon $birthday)
    {
        $this->setAttribute('birthday', $birthday);
    }

    public function isActive()
    {
        return $this->getAttribute('is_active') == true;
    }

    public function markAsActive()
    {
        $this->setAttribute('is_active', true);
    }

    public function markAsNotActive()
    {
        $this->setAttribute('is_active', false);
    }

    public function getLastOnline()
    {
        $this->getAttribute('last_online');
    }

    public function setLastOnline(Carbon $lastOnline)
    {
        $this->setAttribute('last_online', $lastOnline);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    public function setRole(Role $role)
    {
        $this->role()->associate($role);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * @return Topic[]
     */
    public function getTopics()
    {
        return $this->topics;
    }

    public function isAdmin()
    {
        return (bool) ($this->getRole()->getName() == 'admin');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }
}
