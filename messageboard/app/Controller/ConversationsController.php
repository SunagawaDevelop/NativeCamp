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

}
