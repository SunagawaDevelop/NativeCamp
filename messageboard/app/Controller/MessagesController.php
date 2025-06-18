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
            'User',
            'Recipient',
            'Conversation' => [
                'order' => ['Conversation.created' => 'asc'],
                'User' 
            ]
        ]
    ];

        $this->set('messages', $this->Paginator->paginate('Message'));
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
                    'conditions' => ['User.id' => $data['Message']['recipient_id']],
                    'fields' => ['User.name']
                ]);

                if (!empty($recipient)) {
                    $data['Message']['content'] = $data['Message']['content'];
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
