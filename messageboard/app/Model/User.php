<?php
App::uses('AppModel', 'Model');

class User extends AppModel {
    public $name = 'User';

    public function beforeSave($options = array()) {
    if (!empty($this->data[$this->alias]['password'])) {
        $password = $this->data[$this->alias]['password'];

        $isHashed = preg_match('/^[0-9a-f]{40}$/', $password);

        if (!$isHashed) {
            App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($password);
        }
    }
    return true;
}


    public $validate = array(
    'name' => array(
        'rule' => array('between', 5, 20),
        'message' => '名前は5文字以上20文字以下で入力してください',
        'allowEmpty' => false
    ),
    'email' => array(
        'format' => array(
            'rule' => 'email',
            'message' => '正しいメールアドレスを入力してください',
            'required' => true,
            'allowEmpty' => false
        ),
        'duplicate' => array(
            'rule' => 'isUnique',
            'message' => 'このメールアドレスは既に登録されています'
        )
    ),


    'password' => array(
        'rule' => 'notBlank',
        'message' => 'パスワードを入力してください'
    ),
    'password_confirm' => array(
        'rule' => 'validatePasswordConfirm',
        'message' => 'パスワードが一致しません'
    ),
    'birthdate' => array(
        'rule' => 'date',
        'message' => '誕生日を正しく入力してください',
        'allowEmpty' => false
    ),
    'gender' => array(
        'rule' => array('inList', array('Male', 'Female')),
        'message' => '性別を選択してください'
    ),
    'hobby' => array(
        'rule' => 'notBlank',
        'message' => '趣味を入力してください'
    ),
    'photo' => array(
        'rule' => array('extension', array('jpg', 'jpeg', 'gif', 'png')),
        'message' => '画像ファイル(jpg, png, gif)を選択してください',
        'allowEmpty' => true
    )
);

    public $virtualFields = array();

    public function validatePasswordConfirm($data) {
        return $data['password_confirm'] === $this->data[$this->alias]['password'];
    }
}
