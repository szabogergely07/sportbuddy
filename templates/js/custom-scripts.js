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

