<?php
class Conversation extends AppModel {
    public $belongsTo = ['User', 'Message'];

    public $validate = [
        'content' => [
            'rule' => 'notBlank',
            'message' => '返信内容を入力してください'
        ],
        'message_id' => [
            'rule' => 'numeric',
            'message' => 'メッセージIDが不正です'
        ]
    ];
}
