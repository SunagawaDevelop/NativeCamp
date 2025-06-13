<?php
class ConversationsController extends AppController {
        public $components = ['Flash'];
        
        public function add() {
        $this->autoRender = false;
        $this->response->type('json');

        if ($this->request->is('post')) {
            $this->Conversation->create();
            $this->request->data['Conversation']['user_id'] = $this->Auth->user('id');

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
