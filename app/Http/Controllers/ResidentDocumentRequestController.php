<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResidentDocumentRequest;

class ResidentDocumentRequestController extends Controller
{
    public function index()
    {
        $requests = ResidentDocumentRequest::latest()->get();
        return view('resident-document-request', compact('requests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required|string',
            'purpose' => 'required|string',
        ]);

        $count = ResidentDocumentRequest::count() + 1;
        $referenceNo = 'REQ-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        ResidentDocumentRequest::create([
            'reference_no' => $referenceNo,
            'document_type' => $request->document_type,
            'purpose' => $request->purpose,
            'status' => 'In Progress',
        ]);

        return redirect()->back()->with('success', 'Document request submitted successfully.');
    }

public function update(Request $request, $id)
{
    $docRequest = ResidentDocumentRequest::findOrFail($id);
    
    if ($docRequest->status === 'Received') {
        return redirect()->back()->with('error', 'Received requests cannot be edited.');
    }

    $docRequest->update([
        'document_type' => $request->document_type,
        'purpose' => $request->purpose,
    ]);

    return redirect()->back()->with('success', 'Document request updated successfully.');
}
    public function destroy($id)
    {
        $docRequest = ResidentDocumentRequest::findOrFail($id);

        /* if ($docRequest->status === 'Received') {
            return redirect()->back()->with('error', 'Received requests cannot be cancelled.');
        } */

        $docRequest->delete();

        return redirect()->back()->with('success', 'Document request removed successfully.');
    }
}