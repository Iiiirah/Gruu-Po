<?php

namespace Tests\Feature;

use App\Models\DocumentRequest;
use App\Models\RequestStatusHistory;
use App\Models\User;
use App\Services\DocumentRequestStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use LogicException;
use Tests\TestCase;

class DocumentRequestStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_real_status_change_is_recorded_once_and_a_repeat_is_ignored(): void
    {
        [$documentRequest, $actor] = $this->makeRequestAndActor();
        $service = app(DocumentRequestStatusService::class);

        $this->assertTrue($service->changeStatus($documentRequest, $actor, 'approved', 'Verified'));
        $this->assertFalse($service->changeStatus($documentRequest, $actor, 'approved', 'Repeated'));

        $this->assertSame('approved', $documentRequest->fresh()->status);
        $this->assertDatabaseHas('request_status_history', [
            'request_id' => $documentRequest->getKey(),
            'changed_by' => $actor->getKey(),
            'old_status' => 'pending',
            'new_status' => 'approved',
            'remarks' => 'Verified',
        ]);
        $this->assertDatabaseCount('request_status_history', 1);
    }

    public function test_history_records_cannot_be_updated_or_deleted_through_eloquent(): void
    {
        [$documentRequest, $actor] = $this->makeRequestAndActor();
        app(DocumentRequestStatusService::class)->changeStatus($documentRequest, $actor, 'rejected');
        $history = RequestStatusHistory::query()->firstOrFail();

        try {
            $history->remarks = 'tampered';
            $history->save();
            $this->fail('Updating a history record should be rejected.');
        } catch (LogicException $exception) {
            $this->assertSame('Request status history records are immutable.', $exception->getMessage());
        }

        try {
            $history->delete();
            $this->fail('Deleting a history record should be rejected.');
        } catch (LogicException $exception) {
            $this->assertSame('Request status history records cannot be deleted.', $exception->getMessage());
        }
    }

    /** @return array{DocumentRequest, User} */
    private function makeRequestAndActor(): array
    {
        $roleId = DB::table('roles')->insertGetId(['role' => 'resident']);

        $actorId = DB::table('users')->insertGetId([
            'role_id' => $roleId,
            'name' => 'Resident Example',
            'email' => uniqid('resident', true).'@example.test',
            'password' => 'not-used-in-this-test',
            'user_account' => 'Resident Example',
            'account_status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $documentTypeId = DB::table('documment_type')->insertGetId([
            'name' => uniqid('certificate-', true),
            'description' => 'Test document',
            'fee' => '0.00',
            'is_active' => true,
            'created_at' => now(),
        ]);

        $requestId = DB::table('document_request')->insertGetId([
            'reference_number' => uniqid('REQ-', true),
            'resident_id' => $actorId,
            'document_type' => $documentTypeId,
            'status' => 'pending',
            'purpose' => 'Testing',
            'description_remarks' => '',
            'created_at' => now(),
            'requested_at' => now(),
        ]);

        return [
            DocumentRequest::query()->findOrFail($requestId),
            User::query()->findOrFail($actorId),
        ];
    }
}
