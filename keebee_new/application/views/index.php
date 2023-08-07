<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Meee</title>
        <link href="https://fonts.googleapis.com/css?family=Numans&display=swap" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <style type="text/css">
            html {
                scroll-behavior: smooth;
            }
            body{
                font-family: 'Numans', sans-serif;
            }
            #container{width: 90%;margin: auto}
            #container h1{text-align: center}
            .table-responsive:first-child{margin-top: 0 !important}
            .table-responsive{border-collapse: collapse;width: 100%;margin: 20px 0}
            .table-responsive td{border: 1px solid silver;padding: 6px}
            .table-responsive tr:first-child td{font-weight: bold;background: #EE2324;color: #fff}
            .leftbar{width: 30%;display: inline-block;     margin-right: 20px;   background: #fdffe8;}
            .rightbar{width: 65%;display: inline-block;vertical-align: top;}
            .leftbar ul{padding: 0;margin: 0}
            .leftbar ul li{    list-style: none;
                               line-height: 35px;
                               padding: 0 10px;
                               height: 35px;
                               font-size: 13px;
                               border-bottom: 1px solid silver;
            }
            .leftbar ul li a{text-decoration: none;
                             color: #111;
                             font-weight: bold;
                             outline: none;
                             display: block;}
            p{margin: 0 0 10px 0;    font-size: 14px;
            }
            b{    font-size: 13px;
            }
            em{font-size: 12px;}

            #top_scroll_btn {
                display: none;
                position: fixed;
                bottom: 20px;
                right: 30px;
                z-index: 99;
                font-size: 18px;
                border: none;
                outline: none;
                background: #EE2324;
                color: white;
                cursor: pointer;
                padding: 8px 10px;
                border-radius: 50%;
                opacity: 0.7;
                border: 2px solid #fff;
            }

            #top_scroll_btn:hover {
                background: #EE2324;
                opacity: 1;
            }
        </style>
    </head>
    <body>
        <button id="top_scroll_btn" title="Go to top"><i class="fa fa-arrow-up"></i></button>

        <div id="container">
            <h1>Meee Api Document</h1>

            <div class="leftbar">
                <ul>
                    <?php
                    $apiids = 1;
                    foreach ($apis as $key => $api) {
                        ?>
                        <li><a href="#<?php echo $key; ?>"><?php echo $apiids . '. ' . $api['sidetitle']; ?></a></li>
                        <?php
                        $apiids++;
                    }
                    ?>
                </ul>
            </div>
            <div class="rightbar">
                <table class="table-responsive">
                    <tr>
                        <td>API BASE URL</td>
                        <td><?php echo base_url('user/') ?></td>
                    </tr>
                    <tr>
                        <td>Common Params</td>
                        <td>secretkey = VTTBD88NUPTGDQ85MEKA28CV4AGGRQTK</td>
                    </tr>
                    <tr>
                        <td>METHOD</td>
                        <td>POST</td>
                    </tr>
<!--                    <tr>
                        <td>Last Modified</td>
                        <td><?php echo $last_modified; ?></td>
                    </tr>-->

                </table>
                <?php
                $apiid = 1;
                foreach ($apis as $key => $api) {
                    ?>
                    <table id="<?php echo $key ?>" class="table-responsive">
                        <tr>
                            <td>API <?php echo $apiid; ?></td>
                            <td><?php echo $api['title']; ?></td>
                        </tr>
                        <tr>
                            <td>API Name</td>
                            <td><p><em>The URL structure (path only, no base url) </em></p>
                                <?php echo '<font color="#EE2324"><b>' . $key . '</b></font>'; ?></td>
                        </tr>
                        <tr>
                            <td>Params</td>
                            <td>
                                <?php if (count($api['params']) > 0) { ?>
                                    <p><em>If URL params exist, specify them in accordance with name mentioned in URL section</em></p>

                                    <?php
                                    foreach ($api['params'] as $keys => $apiparams) {
                                        if (isset($apiparams['Param'])) {
                                            echo '<b>' . $apiparams['Param'];
                                            if ($apiparams['Type'] != "")
                                                echo '= [' . $apiparams['Type'] . ']</b><br/>';
                                            if ($apiparams['Example'] != "")
                                                echo '<em>Example : <b>' . $apiparams['Example'] . '</b></em>';
                                            echo '<br/><br/>';
                                        }
                                    }
                                }
                                ?>
                    </table>
                    </td>
                    </tr>

                    </table>
                    <?php
                    $apiid++;
                }
                ?>
            </div>
        </div>
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
        <script>
            $(window).scroll(function () {
                var height = $(window).scrollTop();
                if (height > 100) {
                    $('#top_scroll_btn').fadeIn();
                } else {
                    $('#top_scroll_btn').fadeOut();
                }
            });
            $(document).ready(function () {
                $("#top_scroll_btn").click(function (event) {
                    event.preventDefault();
                    $("html, body").animate({scrollTop: 0}, "slow");
                    return false;
                });

            });
        </script>
    </body>
</html>