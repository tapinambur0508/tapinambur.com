<?php
    $title = 'tapinambur - '.ucfirst($_GET["href"]);
    require_once 'app/header.php';
    require_once 'app/include/function.php';
    echo '<link href="public/css/news-style.css" rel="stylesheet">';
?>

<a class="fa fa-chevron-up" aria-hidden="true" id="up" title="Вгору"></a>

<!-- Container -->
<div id="myContainer"> 
  <?php
    $count = 6;
    $publication = getPublicationNews($_GET["href"], 0, $count); 
    $publication_count = getCountPublicationNews($_GET["href"]);
  ?>

  <div class="row">
    <div class="cols col-12">
      <h1>
        <?php 
          if ($_GET["href"] == 'cars') {
            echo('Автомобілі');
          }
        ?>
    </div>

    <?php foreach($publication as $item): ?>
      <div class="cols col-4">
        <img src="<?=$item['image'] ?>">
        <h2><?=$item['header'] ?></h2>
        <p><?=$item['content'] ?></p>
        <a href="/article.php?id=<?=$item['id'] ?>">
          <input type="button" value="View details&nbsp;&raquo;" class="btn btn-default">
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div> 

<p align="center"><input type="button" value="Завантажити ще" class="btn btn-default btn-lg" name="load_news"></p>

<div id="money">
  <!-- Реклама -->
</div>

<script type="text/javascript"> 
  $(document).ready(function () {
    var pos = <?php echo $count; ?>;
    var count = <?php echo $count; ?>;
    var news_count = <?php echo $publication_count; ?>;
    var href = "<?php echo ($_GET['href']); ?>";
    var str = '';

    if (count >= news_count) {
      $("input[name='load_news']").hide();
    }

    $("input[name='load_news']").bind("click", function () {
      $.ajax ({
        url: 'edition.php',   
        type: 'POST',   
        data: {'href' : href, 'pos' : pos, 'count' : count}
      }).done(function (data) {
        data = $.parseJSON(data);

        if (data.length > 0) {

          $.each(data, function(index, data) {
            str += "<div class='cols col-4'>";
              str += "<img src=" + data.image + ">";
              str += "<h2>" + data.header + "</h2>";
              str += "<p>" + data.content + "</p>";
              str += "<a href='/article.php?id=" + data.id + "'>";
              str += "<input type='button' value='View details&nbsp;&raquo;'' class='btn btn-default'>";
              str += "</a>"    
            str += "</div>";
          });

          pos += count;

          if (pos >= news_count) {
            $("input[name='load_news']").hide();
          }

          document.getElementById("myContainer").innerHTML += "<div class='row'>" + str + "</div>";
          str = '';
        } 
      });
    });

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
</script>

<?php
    require_once 'app/footer.php';
?>