<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
    public $components = array('Auth', 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
         $this->Auth->allow('login', 'register'); 
        $this->Auth->allow('login'); // loginは認証不要
    }

    public function login() {
    $loginResult = '';

    if ($this->request->is('post')) {
        $user = $this->User->find('first', array(
            'conditions' => array('User.email' => $this->request->data['User']['email'])
        ));

        if ($user && $user['User']['password'] === $this->request->data['User']['password']) {
            // ログイン日時を更新
            $this->User->id = $user['User']['id'];
            $this->User->saveField('logindate', date('Y-m-d H:i:s'));

            // ログイン処理
            $this->Auth->login($user['User']);

            // マイページへリダイレクト
            return $this->redirect(array('controller' => 'users', 'action' => 'mypage'));
        } else {
            $loginResult = 'メールアドレスまたはパスワードが違います';
        }
    }

    $this->set('loginResult', $loginResult);
}

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    public function mypage() {
        $user = $this->Auth->user(); // ログイン中のユーザ情報
        $this->set('user', $user);
    }

    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();

            $this->request->data['User']['logindate'] = date('Y-m-d H:i:s');
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('登録が完了しました。ログインしてください。');
                return $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash('登録に失敗しました。入力内容をご確認ください。');
            }
        }
    }

    public function profile() {
        $user = $this->Auth->user();
        $this->User->id = $user['id'];

        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->data;

            if (!empty($this->request->data['User']['photo']['name'])) {
                $filename = time() . '_' . $this->request->data['User']['photo']['name'];
                $path = WWW_ROOT . 'img' . DS . 'uploads' . DS . $filename;

                move_uploaded_file($this->request->data['User']['photo']['tmp_name'], $path);
                $data['User']['photo'] = 'uploads/' . $filename;
            } else {
                unset($data['User']['photo']);
            }

            // hobbyを明示的に含めて保存（テキストエリアから送信される）
            if (isset($data['User']['hobby'])) {
                $data['User']['hobby'] = trim($data['User']['hobby']); // 余分な空白を削除（任意）
            }

            if ($this->User->save($data)) {
                $this->Session->setFlash('プロフィールを更新しました');
                return $this->redirect(array('action' => 'profile'));
            } else {
                $this->Session->setFlash('更新に失敗しました。入力内容を確認してください。');
            }
        } else {
            $this->request->data = $this->User->read();
        }

        $this->set('user', $this->User->read());
    }

    public function profile_view() {
        $user = $this->Auth->user();

        if (!$user) {
            $this->Session->setFlash('ログインが必要です。');
            return $this->redirect(array('action' => 'login'));
        }

        $this->set('user', $this->User->findById($user['id']));
    }

    public function search() {
        $this->autoRender = false;
        $this->response->type('json');

        $query = $this->request->query('q');

        $users = $this->User->find('all', [
            'conditions' => ['User.name LIKE' => '%' . $query . '%'],
            'fields' => ['User.id', 'User.name'],
            'limit' => 10
        ]);

        $result = [];
        foreach ($users as $user) {
            $result[] = [
                'id' => $user['User']['id'],
                'text' => $user['User']['name']
            ];
        }

        echo json_encode(['results' => $result]);
    }

}
