<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class studentResources extends JsonResource
{
    public $status;
    public $message;
    public $resource;
    public function __construct($resource, $status, $message)
    {
        $this->status = $status;
        $this->message = $message;
        parent::__construct($resource);
    }
    public function toArray($request)
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->resource,
        ];
    }
}
