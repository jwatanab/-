<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\TimesTable $Times
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->viewBuilder()->layout('index');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->redirect('/users/viewContent');
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Users', 'Sessions']
        ]);

        $this->set('user', $user);
    }

    public function viewContent()
    {
        $users = $this->paginate($this->Users);
        
        $this->set(compact('users'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                debug($this->request->getData());
                $this->set(compact('user'));
            }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
    debug($this->request->getData());        
    $this->set(compact('user'));
    }

    public function confirm($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function execute($id = null){

        // IDが送信されていない場合には何も返さない。

        if(!$id) return;

        // 送信されたユーザー

        $user = $this->Users->get($id, ['contain' => []]);

        // 勤務開始していた場合

        if ($user->state){

            // -----------------
            //　処理
            // -----------------

            // 勤務開始時に発行したSession_idを元に開始時刻を検索

            $sessions = TableRegistry::get('Sessions')
                                    ->find()
                                    ->where(['session_id' => $user->session_id])
                                    ->first();

            $n = new Time($sessions->time, 'Asia/Tokyo');
            
            $interval = $n->diff(Time::now());

            // -----------------
            // Timeテーブルにインサート
            // -----------------

            /**
             * Sessionテーブルの特定の人物を検索するために
             * User_idで検索をかけ取得したレコードの最後を取得
             * レコードが存在しない場合には0に変換する
             */

            $timeIns = TableRegistry::get('Times');
            $timeIns = $timeIns->find('all')->all();
            $timeIns = $timeIns->last();
            $timeIns->sum = $timeIns->sum ? $timeIns->sum : 0;

            $result = [
                'user_id' => $user->user_id,
                'time' => $interval->h.':'.$interval->i,
                'sum' => $timeIns->sum + $interval->h
            ];

            $times = TableRegistry::get('Times');
            $time = $times->newEntity($result);

            // -----------------
            // 初期化
            // -----------------

            $ins = [
                'id' => $user->id,
                'user_id' => $user->user_id,
                'name' => $user->name,
                'state' => 0,
                'session_id' => null
            ];
                
            $user = $this->Users->patchEntity($user, $ins);
        
            // -----------------
            // リダイレクト
            // -----------------

            if ($this->Users->save($user) && $times->save($time)) $this->redirect(['action' => 'index']);

        } else {

            // -----------------
            // セッションIDを発行
            // -----------------

            $session_id = rand();

            // ---------------------------------------------------
            // 送信されたユーザーにStateとSession_idをインサート
            // ---------------------------------------------------
                
            $ins = [
                'id' => $user->id,
                'user_id' => $user->user_id,
                'name' => $user->name,
                'state' => 1,
                'session_id' => $session_id,
            ];

            $user = $this->Users->patchEntity($user, $ins);

            /**
             * Sessionテーブルにインサート、後からレコードを特定できるように
             * ユーザのUser_idとSession_idをレコードにインサート
             */

            $sesIns = [
                'id' => $id,
                'user_id' => $user->user_id,
                'name' => $user->name,
                'session_id' => $session_id,
                'time' => (new \Datetime(Time::now()))->format('Y-m-d H:i')
            ];
            
            $sessions = TableRegistry::get('Sessions');
            $session = $sessions->newEntity($sesIns);            


            if ($this->Users->save($user) && $sessions->save($session)) $this->redirect(['action' => 'index']);
    }
    
}
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}