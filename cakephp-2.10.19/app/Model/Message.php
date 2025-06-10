<?php
App::uses('AppModel', 'Model');

class Message extends AppModel {
    public $hasMany = array(
        'Conversation' => array(
            'dependent' => true
        )
    );

    public $validate = array(
        'content' => array(
            'rule' => 'notBlank',
            'message' => '内容を入力してください'
        )
    );
}