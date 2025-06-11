<?php
class MessagesController extends AppController {
    public $components = array('RequestHandler');

    public function index() {
        $this->paginate = array(
            'limit' => 10,
            'order' => array('Message.created' => 'desc')
        );
        $messages = $this->paginate('Message');
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
        $this->request->onlyAllow('post', 'ajax');

        $this->Message->id = $id;
        if (!$this->Message->exists()) {
            throw new NotFoundException('メッセージが存在しません');
        }

        // 子テーブルのConversationも削除する
        $this->Message->Conversation->deleteAll(array('Conversation.message_id' => $id), false);

        if ($this->Message->delete()) {
            $this->set('result', 'success');
        } else {
            $this->set('result', 'fail');
        }
        $this->set('_serialize', array('result'));
    }
}
