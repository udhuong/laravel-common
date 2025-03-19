<?php
namespace Udhuong\LaravelCommon;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Udhuong\LaravelCommon\Domain\Exceptions\ApiExceptionHandler;

class LaravelCommonServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerExceptionHandler();
    }

    protected function registerExceptionHandler(): void
    {
        $this->app->booted(function () {
            $handler = $this->app->make(ExceptionHandler::class);

            if (method_exists($handler, 'withExceptions')) {
                $handler->withExceptions(function ($exceptions) {
                    $exceptions->renderable(function (\Throwable $exception, $request) {
                        return ApiExceptionHandler::handle($exception);
                    });
                });
            }
        });
    }
}