<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = ['current_password', 'password', 'password_confirmation'];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // create custom render for 404 and 500 response
    public function render($request, Throwable $e)
    {
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->view(
                'errors.error',
                [
                    'title' => 'Error 404 | UMKMPlus',
                    'header' => 'Page Not Found',
                    'message' => 'Oops! The page you are looking for does not exist. It might have been moved or deleted.',
                ],
                404,
            );
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            return response()->view(
                'errors.error',
                [
                    'title' => 'Error 404 | UMKMPlus',
                    'header' => 'Page Not Found',
                    'message' => 'Oops! The page you are looking for does not exist. It might have been moved or deleted.',
                ],
                404,
            );
        }

        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->view(
                'errors.error',
                [
                    'title' => 'Error 404 | UMKMPlus',
                    'header' => 'Page Not Found',
                    'message' => 'Oops! The page you are looking for does not exist. It might have been moved or deleted.',
                ],
                404,
            );
        }

        if ($e instanceof \Illuminate\Database\QueryException) {
            return response()->view(
                'errors.error',
                [
                    'title' => 'Error 500 | UMKMPlus',
                    'header' => 'Internal Server Error',
                    'message' => 'Something went wrong. Please try again later.',
                ],
                500,
            );
        }

        return parent::render($request, $e);
    }
}
