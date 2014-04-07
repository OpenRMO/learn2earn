<!DOCTYPE HTML> 
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lespagina</title>
        <link href="styles/reset.css" rel="stylesheet" type="text/css" >
        <link href="styles/main.css" rel="stylesheet" type="text/css" >
        <link href="styles/lessons.css" rel="stylesheet" type="text/css" >
        <?php
        include "../config/config.inc.php";
        include "logincheck.php";
        ?>

        <?php
        $course = $_GET['course'];

        if ($course == NULL) {
            header("Location: portal.php");
        }
        ?>
    </head>
    <body>

        <header>	
            <div id="left_header" class="kolom">
                <a href="../index.php"><img src="../images/learn2earn.png" alt="Learn2earn" width="50%" height="50px"></a>
            </div>

            <div id="right_header" class="kolom">
                <nav>
                    <ul class="navigatie">
                        <a href="../index.php"><li>Home</li></a>
                        <a href="portal.php"><li>Jaar</li></a>
                        <a href=""><li>Badges</li></a>
                    </ul>
                </nav>
            </div>
        </header>

        <div id="scrollbar_body" class="scrollbar1">
            <div id="wrapper">
                <div id="left" class="kolom">		
                    <div id="scrollbar_uitleg" class="scrollbar">
                        <table>
                            <tr>
                                <td>
                                    <?php
                                    $query = $db->select("courses", array("description"), array("course_id" => $course));
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div id="right" class="kolom">
                    <div id="scrollbar_film" class="scrollbar">
                        <table>
                            <tr>
                                <td class="right">		

                                    <p class="text">
                                        <b>Lesdoelen:</b><br>
                                    </p>

                                    <p class="text"> 
                                        <b>Badges:</b>
                                    </p>

                                    <p class="text">
                                        <b>Bestanden:</b>
                                    </p>

                                    <div id="updates" class="updates">
                                        <table class="updates_table">
                                            <tr class="updates_tr">
                                                <th>
                                                    UPDATES
                                                </th>
                                            </tr>
                                            <tr class="updates_tr">
                                                <td class="updates_td">
                                                    Wijziging
                                                </td>
                                            </tr>
                                            <tr class="updates_tr">
                                                <td class="updates_td">
                                                    Wijziging
                                                </td>
                                            </tr>
                                            <tr class="updates_tr">
                                                <td class="updates_td">
                                                    Wijziging
                                                </td>
                                            </tr>
                                            <tr class="updates_tr">
                                                <td class="updates_td">
                                                    Wijziging
                                                </td>
                                            </tr>
                                            <tr class="updates_tr">
                                                <td class="updates_td">
                                                    Wijziging
                                                </td>
                                            </tr>
                                            <tr class="updates_tr">
                                                <td class="updates_td">
                                                    Wijziging
                                                </td>
                                            </tr>
                                            <tr class="updates_tr">
                                                <td class="updates_td">
                                                    Wijziging
                                                </td>
                                            </tr>
                                            <tr class="updates_tr">
                                                <td class="updates_td">
                                                    Wijziging
                                                </td>
                                            </tr>
                                            <tr class="updates_tr" style="border-bottom: 0em">
                                                <td class="updates_td">
                                                    Wijziging
                                                </td>
                                            </tr>								
                                        </table>
                                    </div>

                                    <div id="agenda" class="agenda">
                                        <table class="agenda_table">
                                            <tr class="agenda_tr">
                                                <th>
                                                    AGENDA
                                                </th>
                                            </tr>
                                            <tr class="agenda_tr">
                                                <td class="agenda_td">
                                                    Datum
                                                </td>
                                            </tr>
                                            <tr class="agenda_tr">
                                                <td class="agenda_td">
                                                    Datum
                                                </td>
                                            </tr>
                                            <tr class="agenda_tr">
                                                <td class="agenda_td">
                                                    Datum
                                                </td>
                                            </tr>
                                            <tr class="agenda_tr">
                                                <td class="agenda_td">
                                                    Datum
                                                </td>
                                            </tr>
                                            <tr class="agenda_tr">
                                                <td class="agenda_td">
                                                    Datum
                                                </td>
                                            </tr>
                                            <tr class="agenda_tr">
                                                <td class="agenda_td">
                                                    Datum
                                                </td>
                                            </tr>
                                            <tr class="agenda_tr">
                                                <td class="agenda_td">
                                                    Datum
                                                </td>
                                            </tr>
                                            <tr class="agenda_tr">
                                                <td class="agenda_td">
                                                    Datum
                                                </td>
                                            </tr>
                                            <tr class="agenda_tr" style="border-bottom: 0em">
                                                <td class="agenda_td">
                                                    Datum
                                                </td>
                                            </tr>								
                                        </table>
                                    </div>

                                    <nav>
                                        <ul class="navigatie" style="float: left; margin-left: 3%;">
                                            <li><a href="*">Inleveren</a></li>
                                        </ul>
                                    </nav>

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <p> &#169; learn2earn </p>
        </footer>
    </body>
</html>