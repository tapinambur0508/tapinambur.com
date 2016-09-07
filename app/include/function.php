<?php
	require_once 'app/include/database.php';

    function getNews ($pos, $count) {
    	global $mysqli;
    	connectDB();
 
    	$result = $mysqli->query("SELECT * FROM news ORDER BY id DESC LIMIT {$pos}, {$count}");

    	closeDB();

    	return resultToArray($result);
    }

    function getCountNews () {
        global $mysqli;
        connectDB();

        $result = $mysqli->query("SELECT * FROM news");

        closeDB();

        return count(resultToArray($result));
    }

    function getChoiseNews () {
        // global $mysqli;
        // connectDB();

        // $result = $mysqli->query("SELECT * FROM news ORDER BY visit DESC");

        // closeDB();

        // return resultToArray($result);
    }

    function getMostVisitNews ($poss, $count) {
        global $mysqli;
        connectDB();

        $result = $mysqli->query("SELECT * FROM news ORDER BY visits DESC LIMIT {$poss}, {$count}");

        closeDB();

        return resultToArray($result);
    }

    function getPublicationNews ($href, $poss, $count) {
        global $mysqli;
        connectDB();

        $where = "WHERE key_word = '".$href."'";
        $result = $mysqli->query("SELECT * FROM news $where ORDER BY id DESC LIMIT {$poss}, {$count}");

        closeDB();

        return resultToArray($result);
    }

    function getCountPublicationNews ($href) {
        global $mysqli;
        connectDB();

        $where = "WHERE key_word = '".$href."'";
        $result = $mysqli->query("SELECT * FROM news $where");

        closeDB();

        return count(resultToArray($result));
    }

    function getArticle ($id) {
        global $mysqli;
        connectDB();

        $where = "WHERE id = ".$id;
        $result = $mysqli->query("SELECT * FROM news $where ORDER BY id DESC");

        closeDB();

        return $result->fetch_assoc();
    }

    function getComments ($article_id) {
        global $mysqli;
        connectDB();

        $where = "WHERE article_id = ".$article_id;
        $result = $mysqli->query("SELECT * FROM comments $where ORDER BY id DESC");

        closeDB();

        return resultToArray($result);
    }

    function setComment ($article_id, $user_id, $text) {
        global $mysqli;
        connectDB();

        $mysqli->query("INSERT INTO comments (`article_id`, `user_id`, `text`, `date`) 
            VALUES ('$article_id', '$user_id', '$text', '".date('d-m-Y H:i:s a')."')");

        closeDB();
    }

    function setLike ($value, $type, $id) {
        global $mysqli;
        connectDB();

        $where = "WHERE id = ".$id;

        if ($type == "like") {
            $mysqli->query("UPDATE comments SET like_count = '$value' $where");
        } else if ($type == "dislike") {
            $mysqli->query("UPDATE comments SET dislike_count = '$value' $where");
        }
        
        closeDB();
    }

    function setVisits ($id, $value) {
        // global $mysqli;
        // connectDB();

        // $mysqli->query("UPDATE news SET 'visits' = '$value' WHERE `id`='$id';");

        // closeDB();
    }

    function checkLogin ($login) {
        global $mysqli;
        connectDB();

        $result = $mysqli->query("SELECT name FROM users WHERE name = '$login'");

        closeDB();

        return $result->fetch_assoc();
    }

    function checkEmail ($email) {
        global $mysqli;
        connectDB();

        $result = $mysqli->query("SELECT email FROM users WHERE email = '$email'");

        closeDB();

        return $result->fetch_assoc();
    }

    function setUsers ($name, $email, $password) {
        global $mysqli;
        connectDB();

        $mysqli->query("INSERT INTO users (`name`, `password`, `email`, `reg_date`) 
            VALUES ('$name', '".md5($password)."', '$email', '".date('Y-m-d H:i:s')."')");

        closeDB();
    }

    function getUserName($email, $password) {
        global $mysqli;
        connectDB();

        $result = $mysqli->query("SELECT name FROM users WHERE email = '$email' AND password = '$password'");

        closeDB();

        return $result->fetch_assoc();
    }

    function getPublication () {
    	global $mysqli;
    	connectDB();

    	$result = $mysqli->query("SELECT * FROM publication");

    	closeDB();

    	return resultToArray($result);
    }

     function getHeader($id) {
        global $mysqli;
        connectDB();

        $where = "WHERE id = ".$id;
        $result = $mysqli->query("SELECT header FROM news $where");

        closeDB();

        return $result->fetch_assoc();
    }

    function resultToArray ($result) {
    	$array = array();

    	while (($row = $result->fetch_assoc()) != false) {
    		$array[] = $row;
    	}

    	return $array;
    }
?>