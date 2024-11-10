<?php
    
    define('WAY', 'db/table.json');

    require_once 'db/db.php';

    //-----Checking Login-----
    $nick = $_SESSION['login'];

    if(!isset($nick)){
        //Relocating
        header("Location: /login/");
    } else {
        $pf = table_get($nick);
    }

    $file = scandir("./chatlog/LocalServ")[2];
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" /><link href="./style/main.css" rel="stylesheet" />
        <title>HackerMakerMessenger</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <meta charset="utf-8">
    </head>
    <body>
        <div class="cont">
            <div class="desktop">
                <div class="background-panel">
                    <div class="answer-panel" id="otvet">
                    
                    </div>
                </div>
                <div class="right-panel">
                    <div class="outer-box checkbox">
                        <div class="inner-box"></div>
                    </div>
                </div>
                <div class="left-panel">
                    <div class="v1_7">
                        <div class="server-panel">
                            <div id="scrol">
                                <div id="servID">
                                    <div class="v21_2">

                                    </div>
                                    <div class="v21_3">

                                    </div>
                                    <div class="v21_5">

                                    </div>
                                    <div class="v21_7">

                                    </div>
                                    <div class="v21_9">

                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="chat-panel">
                            <?php
                                table_simetrical();
                            ?>
                        </div>
                        
                        <div id="chatsID" class="bottom">
                            <div class="v23_29">
                                <div class="v25_38">

                                </div>
                            </div>
                            <div class="v25_30">
                                <div class="v26_41">

                                </div>
                            </div>
                            <div class="v25_32">
                                <div class="v26_43">

                                </div>
                            </div>
                            <div class="v25_34">
                                <div class="v26_45">

                                </div>
                            </div>
                            <div class="v25_36">
                                <div class="v26_47">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="message-send">
                <div class="v26_49">
                    <div class="v28_67"><a href="./login/logout.php" style="padding: 0px;" class="btn btn-danger">Log Off</a></div>  
                    <div class="v33_4"><?=$nick?></div>
                    <img class="v33_2 pb" src="<?=$pf->img?>" value="<?=$nick?>">
                </div>
                <div class="v8_3">    
                    <form class="file-form form" method="POST" name="fileF">
                        <label class="input-file panel-input">
                            <span>File</span>
                            <input type="file" name="file" id="file">
                        </label>
                        <select name="typeMedia" id="typeMedia" class="select">
                            <option value="file">File</option>
                            <option value="img">Image</option>
                            <option value="video">Video</option>
                            <option value="audio">Audio</option>
                        </select>  
                        <input type="hidden" name="server" id="serv1">
                        <input type="hidden" name="chat" id="chat1">
                    </form>
                    <form class="form" name="address" method="GET">
                        <input type="text" name="message" id="inpText" class="input-panel" placeholder="Input your text here">
                        <button type="submit" class="button">
                            Send
                        </button>
                    </form>
                </div>
                <div class="message-right-panel">
                    <div class="v32_4">

                    </div>
                    <div class="v32_6">

                    </div>
                    <div class="v32_8">

                    </div>
                    <div class="v32_10">

                    </div>
                    <div class="v32_12">

                    </div>
                </div>
            </div>
        </div>
        <div id="action" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Заголовок</h5>
                        <button type="button" class="close btn btn-danger" data-dismiss="modal">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Что вы хотите сделать</p>
                    
                        <select name="act" id="act">
                            <option value="del">Удалить сообщение</option>
                            <option value="edi">Измеинть сообщение</option>
                        </select>
                        <br>
                        <button type="button" class="btn btn-info" id="actB">Применить</button>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning close"  data-dismiss="modal">
                            Закрыть
                        </button>
                    </div>
                </div>
            </div>
        </div>  

        <div id="action_file" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Действие</h5>
                        <button type="button" class="close" data-dismiss="modal" id="cls2">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Что вы хотите сделать</p>
                    
                        <select name="act" id="act">
                            <option value="del">Удалить сообщение</option>
                        </select>
                        <br>
                        <button type="button" class="btn btn-info" id="actD">Применить</button>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning"  data-dismiss="modal" id="cls3">
                            Закрыть
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="chat" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Создание чата</h5>
                        <button type="button" class="close btn btn-danger" data-dismiss="modal" id="">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Название чата</p> <input type="text" id="chatName" name="chatName">
                        <br>
                        <button type="button" class="btn btn-info" id="chAdd">Применить</button>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning close"  data-dismiss="modal" id="cls3">
                            Закрыть
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="serva" class="modal modal-lg fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Создание сервера</h5>
                        <button type="button" class="close btn btn-danger" data-dismiss="modal" id="">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Название сервера</p> <input type="text" id="svName" name="chatName">
                        <br>
                        <button type="button" class="btn btn-info" id="svAdd">Применить</button>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning close"  data-dismiss="modal" id="cls3">
                            Закрыть
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card profile" id="profile">
            
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script type="text/javascript">
            const FLAGS = <?=$pf->flags?>;
        </script>
        <script type="text/javascript" src="profile.js"></script>
        <script type="text/javascript" src="lib.js"></script>
        <script type="text/javascript" src="file.js"></script>
        <script type="text/javascript" src="send.js"></script>
        <script type="text/javascript" src="chatadd.js"></script>
    </body>
</html>