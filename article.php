<?php
  require_once 'app/include/function.php';
  $article = getArticle($_GET["id"]);
  $news = getNews(0, getCountNews()); 
  $title = $article["header"];
  require_once 'app/header.php'; 
  $visits = $article["visits"];
  setVisits($_GET["id"], $visits++);
  echo '<link href="public/css/article-style.css" rel="stylesheet">';
?>

<!-- Cover -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img class="first-slide" src="<?= $article['image'] ?>" alt="<?= $article['header'] ?>">
      <div class="container">
        <div class="carousel-caption">
         <p><?= $article["header"] ?></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Container -->
<div id="myContainer"> 
  <div class="row">
    <div class="cols col-9">
      <?= $article["full_content"] ?>

      <div class="cols col-6">
        <?php if ($news[count($news) - 1]['id'] < $_GET["id"]): ?>
          <?php $header = getHeader($_GET["id"] - 1) ?>
            <a href="/article.php?id=<?= ($_GET["id"] - 1) ?>">
              <input type="button" value="<?=$header['header'] ?>&nbsp;&raquo;" class="btn btn-success" align="center">
            </a>
        <?php else: ?>
          <p align="center">&nbsp;&nbsp;&nbsp;</p>
        <?php endif; ?>
      </div>
      <div class="cols col-6">
        <?php if ($news[0]['id'] > $_GET["id"]): ?>
            <?php $header = getHeader($_GET["id"] + 1) ?>
            <a href="/article.php?id=<?= ($_GET["id"] + 1) ?>">
              <input type="button" value="<?=$header['header'] ?>&nbsp;&raquo;" class="btn btn-success" align="center">
            </a>
        <?php else: ?>
          <p align="center">&nbsp;&nbsp;&nbsp;</p>
        <?php endif; ?>
      </div>
    </div>
    
    <div class="cols col-3">
      <p align="center"><img src="public/images/banner-1.jpg"></p>
    </div>

    <div class="cols col-12">
      <h1>Читайте також:</h1>
    </div>

    <?php 
      $key_word = $article["key_word"];
      $model = $article["model"];
      $count = 0;
    ?>

    <?php foreach ($news as $item): ?>
      <?php if (($item["model"] == $model) && ($item["id"] != $_GET["id"])): ?>
        <?php if ($count < 3): ?>
          <div class="cols col-4">
            <img src="<?=$item['image'] ?>">
            <h2><?=$item["header"] ?></h2>
            <p><?=$item["content"] ?></p> 
            <a href="/article.php?id=<?=$item['id'] ?>">
              <input type="button" value="View details&nbsp;&raquo;" class="btn btn-danger" align="center">
            </a>
          </div>
        <?php endif; ?>
        <?php $count++; ?>
      <?php endif; ?>
    <?php endforeach; ?>

    <!-- Comments -->
    <div class="cols col-12">
      <hr noshade size="2" />

      <?php
        if (isset($_COOKIE['login'])) {
          echo(
                '<textarea class="form-control" rows="3" placeholder="Ваш комментарий:" name="comments"></textarea>
                <input type="button" name="send" value="Відправити" class="btn btn-primary" align="center">'
              );
        } else {
          echo(
                '<p align="center">Для того щоб написати комментарии потрібно <a href="/signIn.php"><b>Увійти</b></a> або 
                <a href="/signUp.php"><b>Зареєструватися</b></a></p>'
              );
        }
      ?>
      
    </div>

    <!-- enter cooments -->
    <div class="comments">
      <?php
        $comments = getComments($_GET["id"]);
      ?>

      <?php foreach ($comments as $item): ?>
        <div class="cols col-12">
          <p><?=$item['user_id']; ?>&nbsp;&nbsp;&nbsp;<?=$item['date']; ?></p>
          <p><?=$item['text']; ?></p>
          <p>
            <i class="fa fa-thumbs-up" aria-hidden="true" 
              onclick="thumbsUp(<?=$item['id']; ?>, <?=$item['like_count']; ?>, this)">
                &nbsp;<?=$item['like_count']; ?></i>&nbsp;

            <i class="fa fa-thumbs-down" aria-hidden="true" 
              onclick="thumbsDown(<?=$item['id']; ?>, <?=$item['dislike_count']; ?>, this)">
                &nbsp;<?=$item['dislike_count']; ?></i>&nbsp;

            <i class="fa fa-comment" aria-hidden="true"></i>&nbsp;
            <i class="fa fa-share" aria-hidden="true"></i>&nbsp;
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div> 

