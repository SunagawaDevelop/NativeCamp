<?php
class MessagesController extends AppController {
   // public $components = array('RequestHandler');
    public $components = ['Paginator', 'Security'];

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Security->unlockedActions = ['delete', 'add'];
    }

    
    public function index() {
        $this->Paginator->settings = [
            'limit' => 10,
            'order' => ['Message.created' => 'desc'],
            'contain' => [
                'Conversation' => ['order' => ['Conversation.created' => 'asc']]
            ]
        ];

        $messages = $this->Paginator->paginate('Message');
        $this->set(compact('messages'));
    }

    public function add() {
        $this->set('recipient', ['' => '']); // 初期は空でOK

        if ($this->request->is('post')) {
            $this->Message->create();
            $this->request->data['Message']['user_id'] = $this->Auth->user('id');

            // recipient_id がある場合はユーザー情報を取得
            if (!empty($this->request->data['Message']['recipient_id'])) {
                $this->loadModel('User');
                $recipient = $this->User->find('first', [
                    'conditions' => ['User.id' => $this->request->data['Message']['recipient_id']],
                    'fields' => ['User.name']
                ]);

                if (!empty($recipient)) {
                    $recipientName = $recipient['User']['name'];
                    // メッセージ内容の先頭に「宛先: ユーザー名」を追加
                    $this->request->data['Message']['content'] = 'To: ' . $recipientName . "\n" . $this->request->data['Message']['content'];
                }
            }

            if ($this->Message->save($this->request->data)) {
                $this->Session->setFlash('メッセージを投稿しました');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Session->setFlash('投稿に失敗しました');
            }
        }
    }


    public function delete($id = null) {
        CakeLog::write('debug', "Delete method called with ID: $id");

        if (!$this->request->is('post') && !$this->request->is('delete')) {
            throw new MethodNotAllowedException();
        }

        $this->Message->id = $id;
        if (!$this->Message->exists()) {
            throw new NotFoundException(__('Invalid message'));
        }

        if ($this->Message->delete()) {
            CakeLog::write('debug', "Message $id deleted");
        } else {
            CakeLog::write('debug', "Failed to delete message $id");
        }

        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->response->type('json');
            echo json_encode(['status' => 'success']);
            return;
        }

        return $this->redirect(['action' => 'index']);


        }

}




