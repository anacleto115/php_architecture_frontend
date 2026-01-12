<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/Bundle.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/php_persons/indexForm.php';
    
    use lib_language\Bundle as Bundle;
    use php_persons\indexForm as indexForm;

    include("config.php");
    $content = new indexForm();
    
    $content->CheckLogged();
    if ($content->logged) 
    {
        $content->Load();
        $content->SetData($_POST, $_FILES);        
    }
    if (array_key_exists('btCancel', $_POST)) 
        $content->Cancel();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Php-Persons</title>
        <link rel="stylesheet" type="text/css" href="../content/site.css">
    </head>
    <body >
        <?php 
            include("menu.php"); 

            echo "<div align='center'>
                <form method='post'
                    enctype='multipart/form-data'
                    action=''>";
                    echo "<input type='hidden' 
                            name='ListDetail'
                            value='" . $content->listDetail . "' />";

                    echo "<h2>". Bundle::Get("RsPersonTypes", "lbTitle") . "</h2>

                    <div>
                        <button disabled>
                            ". Bundle::Get("RsMenu", "lbNew") . "
                        </button>
                        <button disabled>
                            ". Bundle::Get("RsMenu", "lbSave") . "
                        </button>
                        <button type='submit'
                                name='btLoad'>
                            ". Bundle::Get("RsMenu", "lbSelect") . "
                        </button>
                        <button disabled>
                            ". Bundle::Get("RsMenu", "lbCancel") . "
                        </button>
                    </div>
                    <br />";

                if ($content->listDetail)
                {
                    echo "<table class='tables'>
                        <thead>
                            <tr>
                                <th>". Bundle::Get("RsPersonTypes", "clName") . "</th>
                                <th style='width:85px'>". Bundle::Get("RsMenu", "lbChoose") . "</th>
                            </tr>
                        </thead>
                        <tbody>";
                            foreach ($content->list as $x)
                            {
                                echo "<tr key='". $x->GetId(). "'>
                                    <td>" . $x->GetName() . "</td>
                                    <td align='center'>
                                        <button disabled
                                                type='submit'
                                                name='btSelect'
                                                value='" . $x->GetId() . "'>
                                            ". Bundle::Get("RsMenu", "lbEdit") . "
                                        </button>
                                        <button disabled
                                                type='submit'
                                                name='btAskDelete'
                                                value='" . $x->GetId() . "'>
                                            ". Bundle::Get("RsMenu", "lbDelete") . "
                                        </button>
                                    </td>
                                </tr>";
                            }
                    echo "</tbody>
                    </table>";
                }

                if ($content->message != "")
                {
                    echo "<div class='popup'>
                        <div class='popup_inner_delete'>";
                            include("../Popups/messagesPP.php"); 
                    echo "</div>
                    </div>";
                }

                echo "</form>
            </div>";
        ?>
    </body>
</html>