

function send_news_ajax_request(){
  var formData = {};
    formData.date = localStorage.getItem("news_date");
    formData.title = localStorage.getItem("news_title");
    formData.page_number = localStorage.getItem("page_number");
    formData.cat = localStorage.getItem("news_cat");

  $.ajax({
      url: ajax_url,
      type: "POST",
      data: {
        action: "news_ajax_filter",
        data: formData,
      },
      success: function (response) {
        $('#search_results').empty();
        $("#pagination_events").empty();
        var obj = JSON.parse(response);
        if (obj != "no_result") {
        var rc_pr_page = 7;
         var total_events = obj[0].total_events;
         console.log("rc_pr_page" + rc_pr_page);
         console.log("total_events" + total_events);
         var html = '';
         var html_p = '';

                  if(total_events > rc_pr_page) {
          var no_of_step = total_events/rc_pr_page;
          var no_cus = Math.ceil(no_of_step);
          html_p += "<ul class='page-numbers'>";
          for(var j = 1; j <= no_cus; j++) {
            html_p +="<li class='paginate_req' data-id='"+j+"'>"+j+"</li>";
          }
          html_p +='</ul>';
          html_p +=`
          <script>
          $('.events_pagination').show();
          $(".next_paginates ul li.last").click(function(){
           var total_pagination_numbers=$(".paginate_req").length;
           $(".paginate_req[data-id="+total_pagination_numbers+"]").click();
         })

         var cur_page=$(".page_input_value").val();
         //console.log(cur_page);
         $(".paginate_req").each(function(){
          //console.log($(this).html());
          if(cur_page == $(this).html()){
           $(this).addClass('active');
         }
       });
       $(".paginate_req").click(function() {
        $(".page_input_value").val($(this).html());
        localStorage.setItem( "page_number",$(this).html());
        //localStorage.setItem( "page_number",$(input[name="pg_number"]).val());
        $("#news-center-page form").submit();
      });

      if($(".paginate_req[data-id='1']").hasClass("active")){
       $(".prev_paginates ul li.first, .prev_paginates ul li.prev ").hide();
     }
     else{
      $(".prev_paginates ul li.first, .prev_paginates ul li.prev ").show();
    }
    var total_pagination_numbers=$(".paginate_req").length;
    if(total_pagination_numbers == cur_page){
     $(".next_paginates ul li.last, .next_paginates ul li.next ").hide();
   }
   else{
     $(".next_paginates ul li.last, .next_paginates ul li.next ").show();
   }



   console.log( 'pagination steps :' + jQuery('#pagination_events .page-numbers li.paginate_req').length );

   var total_steps=jQuery('#pagination_events .page-numbers li.paginate_req').length;

   $(".paginate_req").hide();

   $(".paginate_req").each(function(){


    if($(this).hasClass("active")){

      console.log('No of prev elements : ' + $(this).prevAll().length);

      window.count_of_prev_steps=$(this).prevAll().length;

      var current_page=$(this).attr("data-id");

      console.log('current page = ' + current_page);

      window.steps_visible = parseInt(current_page) + 4;
      if(count_of_prev_steps > 4){
      window.step_visible_backwards = parseInt(current_page) - 4;
      }

      //console.log('Next Steps to be visible = ' + steps_visible);
      //console.log('Prev Steps to be visible = ' + steps_visible_backwards);

    }



   });

    if(count_of_prev_steps > 4){
      console.log('steps visible : ' + steps_visible + ' , prev last step to be visible : ' + step_visible_backwards);
      }


    $(".paginate_req").each(function(){



    if($(this).attr('data-id') <= steps_visible){

    console.log($(this).attr('data-id'));

    $(this).show();

    }

    if(count_of_prev_steps > 4){
    if($(this).attr('data-id') < step_visible_backwards){
    $(this).hide();
    }
  }




   });


   </script>
  `;

  $("#pagination_events").html(html_p);

}
else{

           $(".events_pagination").hide();

}


              for (var i = 0; i < obj.length; i++) {
         var title = obj[i].event_title;
         var type='';
         var cat='';
         var cat_link='';
         if(obj[i].category){
           type = obj[i].category;
           cat = 'category';
           cat_link = obj[i].cat_link;
         }
         var campus='';
         campClass='';
         if(obj[i].campus){
           campus = obj[i].campus;
           campClass = 'campus';
         }
        var html = `
        <div class="row blog">
          <div class="col-lg-8 d-lg-flex flex-lg-column item order-2 order-lg-1">
          <p class="${campClass} color-purple text-uppercase">${campus}</p>
          <a href="${obj[i].post_link}" target="_blank" class="title color-purple">${obj[i].event_title}</a>
          <p class="${cat}">${type}</p>
          <div class="teaser">${obj[i].excerpt}</div>
          </div>
          <div class="col-lg-4 img_block order-1 order-lg-2"><img src="${obj[i].img_src}" alt="${obj[i].event_title}"></div>
          </div>`;
         $("#search_results").append(html);
       }
        }
        else{
           var html = "<li class='no-result text-center my-5'>No matching found. Try a different combination.</li>";
           $(".events_pagination").hide();
           $("#search_results").append(html);
        }

      },
  });
}

