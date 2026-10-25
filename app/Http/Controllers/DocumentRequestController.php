<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest; // Siguraduhing naka-import ang Model mo

class DocumentRequestController extends Controller
{
    // 1. Ipakita ang listahan sa view
    public function index()
    {
        $requests = DocumentRequest::latest()->get();
        return view('documentsrequest', compact('requests'));
    }

    // 2. I-update ang status (Approved, In Progress, Received)
    public function update(Request $request, $id)
    {
        $docRequest = DocumentRequest::findOrFail($id);
        $docRequest->status = $request->input('status');
        $docRequest->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    // 3. Burahin ang row
    public function destroy($id)
    {
        $docRequest = DocumentRequest::findOrFail($id);
        $docRequest->delete();

        return redirect()->back()->with('success', 'Request deleted successfully.');
    }
}