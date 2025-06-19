<?php
App::uses('AppController', 'Controller');

class ConversationsController extends AppController {
    public $components = ['RequestHandler'];

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'delete'); // 必要に応じて調整
    }

    public function add() {
        $this->autoRender = false;
        $this->response->type('json');

        if ($this->request->is('post')) {
            $this->Conversation->create();

            $user = $this->Auth->user(); // 現在のログインユーザー情報を取得

            $this->request->data['Conversation']['user_id'] = $user['id'];
            $this->request->data['Conversation']['user_photo'] = !empty($user['photo']) ? $user['photo'] : null;

            if ($this->Conversation->save($this->request->data)) {
                echo json_encode(['status' => 'success']);
                return;
            } else {
                echo json_encode(['status' => 'fail']);
                return;
            }
        }

        echo json_encode(['status' => 'invalid']);
    }

    public function delete($id = null) {
        $this->autoRender = false;
        $this->response->type('json');

        if (!$this->request->is(['post', 'delete']) || !$this->Conversation->exists($id)) {
            echo json_encode(['status' => 'error']);
            return;
        }

        if ($this->Conversation->delete($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'fail']);
        }
    }
}
