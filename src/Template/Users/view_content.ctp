<?php

use Cake\I18n\Time;

$ttt = new Datetime(Time::now());
$date1 = new Time('2017-01-29 11:11', 'Asia/Tokyo');

$interval = $date1->diff(Time::now());

echo $interval->y.'年'.$interval->h.'時間'.$interval->i.'分'

?>
<!--  -->
<div class="container">
    <div class="user_content">
    <?php foreach($users as $user): ?>
        <div class="user">
            <?= $this->Html->link(__($user->name), ['action' => 'confirm', $user->id]) ?>
        </div>
    <?php endforeach ?>
    </div>
</div>