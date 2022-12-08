<?php
namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    const RELATIONS = [];
    
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getWithSameNameAndEmail($name)
    {
        $first = $this->model->where('name', $name);
        return $this->model->where('email',$name)->union($first)->get();
    }
}
