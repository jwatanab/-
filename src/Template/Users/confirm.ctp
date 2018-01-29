<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container">
    <div class="confirm">
        <div class="confirm_user">
            氏名: <?= $user->name ?>
        </div>
        <div class="execute">
            <em>
                <div class="exe">
                    <?= $this->Html->link(
                            __('出勤'),
                            ['action' => 'execute', $user->id],
                            ['class' => 'auchor exe']
                        ) ?>
                    <?= $this->Html->link(
                            __('退勤'),
                            ['action' => 'execute', $user->id],
                            ['class' => 'auchor exe']                                        
                        ) ?>
                </div>
            </em>
        </div>
    </div>
</div>

<?php if($user->state) echo 'success' ?>