<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Times Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Time get($primaryKey, $options = [])
 * @method \App\Model\Entity\Time newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Time[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Time|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Time patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Time[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Time findOrCreate($search, callable $callback = null, $options = [])
 */
class TimesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('times');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('time')
            ->maxLength('time', 255)
            ->requirePresence('time', 'create')
            ->notEmpty('time');

        $validator
            ->scalar('sum')
            ->maxLength('sum', 255)
            ->requirePresence('sum', 'create')
            ->notEmpty('sum');

        return $validator;
    }
}
