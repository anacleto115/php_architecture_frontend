<?php
    namespace lib_domain_context
    {
        class Message
        {
            const MESSAGE = 0, 
                  QUESTION = 1;
        }
    
        interface IMessage
        {
            function Show(string $message, int $type = Message::MESSAGE): bool;
        }
    
        class MessagesHelper
        {
            private static ?IMessage $IMessage;

            public static function Set(?IMessage $iMessage): void
            {
                MessagesHelper::$IMessage = $iMessage;
            }

            public static function Show(string $message, int $type = Message::MESSAGE): bool
            {
                if (MessagesHelper::$IMessage == null)
                    return false;
                return MessagesHelper::$IMessage->Show($message, $type);
            }
        }
    }
?>