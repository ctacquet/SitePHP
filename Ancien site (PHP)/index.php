<?php include "functions.php" ?>
<?=template_header();?>
    <body>
        <?php
        function pdo_connect_mysql() {
            $DATABASE_HOST = 'localhost';
            $DATABASE_USER = 'root';
            $DATABASE_PASS = 'root';
            $DATABASE_NAME = 'website_db';
            try {
                return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
            } catch (PDOException $exception) {
                // If there is an error with the connection, stop the script and display the error.
                die ('Failed to connect to database!');
            }
        }
        $pdo = pdo_connect_mysql();
        // Get the page via GET request (URL param: page), if non exists default the page to 1
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        // Number of records to show on each page
        $records_per_page = 5;
        // Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
        $stmt = $pdo->prepare('SELECT * FROM musics ORDER BY id LIMIT :current_page, :record_per_page');
        $stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
        $stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
        $stmt->execute();
        // Fetch the records so we can display them in our template.
        $musics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $num_musics = $pdo->query('SELECT COUNT(*) FROM musics')->fetchColumn();
        ?>
        <div class="content">
		    <h3>Index Page</h3>
			<div>
                <p>Services that are going to be supported :</p>
                <ul class="list links">
                    <li><a target="_blank" rel="noopener noreferrer" href="https://developer.spotify.com/documentation/web-api/">Spotify</a></li>
                    <li><a target="_blank" rel="noopener noreferrer" href="https://developers.deezer.com/api">Deezer</a></li>
                </ul>
            </div>
            <!-- Sample music
            <div class="music">
                <table>
                <tr>
                    <td class="td_music">
                        <div id="svg-timer">
                            <div class='svg-hexagonal-counter'>
                                <button class="button_timer" id="music">
                                    <h2>
                                        <i class='fas fa-play' style='color: rgb(104, 214, 198); padding-left:10px;'></i>
                                    </h2>
                                    <svg class='counter' x='0px' y='0px' viewBox='0 0 776 628' style="cursor:pointer;">
                                        <path class='track' d='M723 314L543 625.77 183 625.77 3 314 183 2.23 543 2.23 723 314z' style='stroke: #000000;'></path>
                                        <path class='fill' d='M723 314L543 625.77 183 625.77 3 314 183 2.23 543 2.23 723 314z' style='stroke: #000000;'></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td style="padding-left: 20px;">
                        
                    </td>
                </tr>
                </table>
            </div>
            <div class="music">
                <table>
                <tr>
                    <td class="td_music">
                        <div id="svg-timer2">
                            <div class='svg-hexagonal-counter'>
                                <button class="button_timer" id="music2">
                                    <h2>
                                        <i class='fas fa-play' style='color: rgb(104, 214, 198); padding-left:10px;'></i>
                                    </h2>
                                    <svg class='counter' x='0px' y='0px' viewBox='0 0 776 628' style="cursor:pointer;">
                                        <path class='track' d='M723 314L543 625.77 183 625.77 3 314 183 2.23 543 2.23 723 314z' style='stroke: #000000;'></path>
                                        <path class='fill' d='M723 314L543 625.77 183 625.77 3 314 183 2.23 543 2.23 723 314z' style='stroke: #000000;'></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td style="padding-left: 20px;">
                    
                    </td>
                </tr>
                </table>
            </div>
            -->
            <!--
            <div>
                <table style="margin-left: 100px;">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Title</td>
                        <td>Artist</td>
                        <td>Type</td>
                        <td>Additional</td>
                        <td>By</td>
                        <td>Created</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                </table>
            </div>
            -->
            <?php foreach ($musics as $music): ?>
            <div class="music">
                <table>
                <tr>
                    <td class="td_music">
                        <div id="svg-timer<?=$music['id']?>">
                            <div class='svg-hexagonal-counter'>
                                <button class="button_timer" id="music<?=$music['id']?>">
                                    <h2>
                                        <i class='fas fa-play' style='color: rgb(104, 214, 198); padding-left:10px;'></i>
                                    </h2>
                                    <svg class='counter' x='0px' y='0px' viewBox='0 0 776 628' style="cursor:pointer;">
                                        <path class='track' d='M723 314L543 625.77 183 625.77 3 314 183 2.23 543 2.23 723 314z' style='stroke: #000000;'></path>
                                        <path class='fill' d='M723 314L543 625.77 183 625.77 3 314 183 2.23 543 2.23 723 314z' style='stroke: #000000;'></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td style="padding-left: 20px; width: 100%;">
                        <table>
                            <tbody>
                                <tr>
                                    <td style="padding-right: 50px;"><?=$music['title']?></td>
                                    <td><?=$music['type']?></td>
                                </tr>
                                <tr>
                                    <td> -  <?=$music['artist']?></td>
                                    <td style="padding-left: 16px; font-size: 12px;"><?=$music['additional']?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="right">
                            <td><?=$music['by']?></td>
                            <td><?=$music['created']?></td>
                            <td class="actions">
                                <a href="update.php?id=<?=$music['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                                <a href="delete.php?id=<?=$music['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                            </td>
                        </table>
                    </td>
                </tr>
                </table>
            </div>
            <?php endforeach; ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                <a href="index.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
                <?php endif; ?>
                <?php if ($page*$records_per_page < $num_musics): ?>
                <a href="index.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
                <?php endif; ?>
            </div>

        </div>

        <script type="text/javascript">
            $('#music').click(function() {
                $('#music').remove();
                $('#svg-timer1').empty();
                $('#svg-timer1').svgTimer({
                    time: 10,
                    direction: 'backward',
                    transition: 'linear'
                });
            });
            $('#music2').click(function() {
                $('#music2').remove();
                $('#svg-timer2').empty();
                $('#svg-timer2').svgTimer({
                    time: 10,
                    direction: 'backward',
                    transition: 'linear'
                });
            });
            (function() {
                if (!localStorage.getItem('cookieconsent')) {
                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var data = JSON.parse(request.responseText);
                            var eu_country_codes = ['AL','AD','AM','AT','BY','BE','BA','BG','CH','CY','CZ','DE','DK','EE','ES','FO','FI','FR','GB','GE','GI','GR','HU','HR','IE','IS','IT','LT','LU','LV','MC','MK','MT','NO','NL','PO','PT','RO','RU','SE','SI','SK','SM','TR','UA','VA'];
                            if (eu_country_codes.indexOf(data.countryCode) != -1) {
                                document.body.innerHTML += '\
                                <div class="cookieconsent" style="position:fixed;padding:20px;left:0;bottom:0;background-color:#000;color:#FFF;text-align:center;width:100%;z-index:99999;">\
                                    This site uses cookies. By continuing to use this website, you agree to their use. \
                                    <a href="#" style="color:#CCCCCC;">I Understand</a>\
                                </div>\
                                ';
                                document.querySelector('.cookieconsent a').onclick = function(e) {
                                    e.preventDefault();
                                    document.querySelector('.cookieconsent').style.display = 'none';
                                    localStorage.setItem('cookieconsent', true);
                                };
                            }
                        }
                    };
                    request.open('GET', 'http://ip-api.com/json', true);
                    request.send();
                }
            })();
        </script>
        <script src="js/modal.js"></script>

<?=template_footer();?>