<div id="money">
  <!-- Реклама -->
</div>

<script>
  function thumbsUp(id, value, element) {
    value++;
    $(element).html("&nbsp;" + value);

    $.ajax({
      url: "setLike.php",
      type: "POST",
      data: {'value' : value, 'type' : 'like', 'id' : id}
    });
  }

  function thumbsDown(id, value, element) {
    value++;
    $(element).html("&nbsp;" + value);

    $.ajax({
      url: "setLike.php",
      type: "POST",
      data: {'value' : value, 'type' : 'dislike', 'id' : id}
    });
  }

  $(document).ready(function () {
    window.onscroll = function() {
      var scrolled = window.pageYOffset;
      
      if (scrolled > 600) {
        if (($(document).width() >= 300) && ($(document).width() <= 580)) {
          up.classList.add('fa-2x');
        } else if (($(document).width() >= 581) && ($(document).width() <= 799)) {
          up.classList.add('fa-3x');
        } else if (($(document).width() >= 800) && ($(document).width() <= 1400)) {
          up.classList.add('fa-4x');
        } else if (($(document).width() >= 1401) && ($(document).width() <= 2000)) {
          up.classList.add('fa-5x');
        }

        $("#up").show();
      } else {
        $("#up").hide();
      }
    }

    $("#up").bind("click", function () {
      var scroll = window.pageYOffset;

      var timerId = setInterval(function() {
        $(document).scrollTop(scroll);
        scroll -= 90; 

        if (scroll < 0) {
          clearInterval(timerId);
          window.scrollTo(0, 0);
        }
      }, 10);
    });
  });

  $("input[name='send']").click(function() {
    var article_id = <?php echo($_GET['id']); ?>;
    var user_id = <?php echo("12"); ?>;
    var message = $("textarea[name='comments']").val();

    if (message.length != 0) {
      $.ajax({
        url: "setComment.php",
        type: "POST",
        data: {'article_id' : article_id, 'user_id' : user_id, 'message' : message}
      }).done(function (data) {
        var str = "<div class='cols col-12'>";
        str += "<p>" + "<?php echo($_COOKIE['login']); ?>" + "&nbsp;&nbsp;&nbsp;" + data + "</p>"
        str += "<p>" + message + "</p>";
        str += "<p>";

        str += "<i class='fa fa-thumbs-up' aria-hidden='true'" + 
              "onclick='thumbsUp(<?=$item["id"]; ?>, <?=$item["like_count"]; ?>, this)'>" +
               "&nbsp;<?=$item['like_count']; ?></i>&nbsp;";

        str += "<i class='fa fa-thumbs-down' aria-hidden='true'" + 
              "onclick='thumbsDown(<?=$item["id"]; ?>, <?=$item["dislike_count"]; ?>, this)'>" +
               "&nbsp;<?=$item['dislike_count']; ?></i>&nbsp;";

        str += "<i class='fa fa-comment' aria-hidden='true'></i>&nbsp;";
        str += "<i class='fa fa-share' aria-hidden='true'></i>&nbsp;";
        str += "</p>";
        str += "</div>";

        $(".comments").prepend(str);
      }); 

      $("textarea[name='comments']").val("");
    }

    $("input[name='send']").blur();
  });
</script>

<?php
  require_once 'app/footer.php';
?>


