<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
    public $components = array('Auth', 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'register');
    }

    public function login() {
        $loginResult = '';

        if ($this->request->is('post')) {
            $user = $this->User->find('first', array(
                'conditions' => array('User.email' => $this->request->data['User']['email'])
            ));

            if ($user) {
                App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
                $hasher = new SimplePasswordHasher();
                $inputPassword = $this->request->data['User']['password'];

                if ($hasher->check($inputPassword, $user['User']['password'])) {
                    $now = date('Y-m-d H:i:s');
                    $this->User->id = $user['User']['id'];
                    $this->User->saveField('logindate', $now);

                    $user['User']['logindate'] = $now;
                    $this->Auth->login($user['User']);

                    return $this->redirect(array('controller' => 'users', 'action' => 'mypage'));
                }
            }

            $loginResult = 'メールアドレスまたはパスワードが違います';
        }

        $this->set('loginResult', $loginResult);
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function mypage() {
        $user = $this->Auth->user(); 
        $this->set('user', $user);
    }

    public function register() {
        $isRegistered = false;

        if ($this->request->is('post')) {
            $this->User->create();
            $this->request->data['User']['logindate'] = date('Y-m-d H:i:s');

            if ($this->User->save($this->request->data)) {
                $user = $this->User->find('first', [
                    'conditions' => ['User.id' => $this->User->id]
                ]);
                $this->Auth->login($user['User']);

                $isRegistered = true;
                $this->set('isRegistered', $isRegistered);
                return;
            } else {
                $this->Session->setFlash('登録に失敗しました。入力内容をご確認ください。');
            }
        }

        $this->set('isRegistered', $isRegistered);
    }

public function profile() {
        $user = $this->Auth->user();
        $this->User->id = $user['id'];

        $userData = $this->User->read();
        $this->set('user', $userData['User']);

        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->data;
            $formType = isset($data['User']['form_type']) ? $data['User']['form_type'] : '';

            if ($formType === 'photo') {
                if (!empty($data['User']['photo']['name'])) {
                    $ext = pathinfo($data['User']['photo']['name'], PATHINFO_EXTENSION);
                    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

                    if (!in_array(strtolower($ext), $allowed)) {
                        $this->Session->setFlash('画像ファイル(jpg, png, gif)を選択してください');
                    } else {
                        $filename = time() . '_' . basename($data['User']['photo']['name']);
                        $path = WWW_ROOT . 'img' . DS . 'uploads' . DS . $filename;

                        if (move_uploaded_file($data['User']['photo']['tmp_name'], $path)) {
                            $this->User->saveField('photo', 'uploads/' . $filename);
                            $this->Session->setFlash('プロフィール画像を更新しました');
                            return $this->redirect(['action' => 'profile']);
                        } else {
                            $this->Session->setFlash('画像の保存に失敗しました');
                        }
                    }
                } else {
                    $this->Session->setFlash('画像を選択してください');
                }
            }

            if ($formType === 'profile') {
                if (isset($data['User']['hobby'])) {
                    $data['User']['hobby'] = trim($data['User']['hobby']);
                }

                unset($data['User']['photo']); // 画像更新時以外は無視
                $this->User->set($data);

                if ($this->User->save($data)) {
                    $this->Session->setFlash('プロフィールを更新しました');
                    return $this->redirect(['action' => 'profile_view']);
                } else {
                    $this->Session->setFlash('保存に失敗しました');
                }
            }
        } else {
            $this->request->data = $userData;
        }
    }


    public function profile_view() {
        $authUser = $this->Auth->user();

        if (!$authUser) {
            $this->Session->setFlash('ログインが必要です。');
            return $this->redirect(['action' => 'login']);
        }

        $userData = $this->User->findById($authUser['id']);
        $this->set('user', $userData);
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

    // UsersController.php
  public function upload_photo($id = null) {
    $this->autoRender = false;
    $this->response->type('json');

    if (!$this->request->is('ajax') || !$this->request->is('post')) {
        echo json_encode(['success' => false, 'message' => '不正なリクエストです']);
        return;
    }

    $user = $this->Auth->user();
    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'ログインが必要です']);
        return;
    }

    $this->User->id = $user['id'];
    $data = $this->request->data;

    if (!empty($data['User']['photo']['name'])) {
        $ext = strtolower(pathinfo($data['User']['photo']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $allowed)) {
            echo json_encode(['success' => false, 'message' => '画像形式が不正です']);
            return;
        }

        $filename = 'user_' . $user['id'] . '_' . time() . '.' . $ext;
        $relativePath = 'uploads/' . $filename;
        $absolutePath = WWW_ROOT . 'img' . DS . 'uploads' . DS . $filename;

        if (!is_dir(dirname($absolutePath))) {
            mkdir(dirname($absolutePath), 0775, true);
        }

        if (move_uploaded_file($data['User']['photo']['tmp_name'], $absolutePath)) {
            $this->User->saveField('photo', $relativePath);
            echo json_encode(['success' => true, 'message' => 'プロフィール画像を更新しました', 'photo' => $relativePath]);
            return;
        } else {
            echo json_encode(['success' => false, 'message' => 'アップロードに失敗しました']);
            return;
        }
    }

    echo json_encode(['success' => false, 'message' => '画像を選択してください']);
}




}
