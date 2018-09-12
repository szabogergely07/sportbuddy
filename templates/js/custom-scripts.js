(function($) {
    
  'use strict';


  /**
   * =====================================
   * Function for windows height and width      
   * =====================================
   */
  function windowSize( el ) {
    var result = 0;
    if("height" == el)
        result = window.innerHeight ? window.innerHeight : $(window).height();
    if("width" == el)
      result = window.innerWidth ? window.innerWidth : $(window).width();

    return result; 
  }


  /**
   * =====================================
   * Function for email address validation         
   * =====================================
   */
  function isValidEmail(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
  };


  /**
   * =====================================
   * Function for windows height and width      
   * =====================================
   */
  function deviceControll() {
    if( windowSize( 'width' ) < 768 ) {
      $('body').removeClass('desktop').removeClass('tablet').addClass('mobile');
    }
    else if( windowSize( 'width' ) < 992 ){
      $('body').removeClass('mobile').removeClass('desktop').addClass('tablet');
    }
    else {
      $('body').removeClass('mobile').removeClass('tablet').addClass('desktop');
    }
  }




  $(window).on('resize', function() {

    deviceControll();

  });



  $(document).on('ready', function() {

    deviceControll();



    /**
     * =======================================
     * Top Navigaion Init
     * =======================================
     */
    var navigation = $('#js-navbar-menu').okayNav({
      toggle_icon_class: "okayNav__menu-toggle",
      toggle_icon_content: "<span /><span /><span /><span /><span />"
    });



    /**
     * =======================================
     * Top Fixed Navbar
     * =======================================
     */
    $(document).on('scroll', function() {
      var activeClass = 'navbar-home',
          ActiveID        = '.main-navbar-top',
          scrollPos       = $(this).scrollTop();

      if( scrollPos > 10 ) {
        $( ActiveID ).addClass( activeClass );
      } else {
        $( ActiveID ).removeClass( activeClass );
      }
    });




    /**
     * =======================================
     * NAVIGATION SCROLL
     * =======================================
     */
    var TopOffsetId = '.navbar-brand';
    $('#js-navbar-menu').onePageNav({
        currentClass: 'active',
        scrollThreshold: 0.2, // Adjust if Navigation highlights too early or too late
        scrollSpeed: 1000,
        scrollOffset: Math.abs( $( TopOffsetId ).outerHeight() - 1 )
    });

    $('.btn-scroll a, a.btn-scroll').on('click', function (e) {
      e.preventDefault();

      var target = this.hash,
          scrollOffset = Math.abs( $( TopOffsetId ).outerHeight() ),
          $target = ( $(target).offset() || { "top": NaN }).top;

      $('html, body').stop().animate({
        'scrollTop': $target - scrollOffset
      }, 900, 'swing', function () {
        window.location.hash = target;
      });

    });



    /**
     * =======================================
     * PopUp Item Script
     * =======================================
     */
    $('.popup-video').magnificPopup({
      //disableOn: 700,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: true,
      fixedContentPos: true
    });




     /**
     * =======================================
     * TESTIMONIAL SYNC WITH CLIENTS
     * =======================================
     */
    var testimonialSlider = $(".testimonial-wrapper"); // client's message
    testimonialSlider.owlCarousel({
      singleItem :        true,
      autoPlay :          3000,
      slideSpeed :        500,
      paginationSpeed :   500,
      autoHeight :        false,
      navigation:         false,
      pagination:         true,
      // transitionStyle:    "fade"
    });




    /**
     * ============================
     * CONTACT FORM 2
     * ============================
    */
    $("#contact-form").on('submit', function(e) {
      e.preventDefault();
      var success = $(this).find('.email-success'),
        failed = $(this).find('.email-failed'),
        loader = $(this).find('.email-loading'),
        postUrl = $(this).attr('action');

      var data = {
        name: $(this).find('.contact-name').val(),
        email: $(this).find('.contact-email').val(),
        subject: $(this).find('.contact-subject').val(),
        message: $(this).find('.contact-message').val()
      };

      if ( isValidEmail(data['email']) && (data['message'].length > 1) && (data['name'].length > 1) ) {
        $.ajax({
          type: "POST",
          url: postUrl,
          data: data,
          beforeSend: function() {
            loader.fadeIn(1000);
          },
          success: function(data) {
            loader.fadeOut(1000);
            success.delay(500).fadeIn(1000);
            failed.fadeOut(500);
          },
          error: function(xhr) { // if error occured
            loader.fadeOut(1000);
            failed.delay(500).fadeIn(1000);
            success.fadeOut(500);
          },
          complete: function() {
            loader.fadeOut(1000);
          }
        });
      } else {
        loader.fadeOut(1000);
        failed.delay(500).fadeIn(1000);
        success.fadeOut(500);
      }

      return false;
    });



    $('#updateProfile').hide();

$("#navbar-nav:first-child").hover(function() {
   $('#helloUser').hide();
  $('#updateProfile').show();
}, function() {
  $('#updateProfile').hide();
  $('#helloUser').show();
});


/********** Store location with AJAX ***********/

 var myContainer = "";
    //document.getElementById("location-signup-form").submit(myFun);
$("#success").hide();

$('#locationForm').on('submit', function (e) {

  e.preventDefault();

  $.ajax({
    type: 'post',
    url: '/sportbuddy/store-location',
    data: $('#locationForm').serialize(),
    success: function () {
     $("#success").show();
     //var names = unserialize(this.data);
     //console.log(names);
     //$('#newLocation').append("");
    }
  });

  $.ajax({
    type: 'get',
    url: '/sportbuddy/ajax-locations',
    data: 'text',
    success: function (response) {
      var names = JSON.parse(response);
      $('#newLocation').after("<tr><td>"+names[names.length-1].name+"</td><td><a class='btn' href='/sportbuddy/locations/update-index/"+names[names.length-1].locationId+"'>Update</a></td></tr>");
      //var i;
     // for(i=0;i<names.length;i++) {
     //  $('#newLocation').after("<tr><td>"+names[i].name+"</td><td><a class='btn' href='/sportbuddy/locations/update-index/"+names[i].locationId+"'>Update</a></td></tr>");
     // }
    }
  });




});




// function myFun() {
      
//     var location = document.getElementById("name").value;
//     var a = new XMLHttpRequest();
//     a.onreadystatechange = function () {
//         if (a.readyState == 4 && a.status == 200) {
//             console.log(a);
            
//         }

//     }
//     a.open("POST", "/sportbuddy/store-location", true);
//     a.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     a.send("name=" + location);
//     $("#success").show();
// }


/******** END store location with AJAX *********/


/************ Password check at Registration ***********/

    $('#password2').keyup(passValid);
    function passValid() {
      if( $('#password2').val() != $('#password').val() ) {
        $('#passFeedback').html("Passwords do not match!");
        $('#passFeedback').addClass("invalid-feedback alert alert-danger");
      } else {
        $('#passFeedback').removeClass();
        $('#passFeedback').html("All good!");
        $('#passFeedback').addClass("valid-feedback alert alert-success");
      }


    }

    $('#email').keyup(emailExist);
    function emailExist() {
      var newdata = {
        email: $('#email').val()
      }
      $.ajax({
      type: 'post',
      url: '/sportbuddy/email-exist',
      data: newdata,
        success: function (data,status,xhr) {
          $('#emailFeedback').html(xhr.responseText);
          if (xhr.responseText == "Exists already!") {
            $('#emailFeedback').toggleClass("invalid-feedback alert alert-danger");
          } else {
           $('#emailFeedback').removeClass(); 
          }
        }
      });
    }



















  });


} (jQuery) );



