
function send_institutions_ajax_request(institution,campus,agreement){
//alert(institution); alert(campus); alert(agreement);
var jsonData = {'institution': institution,'campus' : campus,'agreement' : agreement};
//var data= JSON.stringify(jsonData);
jQuery.ajax({
  url: ajaxscript.ajax_url,
  type: "POST",
  data: {
    action : "institutions_listing",
    data : jsonData,
},

success: function(response){
    $(".institutions-section .institutions_listing #accordion").empty();
       //console.log(response);
       var obj = JSON.parse(response);
       console.log(obj);
       if (obj != "no_result") {

        var markers_array='';
        markers_array += `[`;

        //Prepare Addresses array to pass into map

        for (var i = 0; i < obj.length; i++) {
            markers_array += `{"title": '${[obj[i].institution_title]}',
            "lat": '${[obj[i].latitude]}',
            "lng": '${[obj[i].longitude]}',
            "address_title": '${[obj[i].address_title]}',
            "street_number" : '${[obj[i].street_number]}',
            "street_name" : '${[obj[i].street_name]}',
            "city" : '${[obj[i].city]}',
            "state" : '${[obj[i].state]}',
            "post_code" : '${[obj[i].post_code]}',
            "state_short" : '${[obj[i].state_short]}',
            "agreement" : '${[obj[i].agreement]}',
            "campus" : '${[obj[i].campus]}',
        },`;
    }

    markers_array += `]`;
        //console.log(markers_array);

        var html=``;
        var s=1;  

        html+=`<script>
        var markers = ${markers_array};
        //      var markers = [
        // {
            //     "title": 'Aksa Beach',
            //     "lat": '19.1759668',
            //     "lng": '72.79504659999998',
            //     "description": 'Aksa Beach is a popular beach and a vacation spot in Aksa village at Malad, Mumbai.'
            // },
            // ];
            </script>`;


         for (var i = 0; i < obj.length; i++) {

         // Title
         var title = obj[i].institution_title;

         // Street address
         var street_address = obj[i].full_address;
         if (street_address) {
             var street_address_ = "<p class='street_address'>" +obj[i].full_address + "</p>";
         } else {
             var street_address_ = '';
         }

         // City and state
         var city_ = obj[i].city;
         var state_ = obj[i].state;
         if (city_ && state_) {
           var city_state = "<p><b>" + obj[i].city + ' , ' + obj[i].state + "</b></p>";
         } else  {
             var city_state = '';
         }

         // campus
         var campus_ = obj[i].campus;
         var campus_str = '';
         for(var n = 0; n < campus_.length; n++) {
             campus_str += "<li>" + campus_[n] + ' ' + obj[i].agreement + "</li>";
          }

       // <p class="street_address"> ${obj[i].street_number}  ${obj[i].street_name} ${obj[i].state_short} ${obj[i].post_code}</p>

       html += `<div data-id="${obj[i].institution_id}" class="panel panel-default col-lg-3 col-md-4 col-12 col-sm-6 text-sm-left text-center mb-4 collapsed">
       <h4 class="text-left d-flex align-items-center justify-content-between collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#collapse_${s}" aria-expanded="true">${title} 
       </h4>
       <div id="collapse_${s}" class="panel-collapse collapse">
       <div class="text-left my-5">
       ${street_address_}
       <p>Contact : <a href="mailto:${obj[i].contact_email}">${obj[i].contact_name}</a> (  ${obj[i].contact_caption} ) <a href="tel:${obj[i].contact_number}"> ${obj[i].contact_number}</a> </p> 
       ${city_state}
       <ul class="campus">${campus_str}</ul>
       </div>
       </div>
       </div>`;  

       s++;
   }

   html += `<script>

   var myStyle = [{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"}]},
   {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"}]}, 
   {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]},
   {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100}, {"lightness": 45}]},
   {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"}]}, 
   {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, 
   {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"}]}, 
   {"featureType": "water", "elementType": "all", "stylers": [{"visibility": "on"}, {"color": "#63639a"}]}];

   function LoadMap() {
    var mapOptions = {
        center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
        zoom: 3,
        mapTypeId: 'mystyle',
        mapTypeControl: false,
        zoomControl: true,
        zoomControlOptions: {
          position: google.maps.ControlPosition.LEFT_TOP,
      },
  };




  var map = new google.maps.Map(document.getElementById("institutionsMap"), mapOptions);

  map.mapTypes.set('mystyle', new google.maps.StyledMapType(myStyle, { name: 'My Style' }));

  //Create and open InfoWindow.
  var infoWindow = new google.maps.InfoWindow();

  for (var i = 0; i < markers.length; i++) {
    var data = markers[i];
    var myLatlng = new google.maps.LatLng(data.lat, data.lng);
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: data.title
    });

    //Attach click event to the marker.
    (function (marker, data) {
        google.maps.event.addListener(marker, "click", function (e) {
            //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
            infoWindow.setContent("<div class='googleMapinfowindow'><p class='title'>" + data.title + "</p><p class='street'>" + data.street_number + " " + data.street_name + " , " + data.state_short + " " + data.post_code  + "</p><p class='campus'><b>" + data.campus + " </b> " + data.agreement  + "</p></div>");
            infoWindow.open(map, marker);
        });
    })(marker, data);
}
}
LoadMap();
</script>`;


$( '.institutions-section .institutions_listing #accordion' ).append( html );
    //console.log('eventshtml : '+ html);
    
}
else{
    var html = "<div class='no_institutions_found col-12'><li class='alert alert-warning no-result text-center my-5'>No results. Please clear filters and try another search.</li></div>";
    $( '.institutions-section .institutions_listing #accordion' ).append( html );
}
},
});


}


//on load send ajax request
$(window).on('load',function(){
$("#campus_select option , #agree_select option").each(function() {
  $(this).siblings('[value="'+ this.value +'"]').remove();
});


 if($('.institutions-section').length==1){
    send_institutions_ajax_request();
    }

      
});

jQuery(document).ready(function(){
    jQuery('.institutions-section form').on('submit',function(e){
        e.preventDefault();
        var inst_select = $('.institutions-section form select#inst_select').val()
        var campus_select = $('.institutions-section form select#campus_select').val()
        var agree_select = $('.institutions-section form select#agree_select').val()
        send_institutions_ajax_request( inst_select , campus_select , agree_select );

    });     

    jQuery('.institutions-section form input[type="reset"]').on('click',function(e){
        setTimeout(function(){
         jQuery('.institutions-section form').submit();
     },100);
    }); 

});