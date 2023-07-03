<?php

declare(strict_types=1);


use App\Repositories\UserRepository;
use Impl\UserRepositoryImpl;

return [
    UserRepository::class => UserRepositoryImpl::class,
];
