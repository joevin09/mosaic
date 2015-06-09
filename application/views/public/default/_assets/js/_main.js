
var Ww = $(window).width();

// Nav + hover + scroll + responsive
$(document).ready(function () {

    var isClicked = false;
    var textarea = $("body").find("#about");
    if (textarea.length > 0) {
        reste();
    }

    $(".navbar-toggle").click(function () {
        if (isClicked == false) {
            $('body').toggleClass('slide_menu').toggleClass('scroll-y');
            isClicked = true;
        }

        setTimeout(function () {
            isClicked = false;
        }, 400);
    })
});
$(document).ready(function () {
    $(".dk-select").click(function () {
        $('body').toggleClass('scroll-y');
        $('body').toggleClass('slide_option');
    });
});
$(document).ready(function () {
    $("#wrapper").click(function () {
        $('body').removeClass('scroll-y');
        $('body').removeClass('slide_option');
    });
});
$(document).keyup(function (e) {

    var isClicked = false;
    if (e.keyCode == 27 && isClicked == false && $("body").hasClass("slide_menu")) {
        $('body').removeClass("slide_menu");
        isClicked = true;
        setTimeout(function () {
            isClicked = false;
        }, 400);
    }
});
//$('.action-choose-register').on('click', function (e) {
//    e.preventDefault();
////    $('.action-choose-register').removeClass('btn-success').addClass('btn-primary');
////    $(this).removeClass('btn-primary').addClass('btn-success');
//    $('.register-form').slideUp();
//    $('.register-' + $(this).data('value')).slideDown();
//});

$("body").click(function (e) {
    if ($("body").hasClass("slide_menu")) {
        if ($(e.target).is("a, button, i, small")) {

        }
        else {
            $('body').removeClass('slide_menu').removeClass('scroll-y').removeClass('move_arrow');
        }
    }
});
$('a[href^="#"]').click(function () {
    var the_id = $(this).attr("href");
    $('html, body').animate({
        scrollTop: $(the_id).offset().top - 176

    }, 'slow');
    return false;
});
//$( ".btn-choose-a" ).click(function() {
//  if ( $( ".form_agency" ).is( ":hidden" ) ) {
//    $( ".form_agency" ).show( "slow" );
//    $( ".form_postulant" ).slideUp();
//  } 
//});
//
//$( ".btn-choose-p" ).click(function() {
//  if ( $( ".form_postulant" ).is( ":hidden" ) ) {
//    $( ".form_postulant" ).show( "slow" );
//    $( ".form_agency" ).slideUp();
//  } 
//});

//$(".btn-choose-postulant").click(function () {
//        $( ".form_agency" ).slideUp();
//        $('body').addClass('change_fsorm');
////        $('html,body').animate({scrollTop: $("#form_postulant").offset().top - 146}, 'slow');
//});
//$(".btn-choose-agency").click(function () {
//        $('body').addClass('change_form');
//        $( "#form_postulant" ).slideUp();
////        $('html,body').animate({scrollTop: $("#form_agency").offset().top - 146}, 'slow');
//});

//$(".btn-postulant").click(function () {
//    $('body').addClass('change_form_other');
//    $('body').removeClass('change_form');
//});
//
//$(".btn-agency").click(function () {
//    $('body').addClass('change_form');
//    $('body').removeClass('change_form_other');
//});

var btnRegister = $('body').find('.btn-register');
var formRegister = $('body').find('.form-register');
if (btnRegister.length > 0) {
    btnRegister.on('click', function () {
        btnRegister.removeClass('active');
        $(this).addClass('active');
        var value = $(this).attr('data-value');
        formRegister.removeClass('active');
        $('#' + value).addClass('active');
    });
}

// SELECT go to option value URL
$('.select-go-to').on('change', function () {
    window.location.href = $(this).val();
});
if ($("#postulant").hasClass("visible-menu")) {
    $('.link_agency').addClass('selected');
    $('.offre-square').addClass('selected');
}


