<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (!$request->wantsJson()) {
            return parent::render($request, $exception);
        }

        if ($exception instanceof NotFoundHttpException) {
            return \response()->json([
                'data' => [
                    'message' => 'Không tồn tại URL này trên máy chủ.'
                ]
            ], 404);
        }

        if ($this->isHttpException($exception)) {
            switch (true) {
                case ($exception instanceof TooManyRequestsHttpException):
                    return response()->json([
                        'message' => 'Bạn gửi request quá nhiều'
                    ], Response::HTTP_TOO_MANY_REQUESTS);
            }
        }

        if ($exception instanceof ModelNotFoundException) {
            return \response()->json([
                'data' => [
                    'message' => 'Không tìm thấy dữ liệu'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof AuthorizationException) {
            return \response()->json([
                'data' => [
                    'message' => 'Bạn không có quyền thao tác'
                ]
            ], Response::HTTP_FORBIDDEN);
        }

        return parent::render($request, $exception);
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        $message = $exception->getMessage();

        return response()->json([
            'data' => [
                'message' => __("validation.{$message}"),
                'errors' => $exception->errors(),
            ]
        ], $exception->status);
    }
}
