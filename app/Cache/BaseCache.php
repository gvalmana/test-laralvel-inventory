<?php
namespace App\Cache;

use App\Contracts\BaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;

abstract class BaseCache implements BaseRepositoryInterface
{
    const TTL=84600;
    protected $repository;
    protected $key;
    protected $cache;
    
    public function __construct(Object $repository, string $key)
    {
        $this->repository = $repository;
        $this->key = $key;
        $this->cache = new Cache();
    }
    
    protected function forget(string $key)
    {
        $this->cache::forget($key);
    }
}