$("#news-center-page form").submit(function (e) {
  e.preventDefault();
  send_news_ajax_request();
});



 // function get_and_set_filter(id, filter_name) {
 //    $(`#${id}`).on("click", "li", function (e) {
 //      e.preventDefault();
 //      $(this).addClass("active").siblings().removeClass("active");
 //      if ($(this).hasClass("all_active")) {
 //        localStorage.setItem(filter_name, "all_active");
 //      } else {
 //        localStorage.setItem(filter_name, $(this).attr("data-slug"));
 //      }
 //    });
 //  }

   //get selected value of date and save that in local storage
  $("#date_selection").on("change", function (e) {
    e.preventDefault();
    if($(this).val()==''){
      var val='all';
      localStorage.setItem("news_date", val);
    }
    else{
      localStorage.setItem("news_date", $(this).val());
    }

  });

  $("input[type=text]").on("change", function () {
            localStorage.setItem('news_title', $(this).val());
        });

  //On page load
  $(window).on('load', function(){
    $('.events_pagination').hide();
    localStorage.setItem( "page_number",1);
    localStorage.setItem("news_date", "all");
    localStorage.setItem("news_title", "");

    $('.news-list .cats .listing li[data-id="all"]').addClass('active');
    localStorage.setItem("news_cat", $('.news-list .cats .listing li[data-id="all"]').attr('data-id'));

     setTimeout(function(){
     $("#news-center-page form").submit();
   },100);

  });



  $(".prev_paginates ul li.first").click(function(){
  $(".paginate_req[data-id='1']").click();
})




$(".next_paginates ul li.next").click(function(){
  //alert('next');
//$(".paginate_req").click();
$(".paginate_req").each(function(){
 if($(this).hasClass('active')){
  var cr_page='';
  cr_page=$(this).html();
  next_page = parseInt(cr_page)+1;
}
});
$(".paginate_req[data-id="+next_page+"]").click();
})

$(".prev_paginates ul li.prev").click(function(){
  //alert('next');
//$(".paginate_req").click();
$(".paginate_req").each(function(){
 if($(this).hasClass('active')){
  var cr_page='';
  cr_page=$(this).html();
  prv_page = parseInt(cr_page)-1;
}
});
$(".paginate_req[data-id="+prv_page+"]").click();
})


// Category selection
$('.news-list .cats .listing li').click(function(){
  $('.news-list .cats .listing li').each(function(){
  $(this).removeClass('active');
  });
  $(this).addClass('active');
localStorage.setItem("news_cat",$(this).attr('data-id'));
});
