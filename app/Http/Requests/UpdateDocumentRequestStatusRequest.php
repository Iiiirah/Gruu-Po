<?php

namespace App\Http\Requests;

use App\Models\DocumentRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDocumentRequestStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', Rule::in(DocumentRequest::STATUSES)],
            'remarks' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
