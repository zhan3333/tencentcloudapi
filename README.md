# 腾讯云api Laravel 版本

## 安装

`composer require zhan3333/tencentcloudapi`

## 配置

`.env`配置

```env
TENCENT_SECRET_ID=
TENCENT_SECRET_KEY=
```

## 使用

```php
use Zhan3333\Tencent\OCR;
use Zhan3333\Tencent\Request\OCRIdCardRequest;
use Zhan3333\Tencent\Response\OCRIdCardResponse;

$filePath = __DIR__ . '/files/id-card-front.jpg';
$request = new OCRIdCardRequest($filePath, OCRIdCardRequest::SIDE_FRONT);
/** @var OCRIdCardResponse $response */
$response = app(OCR::class)->execute($request);
dump($response);
dump($response->card);
dump($response->error_message);
dump($response->card->id_card_number);
``` 
