<?php

namespace Udhuong\LaravelCommon\Domain\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Laravel\Octane\Exceptions\DdException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Udhuong\LaravelCommon\Presentation\Http\Response\Responder;

class ApiExceptionHandler
{
    /**
     * @throws Throwable
     * @throws DdException
     */
    public static function handle(Throwable $exception): JsonResponse
    {
        if (!request()->is('api/*'))
        {
            throw $exception;
        }

        if ($exception instanceof AppException) {
            return Responder::fail($exception->getMessage());
        }

        if ($exception instanceof AuthenticationException) {
            return Responder::fail("Bạn chưa đăng nhập", null, Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'status' => false,
                'message' => current($exception->errors())[0],
                'errors' => $exception->errors(),
                'data' => null,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($exception instanceof NotFoundHttpException) {
            return Responder::fail('Không tìm thấy tài nguyên', null, Response::HTTP_NOT_FOUND);
        }

        return Responder::failWithException(
            $exception,
            'Có lỗi gì đó, liên hệ admin để được hỗ trợ',
            null,
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
