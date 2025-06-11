<?php
class Message extends AppModel {
    public $hasMany = [
        'Conversation' => [
            'className' => 'Conversation',
            'foreignKey' => 'message_id',
            'dependent' => true
        ]
    ];
}
