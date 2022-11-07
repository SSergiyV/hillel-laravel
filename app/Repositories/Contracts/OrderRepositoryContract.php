<?php

namespace App\Repositories\Contracts;

use App\Models\Order;

interface OrderRepositoryContract
{
    public function create(array $request, float $total): Order|bool;

    public function setTransaction(string $transactionOrderId, array $data): Order;
}
