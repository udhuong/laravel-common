<?php


use Udhuong\LaravelCommon\Presentation\Http\Response\Responder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller extends \Illuminate\Routing\Controller
{
    public function callAction($method, $parameters): JsonResponse|Response
    {
        try {
            return parent::callAction($method, $parameters);
        } catch (Throwable $e) {
            return Responder::failWithException($e);
        }
    }
}
