<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use Illuminate\Support\Facades\Auth;

class DocumentRequestController extends Controller
{
    /**
     * ADMIN VIEW: Nakikita ang LAHAT ng requests mula sa lahat ng residente (Maria Juana, Juan Dela Cruz, etc.)
     */
    public function adminIndex()
    {
        $requests = DocumentRequest::with('user')->latest()->get();
        return view('documentsrequest', compact('requests'));
    }

    /**
     * RESIDENT VIEW: Nakikita lamang ng kasalukuyang naka-login na resident ang sarili niyang requests
     */
    public function residentIndex()
    {
        $requests = DocumentRequest::where('user_id', Auth::id())->latest()->get();
        return view('resident-document-request', compact('requests'));
    }

    /**
     * RESIDENT STORE: Kapag nag-submit ng bagong request ang residente
     */
    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required|string',
            'purpose' => 'nullable|string',
        ]);

        DocumentRequest::create([
            'user_id' => Auth::id(),
            'resident_name' => Auth::user()->name,
            'document_type' => $request->document_type,
            'purpose' => $request->purpose ?? 'General Purpose',
            'status' => 'In Progress', // O 'Received'
        ]);

        return redirect()->back()->with('success', 'Document request submitted successfully.');
    }

    /**
     * ADMIN UPDATE STATUS: Kapag binago ng Admin ang status (Approved, In Progress, Received)
     * Awtomatikong magba-bago rin ito sa paningin ng Residente!
     */
    public function updateStatus(Request $request, $id)
    {
        $docRequest = DocumentRequest::findOrFail($id);
        
        $request->validate([
            'status' => 'required|string',
        ]);

        $docRequest->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    /**
     * ADMIN / RESIDENT DELETE: Para sa pagbura ng request
     */
    public function destroy($id)
    {
        $docRequest = DocumentRequest::findOrFail($id);
        $docRequest->delete();

        return redirect()->back()->with('success', 'Document request deleted successfully.');
    }
}