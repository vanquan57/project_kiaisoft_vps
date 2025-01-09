<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminDashboardSearchRequest;
use App\Http\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Constructor
     *
     * @param DashboardService $dashboardService
     */
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    /**
     * Get data for dashboard
     * 
     * @param AdminDashboardSearchRequest $request
     *
     * @return JsonResponse
     */
    public function getDataDashboard(AdminDashboardSearchRequest $request): JsonResponse
    {
        $result  = [];

        if($topUsers = $this->dashboardService->getTopUsersMostOder($request->validated())) {
            $result['topUsers'] = $topUsers;
        }

        if($topBooks = $this->dashboardService->getTopBooksMostPopular($request->validated())) {
            $result['topBooks'] = $topBooks;
        }

        if($totalOrders = $this->dashboardService->getTotalOrdersByMonth()) {
            $result['totalOrders'] = $totalOrders;
        }

        if($totalBooksInCategories = $this->dashboardService->getTotalBooksInCategories()) {
            $result['totalBooksInCategories'] = $totalBooksInCategories;
        }

        if($topMostLikesBook = $this->dashboardService->getTopMostLikesBook($request->validated())) {
            $result['topMostLikesBook'] = $topMostLikesBook;
        }

        return response()->json($result);
    }
}
