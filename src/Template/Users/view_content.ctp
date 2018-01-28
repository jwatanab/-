<div class="container">
    <div class="user_content">
    <?php foreach($users as $user): ?>
        <div class="user">
            <?= $this->Html->link(__($user->name), ['action' => 'confirm', $user->id]) ?>
        </div>
        <?php endforeach ?>
    </div>
</div>