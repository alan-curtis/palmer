$(function () {
  $('input[name="daterange"]').daterangepicker(
  {
    locale: {
      format: "MMM DD",
    },
  },
  function (start, end, label) {
    localStorage.setItem(
      "start_event_filter_date",
      start.format("YYYY-MM-DD")
      );
    localStorage.setItem("end_event_filter_date", end.format("YYYY-MM-DD"));
    console.log(
      "A new date selection was made: " +
      start.format("YYYY-MM-DD") +
      " to " +
      end.format("YYYY-MM-DD")
      );
  }
  );

  //get all data of localstorage and create a object of that on submit of form
  $("#event-filter-form").submit(function (e) {
    $.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: formData,
      success: function (data) {
        $("#event-list").html(data);
      },
    });
  });

  function get_and_set_filter(id, filter_name) {
    $(`#${id}`).on("click", "li", function (e) {
      e.preventDefault();
      $(this).addClass("active").siblings().removeClass("active");
      if ($(this).hasClass("all_active")) {
        localStorage.setItem(filter_name, "all_active");
      } else {
        localStorage.setItem(filter_name, $(this).attr("data-slug"));
      }
    });
  }

  //on first load add active class to all_active element clear local storage for event_audience_value and event_audience_value and set to all_active
  setTimeout(() => {
    localStorage.setItem("event_audience_value", "all_active");
    localStorage.setItem("event_campus_value", "all_active");
    localStorage.setItem("start_event_filter_date", "2022-01-01");
    localStorage.setItem("end_event_filter_date", "2022-12-31");
    localStorage.setItem("event_types_filter", "");
    
  }, 100);

  get_and_set_filter("event-audience-filter", "event_audience_value");
  get_and_set_filter("event-campus-filter", "event_campus_value");

  //get selected value of search_event_types and save thaa in local storage
  $("#search_event_types").on("change", function (e) {
    e.preventDefault();
    localStorage.setItem("event_types_filter", $(this).val());
  });

  //function to send ajax request to event_ajax_filter
  function send_ajax_request() {
    var formData = {};
    formData.start_date = localStorage.getItem("start_event_filter_date");
    formData.end_date = localStorage.getItem("end_event_filter_date");
    formData.event_type = localStorage.getItem("event_types_filter");
    formData.event_audience = localStorage.getItem("event_audience_value");
    formData.event_campus = localStorage.getItem("event_campus_value");
    formData.page_number = localStorage.getItem("page_number");


    //console.log(formData);
    $.ajax({
      url: ajax_url,
      type: "POST",
      data: {
        action: "event_ajax_filter",
        data: formData,
      },
      success: function (response) {
         //console.log(response);
         $("#event-list").empty();
         $("#pagination_events").empty();
        //console.log(response);
        var obj = JSON.parse(response);
       // console.log(obj);
        if (obj != "no_result") {
         // var obj = JSON.parse(response);
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
          <script src="https://cdn.addevent.com/libs/atc/1.6.1/atc.min.js"></script>
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
        $("#events-center-page form").submit();
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

   </script>
   <style>
   .addeventatc .addeventatc_icon {
    display:none;
  }
  </style>
  `;

  $("#pagination_events").html(html_p);

}
        //console.log(html_p);

        for (var i = 0; i < obj.length; i++) {
         console.log(obj[i].event_start_date);
         var title = obj[i].event_title;
         var type='';
         var cat='';
         var type_link='';
         if(obj[i].type){
           type = obj[i].type;
           cat = 'category';
           type_link = obj[i].type_link;
         }
         var campus='';
         campClass='';
         if(obj[i].campus){
           campus = obj[i].campus;
           campClass = 'campus';
         }
         if(obj[i].event_location){
          var eve_location = '|' + obj[i].event_location;
         }
         else{
          var eve_location = '';
         }
         // var types = obj[i].type.split(',');
         html = `<div class="event d-md-flex" data-id="${obj[i].event_id}">
         <div class="date_wrap">
         <div class="date">
         <p class="month text-center color-purple">${obj[i].event_start_month}</p>
         <p class="day text-center color-purple">${obj[i].event_start_day}</p>
         </div>
         <p class="end_date color-purple">TO ${obj[i].event_end_month} ${obj[i].event_end_day}</p> 
         </div>  
         <div class="title_wrap">
         <p class="${campClass} color-purple text-uppercase">${campus}</p>        
         <a href="${obj[i].post_link}" class="title color-purple">${title}</a>
         <p class="timings">${obj[i].event_start_time} - ${obj[i].event_end_time} ${obj[i].timezone}  ${eve_location}</p>
         <a target="_blank" href="${type_link}" class="${cat}">${type}</a>
         </div>
         <div class="calender">
         <a id="addCal${i}" class="add_to_calender" data-atc-start="${obj[i].event_start_date}" data-atc-end="${obj[i].event_end_date}" data-atc-title="${title}" data-atc-location="${obj[i].event_location}"  data-atc-description="The event description here">+ Add to calendar</a>
         <!-- init Add to calendar -->
         <script>
         new atc(document.querySelector('#addCal${i}'));
         </script>
         </div>
         </div>`;     

         $("#event-list").append(html);
       }  
     }
     else {
      var html = "<li class='no-result text-center my-5'>No matching found. Try a different combination.</li>";
      $(".events_pagination").hide();
      $("#event-list").append(html);
    }
  },

});
}

function send_ajax_request_paginate() {

  jQuery.ajax({
    type: "post",
    dataType: "json",
    url: ajax_url,
    data: {
      action: "event_ajax_filter",
      data: formData,
    },
    success: function(msg){
      console.log(msg);
    }
  });

}  

$("#events-center-page form").submit(function (e) {
  e.preventDefault();
  send_ajax_request();
});

  //on click  type="reset" clear local storage for event_audience_value and event_audience_value and set to all_active set form to default value and send ajax request
  $("#events-center-page form").on("reset", function (e) {
    //alert('reset');
    e.preventDefault();
    localStorage.setItem("event_audience_value", "all_active");
    localStorage.setItem("event_campus_value", "all_active");
    //localStorage.setItem("event_types_filter", "all_active");
    var start = (new Date()).getFullYear() + "-01-01";
    localStorage.setItem("start_event_filter_date", start);
    var end = (new Date()).getFullYear() + "-12-31" ;
    localStorage.setItem("end_event_filter_date", end);
    $("#event-audience-filter li").removeClass("active");
    $("#event-campus-filter li").removeClass("active");
    $("#event-audience-filter li:first").addClass("active");
    $("#event-campus-filter li:first").addClass("active");
    $("#search_event_types").val("all_active");
    localStorage.setItem("event_types_filter", "");
    $('input[name="daterange"]').val('Jan 1 - Dec 31');
    $('#search_event_types option:first-child').attr('selected','selected');
    $("#events-center-page form").submit();
  });
});
$(window).on('load', function(){
    // your logic here`enter code here`
    // alert("sdf");
    localStorage.setItem( "page_number",1);
    $('.events_pagination').hide();
    if ($(window).width() < 768) {
      $('.events-center-template .events').hide();
      var get_html=$('#events-center-page form .row:nth-child(2) .campus-filter-wrapper').parent().html();
      console.log(get_html);
      $('#events-center-page form .row-1').append("<div class='col-lg-4 order-2'>"+get_html+"</div>");
    }
    else {
     $('.events-center-template .events').show();
   }
   setTimeout(function(){
     $("#events-center-page form").submit();
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

$(".events-center-template .header img").click(function(){
   //$('.events-center-template .events').show();
   //var src=$(this).attr('src');
   var sourc= this.src.substring(this.src.lastIndexOf('/') + 1);
   //console.log(src);
   if(sourc=='toggle.svg'){
    $('.events-center-template .events').show();
    $(this).attr('src',function(i,e){
      return $(this).attr('src').replace("toggle.svg","cross.svg");
    });
  }
  else if(sourc=='cross.svg'){
    $('.events-center-template .events').hide();
    $(this).attr('src',function(i,e){
      return $(this).attr('src').replace("cross.svg","toggle.svg");
    });
  }

});



