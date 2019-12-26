<?php

namespace Zhan3333\Tencent\Request;


use GuzzleHttp\Client;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Ocr\V20181119\Models\IDCardOCRRequest;
use TencentCloud\Ocr\V20181119\OcrClient;
use Zhan3333\Tencent\Response\OCRIdCardResponse;

class OCRIdCardRequest extends Request
{
    public const SIDE_FRONT = 'FRONT';  // 正面
    public const SIDE_BACK = 'BACK';    // 背面

    /**
     * 上传图片链接
     * @var string $imgPath
     */
    public $imgPath;

    /**
     * 身份证正反面
     * @var string
     */
    public $side;

    public function __construct($imgPath, $side)
    {
        $this->imgPath = $imgPath;
        $this->side = $side;
    }

    /**
     * 发送请求
     * @param Client $client
     * @param $key
     * @param $secret
     * @return OCRIdCardResponse
     */
    public function send()
    {
        $req = new IDCardOCRRequest();
        $req->ImageBase64 = base64_encode(file_get_contents($this->imgPath));
        $req->CardSide = $this->side;
        try {
            $res = app(OcrClient::class)->IDCardOCR($req);
            $response = new OCRIdCardResponse($res);
            $response->request = $this;
            $response->card->side = $this->side;
        } catch (TencentCloudSDKException $exception) {
            $response = new OCRIdCardResponse();
            $response->request = $req;
            $response->card->side = $this->side;
            $response->error_message = $exception->getMessage();
        }
        return $response;
    }
}
