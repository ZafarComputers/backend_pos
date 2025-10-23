<?php

namespace App\Http\Controllers\Api\FinanceAccounts;

use App\Http\Controllers\Controller;
use App\Models\CoaMain;
use App\Http\Resources\FinanceAccount\CoaMainResource;
use Illuminate\Http\Request;

class CoaMainApiController extends Controller
{
    public function index(Request $request)
    {
        $query = CoaMain::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $query->with('coaSubs.coas');
        return CoaMainResource::collection($query->get());
    }

    public function show($id)
    {
        $main = CoaMain::with('coaSubs.coas')->findOrFail($id);
        return new CoaMainResource($main);
    }
}
