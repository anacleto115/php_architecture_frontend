<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/Bundle.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_core/Core/FactoryHelper.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_context/Core/FactoryHelperContext.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_communication_core/Core/FactoryCommunication.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_communication_context/Core/FactoryCommunicationContext.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IMessage.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/php_persons/Core/MessagePHP.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/ICaller.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_communication_context/Core/FactoryCallerContext.php';

    use lib_language\Bundle as Bundle;
    use lib_presentation_core\Core\FactoryHelper as FactoryHelper;
    use lib_presentation_context\Core\FactoryHelperContext as FactoryHelperContext;
    use lib_communication_core\Core\FactoryCommunication as FactoryCommunication;
    use lib_communication_context\Core\FactoryCommunicationContext as FactoryCommunicationContext;
    use lib_domain_context\MessagesHelper as MessagesHelper;
    use php_persons\Core\MessagePHP as MessagePHP;
    use lib_domain_context\FactoryCaller as FactoryCaller;
    use lib_communication_context\Core\FactoryCallerContext as FactoryCallerContext;

    MessagesHelper::Set(new MessagePHP());
    Bundle::Load("Es");
    session_start();
    FactoryHelper::$IFactoryHelper = new FactoryHelperContext();
    FactoryCaller::$IFactoryCaller = new FactoryCallerContext();
?>