<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;


trait ResponseTrait
{
    public function successResponse($data, $statusCode = 200): JsonResponse
    {
        $response = [
            'message' => 'success',
            'data' => $data
        ];

        return new JsonResponse($response, $statusCode);
    }

    protected function successResponseCollection(ResourceCollection $resource, $message = 'Success', $statusCode = 200)
    {

        $resource = $this->apiResponse($resource);
        $resource->message = $message;
        return new JsonResponse($resource, $statusCode);
    }

    public function apiResponse(ResourceCollection $resource, $message = null)
    {
        return $resource->response()->getData();
    }


    public function errorResponse($errors = 'error', $message = 'Server Error', $statusCode = 500): JsonResponse
    {
        $data = [
            'message' => $message,
            'errors' => $errors,
        ];

        return new JsonResponse($data, $statusCode);
    }

    public function createdResponse($data): JsonResponse
    {
        $response = [
            'message' => 'success',
            'data' => $data
        ];
        return new JsonResponse($response, 201);
    }

    public function badRequestResponse($errors, $message = 'Bad Request'): JsonResponse
    {
        $data = [
            'message' => $message,
            'errors' => $errors,
        ];
        return new JsonResponse($data, 400);
    }

    public function unauthorizedResponse($errors = 'Unauthorized'): JsonResponse
    {
        $data = [
            'message' => 'Failure',
            'errors' => $errors,
        ];

        return new JsonResponse($data, 401);
    }

    public function forbiddenResponse($errors = 'Forbidden'): JsonResponse
    {
        $data = [
            'message' => 'Failure',
            'errors' => $errors,
        ];

        return new JsonResponse($data, 403);
    }

    public function notFoundResponse($errors = 'Not Found'): JsonResponse
    {
        $data = [
            'message' => 'Failure',
            'errors' => $errors,
        ];

        return new JsonResponse($data, 404);
    }

}
