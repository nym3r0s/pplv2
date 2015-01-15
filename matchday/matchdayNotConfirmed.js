var $ = $;
function AJAXcalls(callback)
    {
        var playerRequest = $.ajax({
            url:"./squadGen.php"}).done(function(msg){
//            $('#playerList').html(msg);
            createPlayersArray(msg);
            });

        playerRequest.done(function(){
                    generatePlayers();
                    callback();
                    updateProgressBar();
                   });
    }
function bindClickEvents()
    {
        $('.player').dblclick(function(){
            var playerId = $(this).attr('id');
//            console.log(player);
            if($('.userplayer').length < 11)
            {
                $(this).detach().appendTo('#userSquadTable').removeClass().addClass('userplayer');
                refreshElements();
            }
        });

        $('.userplayer').dblclick(function(){
            var playerId = $(this).attr('id');
//            console.log($(this).attr('id'));
//            alert($(this).attr('id'));
            $(this).detach().appendTo('#playerListTable').removeClass().addClass('player');
            refreshElements();
        });


        $(".player,.userplayer").bind("contextmenu",function(event){
                showmodal($(this).attr('id'));
        });
    }


var players; // The array of players
var confirmedSquad // The list of Ids of Confirmed Players
var presentPlayers //The list of existing players. Default = Confirmed Players

//Function to get Player Details

function getPlayer(playerId)
{
    return players[parseInt(playerId)-1000];
}

//Function to create JSON array of objects

function createPlayersArray(json)
{
    players = $.parseJSON(json);
//    console.log(players);
//    console.log(players[0]);
//    console.log(players[0]['playerName']);
}

function generatePlayers()
{
//    Clearing playerList and userSquad
    $('#playerListTable').empty();
    $('#userSquadTable').empty();

//    console.log(players);
    $.each(players,function(id,obj){
//        console.log(obj);
//        console.log(obj.playerId);

        var playerId      = obj.playerId;
        var playerName    = obj.playerName;
        var playerType    = obj.playerType;
        var playerCaptain = obj.playerCaptain;
        var playerCountry = obj.playerCountry;
        var playerClass   = obj.playerClass;
        var playerCost    = obj.playerCost;

        var divText = '<td>'+playerName+'</td><td>'+playerCountry;
        divText = divText + '</td><td>' +playerType + '</td><td>'+playerCost+'</td>';
        var divName = '<tr id=\"'+playerId+'\"></tr>';
        $(divName).addClass('player').html(divText).appendTo('#playerListTable');
//        console.log("appending"+playerId);

    });
}

//Function to refresh the dynamic refreshElements

function refreshElements()
{
//    generatePlayers();
    setTimeout(function(){
    bindClickEvents();
    updateProgressBar();
    },1);
}

function updateProgressBar()
{
    var number = $('.userplayer').length;
    var value = Math.ceil((number/11)*100);
    $('#progbar').css('width',value+'%');

    $('#progbar').removeClass('progress-bar-warning');
    $('#progbar').removeClass('progress-bar-danger');
    $('#progbar').removeClass('progress-bar-info');
    $('#progbar').removeClass('progress-bar-success');

    if(value<20)
        $('#progbar').addClass('progress-bar-danger');

    else if (value<60)
        $('#progbar').addClass('progress-bar-warning');
    else if (value<100)
        $('#progbar').addClass('progress-bar-info');
    else if (value==100)
        $('#progbar').addClass('progress-bar-success');

    if(number==11)
    {
        $('#confirmSquad').removeClass('disabled').addClass('btn-success');
    }
    if(number < 11)
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

function confirm11()
{
    var num = $('.userplayer').length;
    if(num != 11) return false;

    var ids = [];
    var iter = 0;
    $.each($(".userplayer"),function(i,obj){
          if($.inArray($(obj).attr('id'),ids)==-1)
          {
           ids[iter] = $(obj).attr('id');
            iter++;
          }
           });
    if(ids.length!=11)
        return false;

    var idString = ids.join(',');

    $.ajax({
        url: "./confirm11.php",
        method: "POST",
        data: { c11 : idString },
        dataType: "html"
    }).done(function(msg){
        alert(msg);
//        console.log(msg);
    });
}


$(document).ready(function(){

//    Clicking The other buttons.
    $click = 0;
    AJAXcalls(function(){
        bindClickEvents();
    });

    $("#playerInfo").hide(); // Hiding the modal
    $('#pleaseWait').hide();

    $('#modalclose').click(function(){
        $('#playerInfo').hide();
    });

    $('#confirmSquad').click(function(){
        confirm11();
        AJAXcalls(function(){bindClickEvents();});
    });



});