if (Ww < 1200 && Ww > 693) {

    var list = $('.all-members');
    var listItems = list.find('li');
    if (listItems.length > 4) {
        list.css('padding-bottom', '66px');
    }

    if (listItems.length < 4) {
        list.css('left', '203px');
        list.css('bottom', '4px');
    }

    if (listItems.length < 3) {
        list.css('left', '382px');
    }

    if (listItems.length < 2) {
        list.css('left', '544px');
    }
} else {
    var list = $('.all-members');
    var listItems = list.find('li');
    if (listItems.length > 4) {
        list.css('padding-bottom', '66px');
    }

    if (listItems.length < 4) {
        list.css('left', '357px');
        list.css('bottom', '4px');
    }

    if (listItems.length < 3) {
        list.css('left', '525px');
    }

    if (listItems.length < 2) {
        list.css('left', '688px');
    }
}

$(window).resize(function () {
    var Ww = $(window).width();
    if (Ww < 1200 && Ww > 693) {
     
        var list = $('.all-members');
        var listItems = list.find('li');
        if (listItems.length > 4) {
            list.css('padding-bottom', '66px');
        }

        if (listItems.length < 4) {
            list.css('left', '203px');
            list.css('bottom', '4px');
        }

        if (listItems.length < 3) {
            list.css('left', '382px');
        }

        if (listItems.length < 2) {
           list.css('left', '544px');
        }
    } else {
        var list = $('.all-members');
        var listItems = list.find('li');
        if (listItems.length > 4) {
            list.css('padding-bottom', '66px');
        }

        if (listItems.length < 4) {
            list.css('left', '357px');
            list.css('bottom', '4px');
        }

        if (listItems.length < 3) {
            list.css('left', '525px');
        }

        if (listItems.length < 2) {
            list.css('left', '688px');
        }
    }
});

// Change word home
$(".custom_select").dropkick();

if (Ww > 500) {
    (function () {
        var words = [
            'ta place',
            'ton agence',
            'ton avenir'
        ], i = 0;
        setInterval(function () {
            $('#changeword-postulant').fadeOut(function () {
                $(this).html(words[i = (i + 1) % words.length]).fadeIn();
            });
        }, 3000);
    })();
    (function () {
        var words = [
            'un associé ?',
            "de l'aide ?",
            'un collègue ?'
        ], i = 0;
        setInterval(function () {
            $('#changeword-agence').fadeOut(function () {
                $(this).html(words[i = (i + 1) % words.length]).fadeIn();
            });
        }, 3000);
    })();
}


//$(document).ready(function(){
//  $('.img_post').addClass('img_postclass');
//});

// Calcul about
$(document).ready(function () {
    $(".dk-select").click(function () {
        $('body').toggleClass('coucou');
    });
});

$('#about').keyup(function () {
    reste();
});
function reste()
{
    var text = $("#about").val();
    var restants = 150 - text.length;
    $("#caracteres").html(restants);
}

// hover list
var list = $("body").find(".list li");
var img = list.find('img');

if (list.length > 0) {
    list.on("mouseover", function () {
        img.css('opacity', '0.5');
        $(this).find('img').css('opacity', '1');
    });
    list.on("mouseout", function () {
        list.removeClass("active");
        img.css('opacity', '1');
    });
}

// profil checkbox
var functionList = $('body').find('.fuctions-list .checkbox');
var functionListLabel = $('body').find('.fuctions-list .checkbox label');
if (functionList.length > 0) {
    functionListLabel.on('click', function () {
        var n = $(this).parent(".checkbox").index();
//        console.log(n);
        functionList.eq(n).toggleClass('active');
        $(this).toggleClass('checked');
    });
}


// Google Maps

var container = $('body').find('.gmpas-content');
var gmaps = container.find('.gmaps');
function AgencyMap(place) {

    var apiKey = "AIzaSyBbR9DEPYn6QcwBK19yRgqbXGjpHsAkm8c";
    var url = "https://maps.googleapis.com/maps/api/geocode/json?key" + apiKey + "=&address=" + place + "&sensor=false";

    jQuery.getJSON(url)
            .success(function (data) {
                lat = data.results[0].geometry.location.lat;
                long = data.results[0].geometry.location.lng;
                createMap(lat, long);
            })
            .error(function (jqXhr, textStatus, error) {
//                console.log("Erreur Google API GEOCODE");
            });
}

