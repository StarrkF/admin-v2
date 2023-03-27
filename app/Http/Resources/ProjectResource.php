<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'company_name' => $this->company->name,
            'company_address' => $this->company->address,
            'company_postcode' => $this->company->postcode,
            'company_country' => $this->company->country,
            'company_phone' => $this->company->phoneNumber,
            'company_email' => $this->company->companyEmail,
            'name' => $this->name,
            'detail' => $this->detail,
            'budget' => $this->budget,
            'status' => $this->status,
            'notes' => $this->notes,
        ];
    }
}
