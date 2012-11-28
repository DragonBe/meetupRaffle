<?php
session_start();
require_once 'bootstrap.php';
function __autoload($class)
{
    require_once sprintf('%s.php', $class);
}
function escape($string)
{
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

// processing data
if (isset ($_POST['participants'])) {
    $_SESSION['names'] = $_POST['participants'];
}
if (isset($_GET['raffle'])) {
    $names = $_SESSION['names'];
    $names = str_replace("\r\n", PHP_EOL, $names);
    $names = str_replace("\r", PHP_EOL, $names);
    $participants = explode(PHP_EOL, $names);
    $raffle = new Raffle($participants);
    $result = array ('winner' => $raffle->draw());
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}
?>
<?php if (isset ($_SERVER['HTTP_HOST'])): ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; Charset=UTF-8"/>
        <title>Raffling prizes</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $("#randomizer").click(function () {
                $("#randomName").removeClass('highLight');
                $("#randomName").text('And the winner is...').css('class','temp');
                $.getJSON('<?php echo $_SERVER['PHP_SELF'] ?>?raffle=1', function (data) {
                    $("#randomName").text(data.winner).addClass('highLight');
                });
                return false;
            });
        });
        </script>
        <style type="text/css">
            body, button, textarea, input {
                font-family: Helvetica, Sans-serif;
                font-size: x-large;
            }
            body {
                text-align: center;
            }
            #master {
                width: 990px;
                margin: 125px auto 0 auto;
            }
            .temp {
                color: #888888;
            }
            .highLight {
                color: white;
                background: black;
            }
        </style>
    </head>
<body>
    <div id="master">
        <div id="randomName"><span class="temp">And the winner is...</span></div>
        <div id="randomize">
            <form name="randomSelector">
                <input type="hidden" name="raffle" value="1"/>
                <button id="randomizer">Raffle</button>
            </form>
        </div>
        <form name="names" method="post">
            <div>
                <textarea rows="12" cols="35" name="participants"><?php if (isset ($_SESSION['names'])): ?><?php echo escape($_SESSION['names']) ?><?php endif; ?></textarea>
            </div>
            <div>
                <button>Submit</button>
            </div>
        </form>
    </div>
</body>
<?php endif; ?>