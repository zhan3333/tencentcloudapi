<?php

namespace Zhan3333\Tencent\Response;

use TencentCloud\Ocr\V20181119\Models\IDCardOCRResponse;
use Zhan3333\Tencent\Request\OCRIdCardRequest;

class OCRIdCardResponse extends Response
{

    /**
     * @var IdCard $cards 检测出的证件信息
     *
     * 注：如果没有检测出证件则为空数组
     */
    public $card;

    /** @var string $error_message 当请求失败时才会返回此字符串，具体返回内容见后续错误信息章节。否则此字段不存在。 */
    public $error_message;

    /** @var OCRIdCardRequest $request */
    public $request;

    /**
     *  请求id
     * @var string
     */
    public $request_id;

    public function __construct(IDCardOCRResponse $response = null)
    {
        $this->card = new IdCard();
        if ($response) {
            $this->card->type = 1; // 是否为身份证
            $this->card->name = $response->Name;
            $this->card->id_card_number = $response->IdNum;
            $this->card->sex = $response->Sex;
            $this->card->nation = $response->Nation;
            $this->card->birth = $response->Birth;
            $this->card->address = $response->Address;
            $this->card->authority = $response->Authority;
            $this->card->validDate = $response->ValidDate;
            $this->request_id = $response->RequestId;
        } else {
            $this->card->type = 0;
        }
    }
}
