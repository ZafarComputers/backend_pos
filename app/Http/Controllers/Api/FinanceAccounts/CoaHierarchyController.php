<?php

namespace App\Http\Controllers\Api\FinanceAccounts;

use App\Http\Controllers\Controller;
use App\Models\CoaMain;
use Illuminate\Http\JsonResponse;

class CoaHierarchyController extends Controller
{
    /**
     * Return full Chart of Accounts hierarchy:
     * CoaMain → CoaSub → Coa
     */
    public function index(): JsonResponse
    {
        $data = CoaMain::with('coaSubs.coas')->get();

        $hierarchy = $data->map(function ($main) {
            return [
                'main_id'   => $main->id,
                'main_code' => $main->code,
                'main_title'=> $main->title,
                'type'      => $main->type,
                'status'    => $main->status,
                'subs'      => $main->coaSubs->map(function ($sub) {
                    return [
                        'sub_id'     => $sub->id,
                        'sub_code'   => $sub->code,
                        'sub_title'  => $sub->title,
                        'type'       => $sub->type,
                        'status'     => $sub->status,
                        'accounts'   => $sub->coas->map(function ($coa) {
                            return [
                                'coa_id'    => $coa->id,
                                'coa_code'  => $coa->code,
                                'coa_title' => $coa->title,
                                'type'      => $coa->type,
                                'status'    => $coa->status,
                            ];
                        }),
                    ];
                }),
            ];
        });

        return response()->json([
            'status'  => true,
            'message' => 'COA hierarchy fetched successfully.',
            'data'    => $hierarchy,
        ]);
    }
}
