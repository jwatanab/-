<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $user_id
 * @property string $name
 * @property string $state
 * @property string $session_id
 *
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Session[] $sessions
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'name' => true,
        'state' => true,
        'session_id' => true,
        'users' => true,
        'sessions' => true
    ];
}
