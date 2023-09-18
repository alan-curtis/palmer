          $(window).on('load',function(){
        localStorage.setItem('lib_location', '');
        localStorage.setItem('search_string', '');
        localStorage.setItem('lib_location_format', '');
      });

      $('.library-filter .tabs li.formatted').click(function(){
        $('.library-filter .tabs li').each(function(){
          $('.library-filter .tabs li').removeClass('active');
        });
        $(this).addClass('active');    
        localStorage.setItem('lib_location', undefined); 
        localStorage.setItem('lib_location_format', $(this).attr('format'));
      });

      $('.library-filter .tabs li.subs').click(function(){
        $('.library-filter .tabs li').each(function(){
          $('.library-filter .tabs li').removeClass('active');
        });
     //console.log($(this).attr('data-id'));
     $(this).addClass('active');    
     localStorage.setItem('lib_location', $(this).attr('data-id')); 
   });

      $(".library-filter form input[type=text]").on("change", function () {
        localStorage.setItem('search_string', $(this).val());
      });

      $('.library-filter form').on('submit',function(e){
        e.preventDefault();
        //console.log();
        localStorage.setItem('search_string', $('.library-filter form input').val());
        var loc='';
        var string_searched=localStorage.getItem('search_string');
        var location=localStorage.getItem('lib_location');
        var locationformat=localStorage.getItem('lib_location_format');
    //console.log('location:'+ location);
    //console.log('locationformat:'+ locationformat);
    if(location == 'undefined'){
      if(locationformat=='Audiobook'){
        locationformat='&format=Book&format=Video&format=Audiobook';
      }
      if(locationformat=='Jrnl'){
        locationformat='&format=Jrnl';
      }
      window.location = 'https://palmercollegelibrary.on.worldcat.org/search?queryString='+ string_searched +locationformat ;
        //alert('https://palmercollegelibrary.on.worldcat.org/search?queryString='+ string_searched +locationformat);
      }
      else{
        //alert('https://palmercollegelibrary.on.worldcat.org/search?queryString='+ string_searched +'&subformat=' + location);
        window.location = 'https://palmercollegelibrary.on.worldcat.org/search?queryString='+ string_searched +'&subformat=' + location ;
      }    
    });

      $('.library-filter form select').on('change',function(e){
        var option_selected =$(this).find(":selected").attr('data-id');
        if(option_selected=='Audiobook'){
          localStorage.setItem('lib_location', undefined); 
          localStorage.setItem('lib_location_format', $(this).find(":selected").attr('data-id'));
        }
        else if(option_selected=='Jrnl'){
          localStorage.setItem('lib_location', undefined); 
          localStorage.setItem('lib_location_format', $(this).find(":selected").attr('data-id'));
        }
        else{
          localStorage.setItem('lib_location_format', '');
          localStorage.setItem('lib_location', $(this).find(":selected").attr('data-id'));
        } 
      });