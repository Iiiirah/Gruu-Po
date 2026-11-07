<?php

namespace App\Services;

use App\Models\DocumentRequest;
use App\Models\RequestStatusHistory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class DocumentRequestStatusService
{
    public function changeStatus(
        DocumentRequest $documentRequest,
        User $actor,
        string $newStatus,
        string $remarks = '',
    ): bool {
        if (! in_array($newStatus, DocumentRequest::STATUSES, true)) {
            throw new InvalidArgumentException('The requested document status is invalid.');
        }

        return DB::transaction(function () use ($documentRequest, $actor, $newStatus, $remarks): bool {
            $lockedRequest = DocumentRequest::query()
                ->lockForUpdate()
                ->findOrFail($documentRequest->getKey());

            $oldStatus = $lockedRequest->status;

            if ($oldStatus === $newStatus) {
                return false;
            }

            $now = now();
            $lockedRequest->status = $newStatus;
            $lockedRequest->updated_at = $now;

            if (in_array($newStatus, ['approved', 'rejected'], true)) {
                $lockedRequest->decided_by = $actor->getKey();
                $lockedRequest->decided_at = $now;
            }

            if ($newStatus === 'released') {
                $lockedRequest->released_at = $now;
            }

            $lockedRequest->save();

            RequestStatusHistory::query()->create([
                'request_id' => $lockedRequest->getKey(),
                'changed_by' => $actor->getKey(),
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'remarks' => $remarks,
                'changed_at' => $now,
            ]);

            return true;
        });
    }
}
