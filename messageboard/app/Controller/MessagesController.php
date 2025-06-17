<?php
class MessagesController extends AppController {
    public $components = ['Paginator', 'Security'];

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Security->unlockedActions = ['add', 'delete'];

        $this->Auth->deny();
    }

    public function index() {
        
        $this->Paginator->settings = [
            'limit' => 10,
            'order' => ['Message.created' => 'desc'],
            'contain' => [
                'User', // ← 投稿者のプロフィール画像用
                'Conversation' => [
                    'order' => ['Conversation.created' => 'asc'],
                    'User' // ← 会話投稿者のプロフィール画像用
                ]
            ]
        ];
        
        var_dump($this->Paginator->settings = [
            'limit' => 10,
            'order' => ['Message.created' => 'desc'],
            'contain' => ['Conversation' => ['order' => ['Conversation.created' => 'asc']]]
        ]);
        $this->set('messages', $this->Paginator->paginate('Message'));
        // ▼ ユーザー情報を取得し、ビューへ渡す（画像含む）
        $userId = $this->Auth->user('id');
        $currentUser = $this->Message->User->findById($userId);
        $this->set('currentUser', $currentUser['User']);
        $this->set('currentUser', $this->Auth->user()); 
    }

    public function add() {
        $this->set('recipient', ['' => '']);
        $this->set('currentUser', $this->Auth->user()); 

        if ($this->request->is('post')) {
            $this->Message->create();
            $data = $this->request->data;
            $data['Message']['user_id'] = $this->Auth->user('id');

            if (!empty($data['Message']['recipient_id'])) {
                $recipient = $this->Message->User->find('first', [
                    'co
                    ditions' => ['User.id' => $data['Message']['recipient_id']],
                    'fields' => ['User.name']
                ]);

                if (!empty($recipient)) {
                    $data['Message']['content'] = 'To: ' . $recipient['User']['name'] . "\n" . $data['Message']['content'];
                }
            }

            if ($this->Message->save($data)) {
                $this->Session->setFlash('メッセージを投稿しました');
                return $this->redirect(['action' => 'index']);
            }

            $this->Session->setFlash('投稿に失敗しました');
        }
    }

    public function delete($id = null) {
        if (!$this->request->is(['post', 'delete'])) {
            throw new MethodNotAllowedException();
        }

        if (!$this->Message->exists($id)) {
            throw new NotFoundException(__('Invalid message'));
        }

        $result = $this->Message->delete($id);
        CakeLog::write('debug', $result ? "Message $id deleted" : "Failed to delete message $id");

        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->response->type('json');
            echo json_encode(['status' => $result ? 'success' : 'error']);
            return;
        }

        return $this->redirect(['action' => 'index']);
    }
}
