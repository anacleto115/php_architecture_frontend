<?php
    namespace php_persons\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IMessage.php';

        use lib_domain_context\IMessage as IMessage;
        use lib_domain_context\MessagesHelper as MessagesHelper;
        use lib_domain_context\Message as Message;

        class MessagePHP implements IMessage
        {
            public function Show(string $message, int $type = Message::MESSAGE): bool
            {
                return true;
            }
        }
    }
?>