function createMap(lat, long) {

    var Latlng = new google.maps.LatLng(lat, long);

    var mapOptions = {
        center: Latlng,
        zoom: 11,
        scrollwheel: false,
        panControl: false,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        overviewMapControl: false,
        minZoom: 6,
        maxZoom: 14
    };


    var styles = [{
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [{"color": "#d3d3d3"}]
        }, {
            "featureType": "transit",
            "stylers": [{"color": "#808080"}, {"visibility": "off"}]
        }, {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [{"visibility": "on"}, {"color": "#b3b3b3"}]
        }, {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [{"color": "#ffffff"}]
        }, {
            "featureType": "road.local",
            "elementType": "geometry.fill",
            "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"weight": 1.8}]
        }, {
            "featureType": "road.local",
            "elementType": "geometry.stroke",
            "stylers": [{"color": "#d7d7d7"}]
        }, {
            "featureType": "poi",
            "elementType": "geometry.fill",
            "stylers": [{"visibility": "on"}, {"color": "#ebebeb"}]
        }, {
            "featureType": "administrative",
            "elementType": "geometry",
            "stylers": [{"color": "#a7a7a7"}]
        }, {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [{"color": "#ffffff"}]
        }, {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [{"color": "#ffffff"}]
        }, {
            "featureType": "landscape",
            "elementType": "geometry.fill",
            "stylers": [{"visibility": "on"}, {"color": "#efefef"}]
        }, {
            "featureType": "road",
            "elementType": "labels.text.fill",
            "stylers": [{"color": "#696969"}]
        }, {
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [{"visibility": "on"}, {"color": "#737373"}]
        }, {
            "featureType": "poi",
            "elementType": "labels.icon",
            "stylers": [{"visibility": "off"}]
        }, {
            "featureType": "poi",
            "elementType": "labels",
            "stylers": [{"visibility": "off"}]
        }, {
            "featureType": "road.arterial",
            "elementType": "geometry.stroke",
            "stylers": [{"color": "#d6d6d6"}]
        }, {
            "featureType": "road",
            "elementType": "labels.icon",
            "stylers": [{"visibility": "off"}]
        }, {}, {"featureType": "poi", "elementType": "geometry.fill", "stylers": [{"color": "#dadada"}]}];

    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    var styledMapType = new google.maps.StyledMapType(styles, {name: 'Styled'});

    map.mapTypes.set('Styled', styledMapType);
    map.setMapTypeId('Styled');

    var goldStar = {
        path: 'M 125,5 155,90 245,90 175,145 200,230 125,180 50,230 75,145 5,90 95,90 z',
        fillColor: 'yellow',
        fillOpacity: 0.8,
        scale: 1,
        strokeColor: 'gold',
        strokeWeight: 14
    };

    var marker = new google.maps.Marker({
        position: Latlng,
        icon: "http://joevinlicot.be/marker-icon.png",
        map: map
    });
}

// Compétences

var competencesContent = $('body').find('.competences-content');
var competenceItem = competencesContent.find('#competences');
var inputCompetences = competencesContent.find('.input-competences');
var inputCompetencesItems = competencesContent.find('li');
var remove = competencesContent.find('.remove');
var data = [];
var output = "";
var outputValue = "";
var params = [" ", ";", ",", "+"];

if (competenceItem.length > 0) {
    inputComp();
}

function inputComp() {
    var value = competenceItem.val();

//    console.log(value);
    data = [];
    competenceItem.val("");

    data = value.split(' ');

    $.each(data, function (key, value) {
        if (value != "") {
            output += "<li style='color:#fff;'><span class='li-competence'>" + value + "</span><i class='remove fa fa-times'></i></li>";

            if (key > 0) {
                outputValue += ' ' + value;
            } else {
                outputValue += value;
            }
        }
    });

    competenceItem.val(outputValue);
    competencesContent.append('<ul class="input-competences"></ul');
    inputCompetences = competencesContent.find('.input-competences');
    inputCompetences.append(output);

    inputCompetencesItems = competencesContent.find('li');
    remove = competencesContent.find('.remove');
    removeAll = competencesContent.find('.removeAll');

}

