<!-- 구글 검색 : galley board css => CSS Only Pinterest-like Responsive Board Layout - Boardz.css | CSS ... -->
<!-- 출처 : https://www.cssscript.com/css-pinterest-like-responsive-board-layout-boardz-css/ -->
<?php
ini_set('display_errors','On');
# TODO: MySQL 데이터베이스 연결 및 레코드 가져오기!
$connect = mysql_connect("localhost","UiHyeon","1350");
mysql_select_db("kuh_db", $connect);

if($connect->connect_errno){
    echo '[연결실패] : '.$connect->connect_error.'';
}    else {
    echo '[연결성공]';
}

// sql 쿼리 string 생성
if($_GET[func] = 'search') {
    $sql = "select * from boardz where title like '%$_POST[search]%'";
}
else{
    $sql = "select * from boardz ";
}

// sql 쿼리 실행
$result = mysql_query($sql,$connect) or exit(mysql_error());
$row = mysql_fetch_array($result);


?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8"> 

    <title>Boardz Demo</title>
    <meta name="description" content="Create Pinterest-like boards with pure CSS, in less than 1kB.">
    <meta name="author" content="Burak Karakan">

    <meta name="viewport" content="width=device-width; initial-scale = 1.0; maximum-scale=1.0; user-scalable=no" />
    <link rel="stylesheet" href="src/boardz.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/wingcss/0.1.8/wing.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="seventyfive-percent  centered-block">
        <!-- Sample code block -->
        <div>    
            <hr class="seperator">

            <!-- Example header and explanation -->
            <div class="text-center">
                <h2>Beautiful <strong>Boardz</strong></h2>
                <div style="display: block; width: 50%; margin-right: auto; margin-left: auto; position: relative;">
                    <form class="example" action="board.php?func=search" method="post">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>

            <!--<hr class="seperator fifty-percent">-->

            <!-- Example Boardz element. -->
            <?php
                $num = mysql_num_rows($result);

            echo (" <div class=\"boardz centered-block beautiful\">
                <ul> ");
                for($idx = 1; $idx <=($num/3 + ($num%3 >= 1 ? 1 : 0)); $idx++){
                    echo (" <li>
                        <h1>$row[title]</h1>
                        <img src=$row[image_url] alt=\"demo image\"/>
                    </li> ");

                    $row = mysql_fetch_array($result);
                    }

                echo (" </ul> 
                         <ul> ");

                for($idx = 1; $idx <=($num/3 + ($num%3 >= 2 ? 1 : 0)); $idx++){
                    echo (" <li>
                        <h1>$row[title]</h1>
                        <img src=$row[image_url] alt=\"demo image\"/>
                    </li> ");

                    $row = mysql_fetch_array($result);
                    }

                echo (" </ul>
                         <ul>");

                for($idx = 1; $idx <= ($num/3); $idx++){
                    echo (" <li>
                        <h1>$row[title]</h1>
                        <img src=$row[image_url] alt=\"demo image\"/>
                    </li> ");
                    }
                echo (" </ul>
                        </div> ");

            ?>
        </div>

        <hr class="seperator">

    </div>
</body>
</html>