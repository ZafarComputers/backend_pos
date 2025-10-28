<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PosExtraResource;
use App\Models\PosExtra;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PosExtraApiController extends Controller
{
    // GET /api/pos-extras
    public function index()
    {
        // $extras = PosExtra::with('pos')->paginate(20);
        $extras = PosExtra::with('pos')->get();
        return PosExtraResource::collection($extras);
    }

    // GET /api/pos-extras/{id}
    public function show(PosExtra $posExtra)
    {
        $posExtra->load('pos');
        return new PosExtraResource($posExtra);
    }

    // POST /api/pos-extras
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pos_id' => 'required|exists:pos,id',
            'title'  => 'required|string|max:255',
            'value'  => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $extra = PosExtra::create($validated);

        return (new PosExtraResource($extra))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    // PUT/PATCH /api/pos-extras/{id}
    public function update(Request $request, PosExtra $posExtra)
    {
        $validated = $request->validate([
            'pos_id' => 'sometimes|exists:pos,id',
            'title'  => 'sometimes|string|max:255',
            'value'  => 'nullable|string|max:255',
            'amount' => 'sometimes|numeric|min:0',
        ]);

        $posExtra->update($validated);

        return new PosExtraResource($posExtra);
    }

    // DELETE /api/pos-extras/{id}
    public function destroy(PosExtra $posExtra)
    {
        $posExtra->delete();

        return response()->noContent();
    }
}