competenceItem.focusout(function () {

    var value = competenceItem.val();

    if (value != "") {

//        console.log(value);

        data = [];

//        console.log(data);

        competenceItem.val("");

        data = value.split(' ');

//        console.log(data);

        outputValue = "";
        output = "";

        $.each(data, function (key, value) {
            output += "<li style='color:#fff;'><span class='li-competence'>" + value + "</span><i class='remove fa fa-times'></i></li>";
            if (key > 0) {
                outputValue += ' ' + value;
            } else {
                outputValue += value;
            }
        });

        competencesContent.find('li').remove();
        competenceItem.val(outputValue);
        var inputCompetences = competencesContent.find('.input-competences');
        inputCompetences.append(output);

        remove = competencesContent.find('.remove');
    }

});


competencesContent.on('click', '.remove', function () {
    var n = remove.index(this);

//    console.log(n);

    data = jQuery.grep(data, function (value) {
        return value != data[n];
    });

    outputValue = "";
    output = "";

    $.each(data, function (key, value) {
        output += "<li style='color:#fff;'><span class='li-competence'>" + value + "</span><i class='remove fa fa-times'></i></li>";
        if (key > 0) {
            outputValue += ' ' + value;
        } else {
            outputValue += value;
        }
    });

    competencesContent.find('li').remove();
    competenceItem.val(outputValue);
    var inputCompetences = competencesContent.find('.input-competences');
    inputCompetences.append(output);

    remove = competencesContent.find('.remove');
});

var removeAll = $('body').find('.removeall');

//console.log(removeAll);

removeAll.on("click", function () {
    data = [];
    competenceItem.val("");
    competencesContent.find('li').remove();
});


// Toody

var inputdate1 = $('body').find('#process-1-date-2');
var inputdate2 = $('body').find('#process-2-date-2');
var inputdate3 = $('body').find('#process-3-date-2');

var today1 = $('body').find('#today-1');
var today2 = $('body').find('#today-2');
var today3 = $('body').find('#today-3');

inputdate1.focus(function () {
    today1.removeAttr('checked');
    $('body').find('.process-1').removeClass('checked');
});

inputdate2.focus(function () {
    today2.removeAttr('checked');
    $('body').find('.process-2').removeClass('checked');
});

inputdate3.focus(function () {
    today3.removeAttr('checked');
    $('body').find('.process-3').removeClass('checked');
});

$('body').find("label[for='today-1']").on("click", function () {
    today1.attr('checked');
    $('body').find('.process-1').addClass('checked');
    inputdate1.val('YY-mm-dd');
});

$('body').find("label[for='today-2']").on("click", function () {
    today2.attr('checked');
    $('body').find('.process-2').addClass('checked');
    inputdate1.val('YY-mm-dd');
});

$('body').find("label[for='today-3']").on("click", function () {
    today3.attr('checked');
    $('body').find('.process-3').addClass('checked');
    inputdate1.val('YY-mm-dd');
});

//
//$('.last_register_home ul li a').hover(function(){
//    $('.last_register_home ul li a img').toggleClass('opacityClass');
//});


