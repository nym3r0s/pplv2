var $ = $;
function AJAXcalls(callback)
    {
        var playerRequest = $.ajax({
            url:"./playersGen.php"}).done(function(msg){
            $('#playerList').html(msg);
            });

        var squadRequest = $.ajax({
            url:"./userGen.php"}).done(function(msg){
            $('#userSquad').html(msg);
            });

        var balanceRequest =$.ajax({
            url:"./balance.php"}).done(function(msg){
            $('#playerBalance').html(msg);
            });
        var changesRequest =$.ajax({
            url:"./changes.php"}).done(function(msg){
            $('#transferBalance').html(msg);
            });

        playerRequest.done(function(){
            squadRequest.done(function(){
                callback();
                updateProgressBar();
//                setTimeout(restoreButtons,200);
                restoreButtons();
            });
        });
    }
function bindClickEvents()
    {
        $('.player').dblclick(function(){
            $('#pleaseWait').show();
            var playerId = $(this).attr('id');
            $.ajax({
                url: "./transferToSquad.php",
                method: "POST",
                data: { req: playerId },
                dataType: "html"
            }).done(function(msg){

            AJAXcalls(function(){bindClickEvents();});
            $('#pleaseWait').hide();
            });

        });

        $('.userplayer').dblclick(function(){
            $('#pleaseWait').show();
            var playerId = $(this).attr('id');
            $.ajax({
                url: "./transferFromSquad.php",
                method: "POST",
                data: { req: playerId },
                dataType: "html"
            }).done(function(msg){
            AJAXcalls(function(){bindClickEvents();});
            $('#pleaseWait').hide();
            });
        });

         $(".player,.userplayer").bind("contextmenu",function(event){
                showmodal($(this).attr('id'));
                return false;
        });
    }
function hideNonCaptain(type)
{
//    alert("Hiding"+type);
    var arr = ['#batsman','#bowler','#wkeeper','#rounder','#captain'];
    var classlist = ['.batsman','.bowler','.wkeeper','.rounder','.captain'];
    for(var i=0;i<arr.length;i++)
    {
        if(arr[i].indexOf(type)>-1)
        {
            var typeid = arr[i];
            var typeclass = classlist[i];
        }
    }
//    alert(type+" "+typeid+" "+typeclass);
    $('.player').not(typeclass).hide();
    $(typeclass).show();
    $('.captain').hide();

    for(var i=0;i<arr.length;i++)
    {
        if(typeid!=arr[i])
        {
            if(!$(arr[i]).hasClass('btn-danger')) $(arr[i]).toggleClass('btn-danger');
        }
        else
        {
            if($(arr[i]).hasClass('btn-danger')) $(arr[i]).toggleClass('btn-danger');
        }
    }

}

function hideCaptain()
{

    $('.captain').show();
    $('.player').not('.captain').hide();

    var arr = ['#batsman','#bowler','#wkeeper','#rounder'];
    for(var i=0;i<arr.length;i++)
    {
        if(!$(arr[i]).hasClass('btn-danger')) $(arr[i]).toggleClass('btn-danger');
    }
    if($('#captain').hasClass('btn-danger')) $('#captain').toggleClass('btn-danger');
}

function resetButtons()
{
    $("#batsman, #bowler, #wkeeper,#rounder,#captain").removeClass("btn-danger");
    $('#batsman').trigger('click');
}

function updateProgressBar()
{
    var number = $('.userplayer').length;
    var value = Math.ceil((number/16)*100);
    $('#progbar').css('width',value+'%');

    $('#progbar').removeClass('progress-bar-warning');
    $('#progbar').removeClass('progress-bar-danger');
    $('#progbar').removeClass('progress-bar-info');
    $('#progbar').removeClass('progress-bar-success');

    if(value<20)
        $('#progbar').addClass('progress-bar-danger');

    else if (value<50)
        $('#progbar').addClass('progress-bar-warning');
    else if (value<100)
        $('#progbar').addClass('progress-bar-info');
    else if (value==100)
        $('#progbar').addClass('progress-bar-success');

    if(number==16)
    {
        $('#confirmSquad').removeClass('disabled').addClass('btn-success');
    }
    if(number < 16)
    {
        $('#confirmSquad').addClass('disabled');
        $('#confirmSquad').removeClass('btn-success');
    }

}

function showmodal(id)
{
    var playerId = id;
    $.ajax({
        url: "./playerInfo.php",
        method: "POST",
        data: { req: playerId },
        dataType: "html"
    }).done(function(msg){
        $('#playerData').html(msg);
        $('#playerInfo').show();
    });
}

function restoreButtons()
{
    if(!$('#batsman').hasClass('btn-danger'))
    {
        $('#batsman').trigger('click');
    }
    if(!$('#bowler').hasClass('btn-danger'))
    {
        $('#bowler').trigger('click');
    }
    if(!$('#wkeeper').hasClass('btn-danger'))
    {
        $('#wkeeper').trigger('click');
    }
    if(!$('#rounder').hasClass('btn-danger'))
    {
        $('#rounder').trigger('click');
    }
    if(!$('#captain').hasClass('btn-danger'))
    {
        $('#captain').trigger('click');
    }
}

function confirm16()
{
    var num = $('.userplayer').length;
    if(num != 16) return false;

    var ids = [];
    var iter = 0;
    $.each($(".userplayer"),function(i,obj){
           ids[iter] = $(obj).attr('id');
            iter++;
           });
    var idString = ids.join(',');

    $.ajax({
        url: "./confirm16.php",
        method: "POST",
        data: { c16 : idString },
        dataType: "html"
    }).done(function(msg){
        alert(msg);
//        console.log(msg);
    });
}


$(document).ready(function(){

//    Clicking The other buttons.

    AJAXcalls(function(){
        bindClickEvents();
        setTimeout(function(){
            resetButtons();

        },1);

    });

    $("#playerInfo").hide(); // Hiding the modal
    $('#pleaseWait').hide();

    $("#batsman, #bowler, #wkeeper,#rounder").click(function(){

        var name = $(this).attr('id');
        $(this).toggleClass("btn-danger");
        hideNonCaptain(name.slice(1,name.length));
    });
    $("#captain").click(function(){
        $(this).toggleClass("btn-danger");
        hideCaptain();
    });
    $('#modalclose').click(function(){
        $('#playerInfo').hide();
    });

    $('#confirmSquad').click(function(){
        confirm16();
        AJAXcalls(function(){bindClickEvents();});
    });



});
