<nav>
    <ul class="nav navbar-nav">
        <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/Bundle.php';

            use lib_language\Bundle as Bundle;
            
            $path = "http://" . $_SERVER['HTTP_HOST'] . "/php/php_persons";
            echo "<li><a href='" . $path . "/Screens/person_types.php'>". 
                Bundle::Get("RsMenu", "lbPersonTypes") . 
            "</a></li>";;
        ?>
    </ul>
</nav>