///* VERIFICATION FORM */
//
//$('body').removeClass('no-js');
//$('input').removeAttr('required');
//$('textarea').removeAttr('required');
//$("form").attr("action", "assets/php/process.php");
//$('form').attr('novalidate', 'novalidate');
//
//
//$('form').submit(function(event) {
//
//  $('input').removeClass('has-error'); // remove the error class
//  $('textarea').removeClass('has-error'); // remove the error class
//  $('label').css('color', '#888'); // change color label
//  $('form div span').remove();
//
//  // get the form data
//  // there are many ways to get this data using jQuery (you can use the class or id also)
//  var formData = {
//    'name'        : $('input[name=name]').val(),
//    'email'       : $('input[name=email]').val(),
//    'email_validation'  : $('input[name=email]').val(),
//    'message'       : $('textarea').val(),
//    'subject'       : $('input[name="subject"]').val(),
//  };
//
//  // process the form
//  $.ajax({
//    type    : 'POST', // define the type of HTTP verb we want to use (POST for our form)
//    url     : 'assets/php/contact.php', // the url where we want to POST
//    data    : formData, // our data object
//    dataType  : 'json', // what type of data do we expect back from the server
//    encode    : true
//  })
//    // using the done promise callback
//    .done(function(data) {
//
//      // log data to the console so we can see
//      console.log(data); 
//
//      // here we will handle errors and validation messages
//      if ( ! data.success) {
//        
//        // handle errors for name ---------------
//        if (data.errors.name) {
//          $('input[name="name"]').addClass('has-error'); // add the error class to show red input
//          $('#error-name').append('<span>' + data.errors.name + '</span>'); // add error
//        }
//
//        // handle errors for email ---------------
//        if (data.errors.email) {
//          $('input[name="email"]').addClass('has-error'); // add the error class to show red input
//          $('#error-email').append('<span>' + data.errors.email + '</span>'); // change placeholder error
//        }
//
//        // handle valid for email ---------------
//        if (data.errors.email_validation) {
//          $('input[name="email"]').addClass('has-error'); // add the error class to show red input
//          $('#error-email').append('<span>' + data.errors.email_validation + '</span>'); // change placeholder error
//          $('input[name="email"]').attr('value', ''); // reset value
//        }
//
//        // handle errors for message ---------------
//        if (data.errors.message) {
//          $('textarea[name="message"]').addClass('has-error'); // add the error class to show red input
//          $('#error-message').append('<span>' + data.errors.message + '</span>'); // change placeholder error
//        }
//
//      } else {
//
//        // ALL GOOD! just show the success message!
//        $('form').append('<div class="alert alert-success">' + data.message + '</div>');
//        $('.form').hide(); // hide submit
//
//        // usually after form submission, you'll want to redirect
//        // window.location = '/thank-you'; // redirect a user to another page
//
//      }
//    })
//
//    // using the fail promise callback
//    .fail(function(data) {
//
//      // show any errors
//      // best to remove for production
//      console.log(data);
//    });
//
//  // stop the form from submitting the normal way and refreshing the page
//  event.preventDefault();
//});


(function (i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function () {
        (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-63460880-1', 'auto');
ga('send', 'pageview');


//ADD formation

//$(".plus1").click(function (e) {
//
//    $('body').addClass('more-formation1');
//});
//
//$(".plus2").click(function (e) {
//
//    $('body').addClass('more-formation2');
//});
//
//$(".plusplus1").click(function (e) {
//
//    $('body').addClass('more-formation1');
//});
//
//$(".plusplus2").click(function (e) {
//
//    $('body').addClass('more-formation2');
//});

var offres = $('body').find('.offres');
var more = $('body').find('.more');

if ($('body').find('.offres.active').length == 4) {
    more.hide();
}

more.on('click', function (e) {
    var offresActive = $('body').find('.offres.active');
    var n = offresActive.length

    if (n < offres.length) {
        offres.eq(n).addClass('active');

        if (n == offres.length-1) {
            more.hide();
        }
    }
   
})


var offres = $('body').find('.formation1');
var more = $('body').find('.mores');

if ($('body').find('.formation1.active').length == 3) {
    more.hide();
}

more.on('click', function (e) {
    var offresActive = $('body').find('.formation1.active');
    var n = offresActive.length

    if (n < offres.length) {
        offres.eq(n).addClass('active');

        if (n == offres.length - 1) {
            more.hide();
        }
    }
})



// region agency checkbox

var checkboxRegion = $('body').find('.region-agency .checkbox');

checkboxRegion.on('click', 'label', function(e){
   var n = $(this).parent(".checkbox").index();
   checkboxRegion.eq(n).toggleClass('checked');
});

//
//$(".day1").click(function (e) {
//
//    $('.endtime1').toggleClass('endtimeout');
//});
//
//$(".day2").click(function (e) {
//
//    $('.endtime2').toggleClass('endtimeout');
//});
//
//$(".day3").click(function (e) {
//
//    $('.endtime3').toggleClass('endtimeout');
//});
