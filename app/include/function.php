<?php
    class tapinambur {
        var $mysqli = false;

        function __construct() {
            $this->connectDB();
        }

        function connectDB() {
            $this->mysqli = new mysqli('localhost', 'vitalijm_98', 'vitalikm0508', 'vitalijm_tapinambur');
		    $this->mysqli->set_charset('utf8');
        }

        function disconnectDB() {
            mysqli_close($this->mysqli);
        }

        function getNews($pos, $count) {
            $result = $this->mysqli->query("SELECT `id`, `header`, `content`, `cover_image`, `views`, DATE_FORMAT(`date_time` , '%d.%m.%Y') AS `date` 
                                            FROM `news` 
                                            WHERE `publish` = 1 
                                            ORDER BY `date_time` DESC 
                                            LIMIT {$pos}, {$count}");

            return $this->resultToArray($result);
        }

        function getCountNews() {
            return mysqli_fetch_row($this->mysqli->query("SELECT count(`id`) FROM `news` WHERE `publish` = 1"))[0];
        }

        function getMostVisitNews($poss, $count) {
            $result = $this->mysqli->query("SELECT `id`, `header`, `content`, `cover_image`, `views`, DATE_FORMAT(`date_time` , '%d.%m.%Y') AS `date` 
                                            FROM `news` 
                                            WHERE `publish` = 1 
                                            ORDER BY `views` DESC 
                                            LIMIT {$poss}, {$count}");

            return $this->resultToArray($result);
        }

        function getPublication($href, $poss, $count) {
            $result = $this->mysqli->query("SELECT `id`, `header`, `content`, `cover_image`, `views`, DATE_FORMAT(`date_time` , '%d.%m.%Y') AS `date` 
                                            FROM `news` 
                                            WHERE `key_word` LIKE '$href' AND `publish` = 1 
                                            ORDER BY `date_time` DESC 
                                            LIMIT {$poss}, {$count}");

             return $this->resultToArray($result);
        }

        function getCountPublication($href) {
            return mysqli_fetch_row($this->mysqli->query("SELECT count(`id`) FROM `news` WHERE `key_word` AND `publish` = 1 LIKE '$href'"))[0];
        }

        function getPublicationName($href) {
            return mysqli_fetch_row($this->mysqli->query("SELECT `name` FROM `publications` WHERE `href` = '$href'"))[0];
        }

        function getArticle($id) {
            $result = $this->mysqli->query("SELECT `id`, `header`, `full_content`, `cover_image`, `views`, `date_time`, `key_word`, `source`
                                            FROM `news` 
                                            WHERE `id` = $id AND `publish` = 1");

            return $result->fetch_assoc();
        }

        function setVisits($article_id, $value, $ip, $browser) {
            $result = $this->mysqli->query("SELECT `id` FROM `visits` WHERE `article_id` = '$article_id' AND `ip` = '$ip' AND `date` = CURDATE()");

            if (mysqli_num_rows($result) == 0) {
                ++$value;
                $this->mysqli->query("INSERT INTO `visits` SET `article_id` = $article_id, `ip` = '$ip', `date` = CURDATE(), `browser` = '$browser'");
                $this->mysqli->query("UPDATE `news` SET `views` = $value WHERE `id` = $article_id");
            }

            return $value;
        }

        function needToUpdateArticle($article_id, $full_content) {
            $this->mysqli->query("INSERT INTO `need_to_update_articles` SET `full_content` = '$full_content', `article_id` = $article_id");

            return mysqli_insert_id($this->mysqli);
        }

        function getPrevNews($date_time) {
            return mysqli_fetch_row($this->mysqli->query("SELECT `id`, `header` FROM `news` WHERE `date_time` < '$date_time' AND `publish` = 1 ORDER BY `date_time` DESC"));
        }

        function getNextNews($date_time) {
            return mysqli_fetch_row($this->mysqli->query("SELECT `id`, `header` FROM `news` WHERE `date_time` > '$date_time' AND `publish` = 1"));
        }

        function getRandNews($id, $count) {
            $result = $this->mysqli->query("SELECT `id`, `header`, `content`, `cover_image`, `views`, DATE_FORMAT(`date_time` , '%d.%m.%Y') AS `date` 
                                            FROM `news` 
                                            WHERE `publish` = 1 AND `id` != $id AND DATE_ADD(DATE(`date_time`), Interval 10 DAY) >= CURDATE()
                                            ORDER BY RAND() 
                                            LIMIT $count");

            if (mysqli_num_rows($result) == 0) {
                return $this->getMostVisitNews(0, $count);
            }

            return $this->resultToArray($result);
        }

        function getPublications() {
            return $this->resultToArray($this->mysqli->query("SELECT * FROM `publications`"));
        }

        function resultToArray($result) {
            $array = array();

            while (($row = $result->fetch_assoc()) != false) {
                $array[] = $row;
            }

            return $array;
        }
    }

    function translit($insert) { 
        $insert = mb_strtolower($insert);
        $replase = array(
            'а'=>'a',
            'б'=>'b',
            'в'=>'v',
            'г'=>'h',
            'ґ'=>'g',
            'д'=>'d',
            'е'=>'e',
            'є'=>'ie',
            'ж'=>'zh',
            'з'=>'z',
            'и'=>'y',
            'і'=>'i',
            'ї'=>'yi',
            'й'=>'i',
            'к'=>'k',
            'л'=>'l',
            'м'=>'m',
            'н'=>'n',
            'о'=>'o',
            'п'=>'p',
            'р'=>'r',
            'с'=>'s',
            'т'=>'t',
            'у'=>'u',
            'ф'=>'f',
            'х'=>'kh',
            'ц'=>'c',
            'ч'=>'ch',
            'ш'=>'sh',
            'щ'=>'shch',
            'ъ'=>'j',
            'ь'=>'’',
            'ю'=>'iu',
            'я'=>'ya',
            ' '=>'-',
            ' - '=>'-',
            '_'=>'-',
            '.'=>'',
            ':'=>'',
            ';'=>'',
            ','=>'',
            '!'=>'',
            '?'=>'',
            '>'=>'',
            '<'=>'',
            '&'=>'',
            '*'=>'',
            '%'=>'',
            '$'=>'',
            '"'=>'',
            '\''=>'',
            '('=>'',
            ')'=>'',
            '`'=>'',
            '+'=>'',
            '/'=>'',
            '\\'=>''
        );

        $insert = preg_replace("/ + /", " ", $insert);
        $insert = strtr($insert, $replase);

        return $insert;
    }
?>