```php

/**
 * Document
 */

// Time Componentを使用

use Cake\I18n\Time;

// データフロー

// 日時文字列を挿入

(new \Datetime(Time::now()))->format('Y-m-d H:i');

// 挿入された文字列(勤務開始時間)を元にインスタンスを生成

new Time($sessions->time, 'Asia/Tokyo');

// 現在時刻との差分を算出

$interval = $n->diff(Time::now());

// 算出された文字列を勤務時間として出力

function diffEcho($diff){
    if($diff->d) return $intediffrval->d.'日'.$diff->h.'時間'.$diff->i.'分';
    return  $diff->h.'時間'.$diff->i.'分';
}

// diffEcho($interval);

```