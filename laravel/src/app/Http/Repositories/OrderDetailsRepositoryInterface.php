<?php

namespace App\Http\Repositories;

interface OrderDetailsRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Update status multiple book in order
     * 
     * @param array $IdsOverdueDetails
     * 
     * @return bool
    */
    public function updateStatusMultipleBookOverdueInOrder(array $IdsOverdueDetails): bool;
}
