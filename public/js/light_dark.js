var moonIcon = 'moon';

var moonValue = localStorage.getItem(moonIcon);

if(moonValue){
    $('body').addClass('darkBgClass');
    $('.modal-content').addClass('darkBgClass');
    $('.dropdown-menu').addClass('darkBgClass');
    $('.dropdown-item').addClass('darkBgClass');
    $('.sun-icon').fadeIn();
    $('.moon-icon').css("display", "none");
    $('.sun-icon').css("color", "#536dfe");
    $('#lightDarkSwitch').prop('checked',true);
} else {
    $('body').removeClass('darkBgClass');
    $('.modal-content').removeClass('darkBgClass');
    $('.dropdown-menu').removeClass('darkBgClass');
    $('.dropdown-item').removeClass('darkBgClass');
    $('#lightDarkSwitch').prop('checked',false);

}

$('#lightDarkSwitch').on('change',function(){
    if($('#lightDarkSwitch').is(':checked')){
        DarkOn();
    }else{
        lightOn();
    }
})

$('.moon-icon').click(() => {
   DarkOn();
});

$('.sun-icon').click(() => {
   lightOn();
});

function lightOn(){
    $('.moon-icon').fadeIn();
    $('.sun-icon').css("display", "none");
    $('.moon-icon').css("color", "#536dfe");
    $(".group-icon").css("color", "#e0e0e0");
    $(".contact-icon").css("color", "#e0e0e0");
    $(".chat-icon").css("color", "#e0e0e0");
    $(".setting-icon").css("color", "#e0e0e0");

    $('body').removeClass('darkBgClass');
    $('.modal-content').removeClass('darkBgClass');
    $('.dropdown-menu').removeClass('darkBgClass');
    $('.dropdown-item').removeClass('darkBgClass');

    var moonIcon = 'moon';

    localStorage.removeItem(moonIcon);
}

function DarkOn(){
    $('.sun-icon').fadeIn();
    $('.moon-icon').css("display", "none");
    $('.sun-icon').css("color", "#536dfe");
    $(".group-icon").css("color", "#e0e0e0");
    $(".contact-icon").css("color", "#e0e0e0");
    $(".chat-icon").css("color", "#e0e0e0");
    $(".setting-icon").css("color", "#e0e0e0");

    $('body').addClass('darkBgClass');
    $('.modal-content').addClass('darkBgClass');
    $('.dropdown-menu').addClass('darkBgClass');
    $('.dropdown-item').addClass('darkBgClass');

    var moonIcon = 'moon';
    var moonClass = 'darkBgClass';

    localStorage.setItem(moonIcon, moonClass);
}
