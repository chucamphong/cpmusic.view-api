<?php

namespace App\Exceptions;

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
        if ($exception instanceof NotFoundHttpException) {
            return \response()->json([
                'data' => [
                    'message' => 'Không tồn tại URL này trên máy chủ.'
                ]
            ], 404);
        }

        if ($this->isHttpException($exception) && $request->expectsJson()) {
            switch (true) {
                case ($exception instanceof TooManyRequestsHttpException):
                    return response()->json([
                        'message' => 'Bạn gửi request quá nhiều'
                    ], Response::HTTP_TOO_MANY_REQUESTS);
            }
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