/******* GOOGLE MAPS LOCATION to events create ***********/
//google.maps.event.addDomListener(window, 'load', initAutocomplete);

    var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
        initMap();
        allEvents();
      }

       function fillInAddress() {
         // Get the place details from the autocomplete object.
         var place = autocomplete.getPlace();         

        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();

      //   for (var component in componentForm) {
      //     document.getElementById(component).value = '';
      //     document.getElementById(component).disabled = false;
      //   }

      //   // Get each component of the address from the place details
      //   // and fill the corresponding field on the form.
      //   for (var i = 0; i < place.address_components.length; i++) {
      //     var addressType = place.address_components[i].types[0];
      //     if (componentForm[addressType]) {
      //       var val = place.address_components[i][componentForm[addressType]];
      //       document.getElementById(addressType).value = val;
      //     }
      //   }
       }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }


//google.maps.event.addDomListener(window, 'load', initMap);
      // Initialize and add the map
    function initMap() {
      var a1 = window.location.pathname;
      var a2 = a1.split("/");
      var newdata = {
        data: a2[3]
      }
      $.ajax({
      type: 'post',
      url: '/sportbuddy/gmaps',
      data: newdata,
        success: function (data,status,xhr) {
          if(xhr.responseText !== 'null') {
            var result = JSON.parse(xhr.responseText);
            var elat = parseFloat(result[0].lat);
            var elng = parseFloat(result[0].lng);

            // The location of Uluru
            var uluru = {lat: elat, lng: elng};
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 14, center: uluru});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: uluru, map: map});
          }
        }
      });

      
    }


    /************ Shows all events on a Google Map with infowindow **************/

    function allEvents() {
      var options = {
        zoom:5,
        center:{lat:48.0899549,lng:4.0922483}
      }

      // New map
      var map = new google.maps.Map(document.getElementById('allEvents'), options);
      var markers = [];

      // Get data from database
      $.ajax({
      type: 'get',
      url: '/sportbuddy/gmapsAll',
      data: JSON,
        success: function (response) {
          var array = JSON.parse(response);  
          //console.log(array);

          for(i=0;i<array.length;i++) {

            var uluru = {
              lat: parseFloat(array[i].lat),
              lng: parseFloat(array[i].lng)
            }
            
            var locationInfowindow = new google.maps.InfoWindow({
              content: array[i].name,
            });

            var marker = new google.maps.Marker({
              position: uluru,
              map: map,
              infowindow: locationInfowindow
            });

            markers.push(marker);

            google.maps.event.addListener(marker, 'click', function() {
              hideAllInfoWindows(map);
              this.infowindow.open(map, this);
            });

          }

        }

      });

      function hideAllInfoWindows(map) {
        markers.forEach(function(marker) {
          marker.infowindow.close(map, marker);
        }); 
      }

      
    }