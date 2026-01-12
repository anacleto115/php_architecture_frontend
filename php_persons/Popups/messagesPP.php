<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/Bundle.php';
    
    use lib_language\Bundle as Bundle;

    echo "<div>
        <h2>
            ". Bundle::Get("RsMessages", "lbMessage") . "
        </h2>
        <label>
            " . $content->message . "
        </label>
        <br />

        <br />
        <br />
        <button type='submit'
                name='btClose'>
            ". Bundle::Get("RsMenu", "lbClose") . "
        </button>
    </div>";
?>