<?php

namespace Zhan3333\Tencent;

use Illuminate\Support\ServiceProvider;
use TencentCloud\Common\Credential;
use TencentCloud\Ocr\V20181119\OcrClient;

class TencentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/tencent.php' => config_path('tencent.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/tencent.php', 'tencent'
        );

        $this->app->singleton(Credential::class, function () {
            return new Credential(config('tencent.secret_id'), config('tencent.secret_key'));
        });

        $this->app->singleton(OcrClient::class, function () {
            return new OcrClient(app(Credential::class), config('tencent.ocr.region'));
        });
    }
}
