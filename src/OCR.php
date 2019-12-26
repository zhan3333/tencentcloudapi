<?php


namespace Zhan3333\Tencent;


use Zhan3333\Tencent\Request\Request;
use Zhan3333\Tencent\Response\Response;

class OCR
{
    public function execute(Request $request): Response
    {
        return $request->send();
    }
}
