<?php

namespace App\Traits\V1;

trait ResponseGeneratorTrait
{
    protected bool $has_error;
    protected int $header_code;
    protected string $response_code;

    private function setHasError($has_error): self
    {
        $this->has_error = $has_error;

        return $this;
    }

    private function setHeaderCode($header_code): self
    {
        $this->header_code = $header_code;

        return $this;
    }

    private function setResponseCode($response_code): self
    {
        $this->response_code = $response_code;

        return $this;
    }

    public function getResponse($data)
    {
        $responseJson = ['code' => $this->header_code, 'hasError' => $this->has_error,];
        if ($this->has_error) $responseJson['errors'] = $data; else $responseJson['data'] = $data;

        return response()->json($responseJson, $this->header_code);
    }

    public function success($data, $response_code, $header_code)
    {
        return $this->setHasError(false)->setHeaderCode($header_code)->setResponseCode($response_code)
            ->getResponse($data);
    }

    public function error($data, $response_code, $header_code)
    {
        return $this->setHasError(true)->setHeaderCode($header_code)->setResponseCode($response_code)
            ->getResponse($data);
    }
}
