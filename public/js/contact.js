$(document).ready(() => {


    $('.achieve-btn').click(() => {
        $('.achieve-chat').fadeIn(1500);
        $('.achieve-close-btn').fadeIn();
        $('.achieve-btn').css('display','none');
        $('.people-chat').css('display','none');
    })

    $('.achieve-close-btn').click(() => {
        $('.people-chat').fadeIn(1500);
        $('.achieve-btn').fadeIn();
        $('.achieve-close-btn').css('display','none');
        $('.achieve-chat').css('display','none');
    })
})
