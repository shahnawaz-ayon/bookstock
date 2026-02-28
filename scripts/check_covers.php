<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$res = Illuminate\Support\Facades\DB::table('books')->select('id','title','cover_image')->get();
print_r($res);
