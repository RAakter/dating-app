<?php

namespace App\Repositories;

interface MutualRepositoryInterface
{
    public function update($action, $userId);
}
