$(document).ready(function() {
	window.onscroll = function() {
    var scrolled = window.pageYOffset;
    
    if (scrolled > 200) {
      $("header, header .dropdown-menu").css("background-color", "rgba(255, 250, 250, 0.8)");
    } else {
      $("header, header .dropdown-menu").css("background-color", "rgba(255, 250, 250, 1)");
    }

    if (scrolled > 600) {
       $("#up").show();
    } else {
      $("#up").hide();
    }
  }

  $("#up").click(function() {
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

  $(".fix-full-content span").click(function() {
    $(".fix-full-content p, .full-content + p").hide("slow");
    $(".fix-full-content button[name='save'], .fix-full-content button[name='cancel']").show("slow");
    $(".full-content").css("background-color", "#FFEC8B");
    $(".full-content").attr("contenteditable", "true");

    var FULL_CONTENT = $(".full-content").html();

    $(".fix-full-content button[name='cancel']").click(function() {
      $(".full-content").html(FULL_CONTENT);
      $(".full-content").attr("contenteditable", "false");
      $(".full-content").css("background-color", "#fff");
      $(".fix-full-content button[name='save'], .fix-full-content button[name='cancel']").hide("slow");
      $(".fix-full-content p, .full-content + p").show("slow");
    });

    $(".fix-full-content button[name='save']").click(function() {   
      var id = $(this).attr("data-id");
      var fullContent = $(".full-content").html();

      $.ajax({
        url: '/public/php/update-article.php',
        type: "POST",
        data: {id, full_content : fullContent},
        success: function(data) {
          try {
            data = parseInt(data);

            if (data > 0) {
              alert("Дякуємо ==))");
              $(".full-content").attr("contenteditable", "false");
              $(".full-content").css("background-color", "#fff");
              $(".fix-full-content button[name='save'], .fix-full-content button[name='cancel']").hide("slow");
              $(".fix-full-content p, .full-content + p").show("slow");
            }
          } catch (error) {
            console.log(error);
          }
        }
      });
    }); 
  });
});

function getNews(pos, count, href) {
  $.ajax ({
    url: '/public/php/get-news.php',   
    type: 'POST',   
    data: {pos, count, href},
    success: function (data) {
      try {
        data = JSON.parse(data);
        var str = '';

        $.each(data, function(index, data) {
          str += '<div class="col-lg-4 col-sm-6 col-xs-12">';
            str += '<div class="image">';
              str += `<a href="/article/${translit(data.header)}/${data.id}"><img src="${data.cover_image}" alt="${data.header}"></a>`;
              str += `<p class="date">${data.date}</p>`;
              str += `<p class="views"><i class="fa fa-eye" aria-hidden="true"></i>${data.views}</p>`;
            str += '</div>';
            str += `<h2><a href="/article/${translit(data.header)}/${data.id}">${data.header}</a></h2>`;
            str += `<p>${data.content}</p>`;     
          str += '</div>';

          $("#myContainer .row-flex").append(str);
          str = '';
        });
      } catch(error) {
          console.log(error);
      }
    }
  });
}

function translit(insert) {
  var replase = {
    'а':'a',
    'б':'b',
    'в':'v',
    'г':'h',
    'ґ':'g',
    'д':'d',
    'е':'e',
    'є':'ie',
    'ж':'zh',
    'з':'z',
    'и':'y',
    'і':'i',
    'ї':'yi',
    'й':'i',
    'к':'k',
    'л':'l',
    'м':'m',
    'н':'n',
    'о':'o',
    'п':'p',
    'р':'r',
    'с':'s',
    'т':'t',
    'у':'u',
    'ф':'f',
    'х':'kh',
    'ц':'c',
    'ч':'ch',
    'ш':'sh',
    'щ':'shch',
    'ъ':'j',
    'ь':'’',
    'ю':'iu',
    'я':'ya',
    
    ' ':'-',
    ' - ':'-',
    '_':'-',
    
    '.':'',
    ':':'',
    ';':'',
    ',':'',
    '!':'',
    '?':'',
    '>':'',
    '<':'',
    '&':'',
    '*':'',
    '%':'',
    '$':'',
    '"':'',
    '\'':'',
    '(':'',
    ')':'',
    '`':'',
    '+':'',
    '/':'',
    '\\':''
  };

  return insert.toLowerCase().replace(/[А-яіІїЇєЄ\s]/g, function(a, b) {  
      return replase[a] || "";  
    }  
  );  
}