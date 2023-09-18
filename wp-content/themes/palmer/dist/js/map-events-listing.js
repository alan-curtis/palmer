$(document).ready(function(){

	if($('#wpgmza_map_2').length==1){
    console.log($('#wpgmza_map_2').length);

	}

});


function send_events_ajax_request(events,location){
//var ajaxscript = { ajax_url : 'http://palmer.local/wp-admin/admin-ajax.php' } ;
var jsonData = {'location': location,'events' : events};
//var data= JSON.stringify(jsonData);
jQuery.ajax({
      url: ajaxscript.ajax_url,
      type: "POST",
      data: {
        action : "map_events_listing",
        data : jsonData,
      },
    
    success: function(response){
        $("#event-list").empty();
       // $(".no-results").empty();
       //console.log(response);
       var obj = JSON.parse(response);
       //console.log(obj);
       if (obj != "no_result") {
        
        var html=``;
         
        for (var i = 0; i < obj.length; i++) {
         //console.log(obj[i].event_start_date);
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
         html += `<div class="event d-md-flex" data-id="${obj[i].event_id}">
         <div class="date_wrap">
         <div class="date">
         <p class="month text-center color-purple mb-0">${obj[i].event_start_month}</p>
         <p class="day text-center color-purple">${obj[i].event_start_day}</p>
         </div>
         
         </div>  
         <div class="title_wrap">
         <p class="${campClass} color-purple text-uppercase mb-0">${campus}</p>        
         <a href="${obj[i].post_link}" class="title color-purple text-decoration-none">${title}</a>
         <p class="timings">${obj[i].event_start_time} - ${obj[i].event_end_time} (CT)  ${eve_location}</p>
         <a target="_blank" href="${type_link}" class="${cat} text-decoration-none">${type}</a>
         </div>
         <div class="calender">
         <a id="addCal${i}" class="add_to_calender text-decoration-none" data-atc-start="${obj[i].event_start_date}" data-atc-end="${obj[i].event_end_date}" data-atc-title="${title}" data-atc-location="${obj[i].event_location}"  data-atc-description="The event description here">+ Add to calendar</a>
         <!-- init Add to calendar -->
         <script>
         new atc(document.querySelector('#addCal${i}'));
         </script>
         </div>
         </div>`;  

           

         //$("#event-list").append(html);
       }

        //html +=``;
    

    //console.log('eventshtml : '+ html);
    $( '#event-list' ).append( html );
}
else{
var html = "<ul class='no_events_found'><li class='alert alert-warning no-result text-center my-5'>No events found. Try different location.</li></ul>";
//$( html ).insertAfter( $( "#wpgmza_map_2" ) );
$( '#event-list' ).append( html );
}


    },
});


}


//on load send ajax request
$(window).on('load',function(){

//setTimeout(function(){
    if($('#wpgmza_map_2').length==1){
    console.log($('#wpgmza_map_2').length);
send_events_ajax_request();
    }
    
//},100);


});

 jQuery(document).ready(function(){

            
               var html_e='';
                html_e +=`<style>
        .wpgmza-infowindow p[data-custom-field-name="events_ids"]{
            display:none;
        }
        .no_events_found{
            padding:0 !important;
            list-style:none !important;
        }
        </style>
        <script src="https://cdn.addevent.com/libs/atc/1.6.1/atc.min.js"></script>
        <section class="event-listing">
        <div class="row">
            <div class="container">
              <div class="col-12">
                    <div id="event-list">
                    </div>
                </div>
            </div>
        </div>
</section>`;

$( html_e ).insertAfter( $( "#wpgmza_map_2" ) );

                jQuery('#wpgmza_map_2').on('click',function(){
               // jQuery('.wpgmza-infowindow p[data-custom-field-name="events_ids"]').hide();
                console.log('marker clicked');
                setTimeout(function(){
                //alert(jQuery('.wpgmza_infowindow_address').text());
                send_events_ajax_request(jQuery('.wpgmza-infowindow p[data-custom-field-name="events_ids"]').text(),jQuery('.wpgmza-infowindow .wpgmza_infowindow_address').text());    
                },100);
            });     
            });