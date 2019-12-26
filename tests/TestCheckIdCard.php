<?php


namespace Tests;


use Zhan3333\Tencent\OCR;
use Zhan3333\Tencent\Request\OCRIdCardRequest;
use Zhan3333\Tencent\Response\OCRIdCardResponse;

class TestCheckIdCard extends TestCase
{
    /**
     * 验证正确的身份证正面
     */
    public function testCheckIdCardFront()
    {
        $filePath = __DIR__ . '/files/id-card-front.jpg';
        $request = new OCRIdCardRequest($filePath, OCRIdCardRequest::SIDE_FRONT);
        /** @var OCRIdCardResponse $response */
        $response = app(OCR::class)->execute($request);
        $this->assertInstanceOf(OCRIdCardResponse::class, $response);
        $this->assertEquals('420222199212041057', $response->card->id_card_number);
        $this->assertEquals('1992/12/4', $response->card->birth);
        $this->assertEquals('湖北省阳新县韦源口镇大围小区192号', $response->card->address);
        $this->assertEquals('詹光', $response->card->name);
        $this->assertEquals('汉', $response->card->nation);
        $this->assertEquals(false, $response->card->isBack());
        $this->assertEquals(true, $response->card->isFront());
        $this->assertEquals(true, $response->card->isCard());
    }

    /**
     * 验证正确的身份证背面
     */
    public function testCheckIdCardBack()
    {
        $filePath = __DIR__ . '/files/id-card-back.jpg';
        $request = new OCRIdCardRequest($filePath, OCRIdCardRequest::SIDE_BACK);
        /** @var OCRIdCardResponse $response */
        $response = app(OCR::class)->execute($request);
        $this->assertInstanceOf(OCRIdCardResponse::class, $response);
        $this->assertEquals(true, $response->card->isCard());
        $this->assertEquals(true, $response->card->isBack());
        $this->assertEquals(false, $response->card->isFront());

        $this->assertEquals('阳新县公安局', $response->card->authority);
        $this->assertEquals('2011.08.10-2021.08.10', $response->card->validDate);
        $this->assertEquals(1, $response->card->type);
    }

    public function testCheckIdCardFrontHorizontal()
    {
        $filePath = __DIR__ . '/files/id-card-front-horizontal.jpeg';
        $request = new OCRIdCardRequest($filePath, OCRIdCardRequest::SIDE_FRONT);
        /** @var OCRIdCardResponse $response */
        $response = app(OCR::class)->execute($request);
        $this->assertEquals(true, $response->card->isCard());
        $this->assertEquals(false, $response->card->isBack());
        $this->assertEquals(true, $response->card->isFront());
        $this->assertEquals('420222199212041057', $response->card->id_card_number);
        $this->assertEquals('1992/12/4', $response->card->birth);
        $this->assertEquals('湖北省阳新县韦源口镇大围小区192号', $response->card->address);
        $this->assertEquals('詹光', $response->card->name);
        $this->assertEquals('汉', $response->card->nation);
    }

    public function testCheckIdCardBackHorizontal()
    {
        $filePath = __DIR__ . '/files/id-card-back-horizontal.jpeg';
        $request = new OCRIdCardRequest($filePath, OCRIdCardRequest::SIDE_BACK);
        /** @var OCRIdCardResponse $response */
        $response = app(OCR::class)->execute($request);
        $this->assertInstanceOf(OCRIdCardResponse::class, $response);
        $this->assertEquals('阳新县公安局', $response->card->authority);
        $this->assertEquals('2011.08.10-2021.08.10', $response->card->validDate);
        $this->assertEquals(1, $response->card->type);
        $this->assertEquals(true, $response->card->isBack());
        $this->assertEquals(false, $response->card->isFront());
        $this->assertEquals(true, $response->card->isCard());
    }

    /**
     * 验证错误的图片
     */
    public function testCheckOtherImg()
    {
        $filePath = __DIR__ . '/files/other.jpg';
        $request = new OCRIdCardRequest($filePath, OCRIdCardRequest::SIDE_FRONT);
        /** @var OCRIdCardResponse $response */
        $response = app(OCR::class)->execute($request);
        $this->assertEquals(false, $response->card->isCard());
    }

    /**
     * 测试错误的文件类型
     */
    public function testErrorImg()
    {
        $filePath = __DIR__ . '/files/text.txt';
        $request = new OCRIdCardRequest($filePath, OCRIdCardRequest::SIDE_FRONT);
        /** @var OCRIdCardResponse $response */
        $response = app(OCR::class)->execute($request);
        $this->assertEquals(false, $response->card->isCard());
    }
}
