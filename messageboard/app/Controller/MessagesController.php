<?php
class MessagesController extends AppController {
   // public $components = array('RequestHandler');
    public $components = ['Paginator', 'Security'];

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Security->unlockedActions = ['delete']; 
    
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
        if ($this->request->is('post')) {
            $this->Message->create();

            $this->request->data['Message']['user_id'] = $this->Auth->user('id');

            if ($this->Message->save($this->request->data)) {
                $this->Session->setFlash('メッセージを投稿しました');
                return $this->redirect(array('action' => 'index'));
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

    return $this->redirect(array('action' => 'index'));
}

}




