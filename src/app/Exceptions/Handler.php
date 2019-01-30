<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        error_log($exception);
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', ['bodyClass' => 'storageseeker home','breadcumb' => null], 404);
        }
        //Handle the FatalError with SoapAPI, returning a new Soap-API exception
        if (strpos($exception->getMessage(), 'SOAP-ERROR') !== false) {
            error_log("Soap Client construct failed because: {$exception->getMessage()}");
            return response()->view('listing', ['bodyClass' => 'storageseeker error', 'titlePage' => 'StorageSeeker Error', 'error' => 1, 'breadcumb' => null]);
        }
        if ($exception instanceof SoapCallException) {
            if (
                strpos($exception->getMessage(), 'Location not found')
                || strpos($exception->getMessage(), 'location format is invalid')
            ) {
                $message = 'We were unable to find the location you entered. Try searching for a more specific location name or searching in a different area.';
            } elseif ( strpos($exception->getMessage(), 'cURL') !== false) {
                $message = "There was an error handling your request. Please try again later.";
            } else {
                $message = $exception->getMessage();
            }
            return response()->view('errors.4xx', ['errorMessage' => $message, 'bodyClass' => 'storageseeker home', 'breadcumb' => null]);
        } elseif ($exception instanceof \Illuminate\Session\TokenMismatchException) {

            \Debugbar::info($exception);

            $message = "Your form has expired.";
            return response()->view('errors.4xx', ['errorMessage' => $message, 'bodyClass' => 'storageseeker home', 'breadcumb' => null]);
        }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
