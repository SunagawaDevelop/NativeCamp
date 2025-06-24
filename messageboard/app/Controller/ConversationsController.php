<?php
App::uses('AppController', 'Controller');

class ConversationsController extends AppController {
    public $components = ['Flash'];
    public $uses = ['Conversation', 'User']; // ← User モデルを使用するため追加

    public function index() {
        $userId = $this->Auth->user('id');
        $user = $this->User->findById($userId);

        $currentUserPhoto = !empty($user['User']['photo']) ? $user['User']['photo'] : null;
        $this->set('currentUserPhoto', $currentUserPhoto);

        // 会話一覧取得例（必要に応じて調整）
        $conversations = $this->Conversation->find('all', [
            'order' => ['Conversation.created' => 'DESC'],
            'limit' => 50
        ]);
        $this->set('conversations', $conversations);
    }

   public function add() {
        $this->autoRender = false;
        $this->response->type('json');

        $userId = $this->Auth->user('id');
        $user = $this->User->findById($userId);

        // 明示的に uploads/ を付与
        $currentUserPhoto = !empty($user['User']['photo']) ? 'uploads/' . $user['User']['photo'] : null;

        if ($this->request->is('post')) {
            $this->Conversation->create();
            $this->request->data['Conversation']['user_id'] = $userId;
            $this->request->data['Conversation']['user_photo'] = $currentUserPhoto;

            if ($this->Conversation->save($this->request->data)) {
                return json_encode(['status' => 'success']);
            } else {
                return json_encode(['status' => 'fail']);
            }
        }

        return json_encode(['status' => 'invalid']);
    }




    public function delete($id = null) {
        if (!$this->request->is('post') && !$this->request->is('delete')) {
            throw new MethodNotAllowedException();
        }

        $this->Conversation->id = $id;
        if (!$this->Conversation->exists()) {
            throw new NotFoundException(__('Invalid conversation'));
        }

        if ($this->Conversation->delete()) {
            $this->Session->setFlash(__('返信を削除しました'));
        } else {
            $this->Session->setFlash(__('返信の削除に失敗しました'));
        }

        return $this->redirect($this->referer());
    }
}
