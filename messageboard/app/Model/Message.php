<?php
class Message extends AppModel {
    public $hasMany = [
        'Conversation' => [
            'className' => 'Conversation',
            'foreignKey' => 'message_id',
            'dependent' => true
        ]
    ];

    public $belongsTo = [
        'User' => [
            'className' => 'User',
            'foreignKey' => 'user_id'
        ],
        'Recipient' => [
            'className' => 'User',
            'foreignKey' => 'recipient_id'
        ]
    ];

    public $validate = [
        'content' => [
            'rule' => 'notBlank',
            'message' => 'メッセージ内容を入力してください'
        ],
        'recipient_id' => [
            'rule' => 'numeric',
            'message' => '受信者が不正です'
        ]
    ];
}
