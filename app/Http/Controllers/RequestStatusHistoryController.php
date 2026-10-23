<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RequestStatusHistoryController extends Controller
{
    public function index(Request $request, DocumentRequest $documentRequest): JsonResponse
    {
        abort_unless(
            (int) $request->user()->getKey() === (int) $documentRequest->resident_id,
            403,
        );

        return response()->json(
            $documentRequest->statusHistory()->with('changedBy')->get(),
        );
    }
}
