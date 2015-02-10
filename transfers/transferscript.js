var $ = $;
function AJAXcalls(callback)
    {
        var playerRequest = $.ajax({
            url:"./playersGen.php"}).done(function(msg){
//            $('#playerList').html(msg);
            createPlayersArray(msg);
            });

        var squadRequest = $.ajax({
            url:"./userGen.php"}).done(function(msg){
//            $('#userSquad').html(msg);
            confirmedSquadArray(msg);
            });

        var balanceRequest =$.ajax({
            url:"./balance.php"}).done(function(msg){
//            $('#playerBalance').html(msg);
            confirmedBalance = parseInt(msg);
//            console.log(confirmedBalance);
            });
        var changesRequest =$.ajax({
            url:"./remainingTransfers.php"}).done(function(msg){
//            $('#transferBalance').html(msg);
            transferBalance = parseInt(msg);
//            console.log("Transfers: "+transferBalance);
            });

        playerRequest.done(function(){
            squadRequest.done(function(){
                balanceRequest.done(function(){
                    changesRequest.done(function(){

                        presentSquadArray();
                        generatePlayers();
                        callback();
                        updateProgressBar();
                        resetButtons();
                        generatePresentBalance();
                        updateChanges();
                    });
                });
            });
        });
    }
function bindClickEvents()
    {

        $('.player,.userplayer').unbind('click');
        $('.player,.userplayer').unbind('dblclick');

        $('.player').dblclick(function(){
            $('#pleaseWait').show();
            var playerId = $(this).attr('id');
//            var player = getPlayer(playerId);
//            var tmpbal = presentBalance - parseInt(player.playerCost);
//            if( ($('.userplayer').length < 16) && (tmpbal >=0) )
//            {
//                presentBalance = tmpbal;
//                $(this).detach().appendTo('#userSquadTable').removeClass().addClass('userplayer');
////                alert("moving Element"+playerId);
//                presentPlayers.push(playerId);
//                localStorage.removeItem('playerList');
//                localStorage.setItem('playerList',presentPlayers.join(','));
//            }
//            refreshElements();
//            $('#pleaseWait').hide();
            var thiselem = $(this);
            $.when(getPlayer(playerId)).done(function(player){
//                alert(player);
//                console.log(player);
            var tmpbal = presentBalance - parseInt(player.playerCost);
            if( ($('.userplayer').length < 16) && (tmpbal >=0) )
            {
                presentBalance = tmpbal;
                $(thiselem).detach().appendTo('#userSquadTable').removeClass().addClass('userplayer');
//                alert("moving Element"+playerId);
                presentPlayers.push(playerId);
                localStorage.removeItem('playerList');
                localStorage.setItem('playerList',presentPlayers.join(','));
            }
            refreshElements();
            $('#pleaseWait').hide();
            });

        });

        $('.userplayer').dblclick(function(){
            $('#pleaseWait').show();
            var playerId = $(this).attr('id');
            var player = getPlayer(playerId);
            $(this).detach().appendTo('#playerListTable').removeClass().addClass('player').addClass(player.playerClass);
//            alert("moving Element"+playerId);
            var index = $.inArray(playerId,presentPlayers);
            presentPlayers.splice(index,1);

            localStorage.removeItem('playerList');
            if(presentPlayers.length>0) localStorage.setItem('playerList',presentPlayers.join(','));
            refreshElements();
            $('#pleaseWait').hide();
        });

        var click = 0;
        $(".player,.userplayer").click("contextmenu",function(event){
            id = $(this).attr('id');
            click++;
            setTimeout(function(){
                if(click == 1)
                    showmodal(id);

                click = 0;
            },500);
        });
//         $(".player,.userplayer").click("contextmenu",function(event){
//                $click++;
//                $id = $(this).attr('id')
//                setTimeout(function(){
//                    if($click == 1){
//                    showmodal($id);
//                    $click = 0;
//                     return false;
//                    }
//                else $click = 0;
//                },500);
//         });


    }
//Function to get Player Details
function getPlayer(playerId)
{
    return players[parseInt(playerId)-1000];
}

// Function to refresh dynamic elements
function refreshElements()
{
    presentSquadArray();
    generatePlayers();
    bindClickEvents();
    updateProgressBar();
    generatePresentBalance();
    updateChanges();
    restoreButtons();
}

//Function to update the changes and transfers

function updateChanges()
{
    var i;
    var numchanges = 0;
    for(i=0;i<presentPlayers.length;i++)
    {
        if($.inArray(presentPlayers[i],confirmedSquad) == -1)
            numchanges++;
    }

    transferChanges = numchanges;

    var balance = "<h5>Current Balance: "+presentBalance+"</h5>";
    var transferChanges = "<h5>Transfers Remaining: "+transferBalance+"</h5><h5>Changes: "+numchanges+"</h5>";
    $('#playerBalance').html(balance);
    $('#transferBalance').html(transferChanges);

}

// The Functions to create player Divs.

var players; // The array of players
var confirmedSquad; // The list of Ids of Confirmed Players
var presentPlayers; //The list of existing players. Default = Confirmed Players
var confirmedBalance;
var presentBalance;
var transferBalance;
var transferChanges;

function createPlayersArray(json)
{
    players = $.parseJSON(json);
//    console.log(players);
//    console.log(players[0]);
//    console.log(players[0]['playerName']);
}

function generatePresentBalance()
{
    var i;
    var spent = 0;
//    console.log('presentplyers in balance: '+presentPlayers);
//    console.log(presentPlayers.length);
    for(i=0;i<presentPlayers.length;i++)
    {
//        spent = spent + parseInt(getPlayer(presentPlayers[i]).playerCost);
       $.when(getPlayer(presentPlayers[i])).then(function(obj){
//           console.log(presentPlayers[i]);
//           console.log(obj);
           var k = undefined;
           k = obj;
           if(k==undefined)
           {
               localStorage.removeItem('playerList');
               location.reload();
           }
           else
           {
               spent = spent + parseInt(obj.playerCost);
           }

       });
    }
//    subtracting confirmed squad's Amount. Essentially only the difference of ppl is calculated
if(confirmedSquad!=null)
{
    for(i=0;i<confirmedSquad.length;i++)
    {
        spent = spent - parseInt(getPlayer(confirmedSquad[i]).playerCost);
    }
}
//    alert((parseInt(confirmedBalance)-spent));
    presentBalance = (parseInt(confirmedBalance)-spent);
//    return (parseInt(confirmedBalance)-spent) ;

}

function confirmedSquadArray(msg)
{
//    console.log('entering confirmedSquadArray');
    if(msg.indexOf(',')!=-1)
    {
        confirmedSquad = msg.split(",");
//
//        console.log("msg");
//        console.log(msg);
    }
    else
    {
        confirmedSquad = null;
//        console.log('confirmedSquad set as null');
    }
//    console.log(confirmedSquad);
//    console.log(confirmedSquad.length);
}

function presentSquadArray()
{
//    localStorage.setItem('playerList','100,200,300');
//    localStorage.removeItem('playerList');
    var presentList = localStorage.getItem("playerList");
//    console.log('present list: ');
//    console.log(presentList);
    if(presentList == null)
    {
//        console.log('entering null condition');
//        console.log('confirmed squad'+confirmedSquad);
//        console.log(confirmedSquad);
        if(confirmedSquad != null)
        {
        presentPlayers = confirmedSquad.slice();
        }
        else
        {
//            console.log('no confirmed squad');
            presentPlayers = [];
        }
    }
    else
    {
//        console.log('entering other condition');
//        console.log('non empty list');
        presentPlayers = presentList.split(",");

    }
//    console.log(presentPlayers);
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

        if($.inArray(playerId,presentPlayers) == -1)
        {
            playerClass = playerClass+ ' player';

            var divText = '<td>'+playerName+'</td><td>'+playerCountry;
            divText = divText + '</td><td>' +playerType + '</td><td>'+playerCost+'</td>';

            var divName = '<tr id=\"'+playerId+'\"></tr>';

            $(divName).addClass(playerClass).html(divText).appendTo('#playerListTable');

//            console.log("appending"+playerId);
        }
        else
        {
            playerClass = 'userplayer';

            var divText = '<td>'+playerName+'</td><td>'+playerCountry;
            divText = divText + '</td><td>' +playerType + '</td><td>'+playerCost+'</td>';


            var divName = '<tr id=\"'+playerId+'\"></tr>';

            $(divName).addClass(playerClass).html(divText).appendTo('#userSquadTable');
        }
    });
}

//Functions to Hide or show the players

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
//    $("#batsman, #bowler, #wkeeper,#rounder,#captain").removeClass("btn-danger");
    $('#batsman').trigger('click');
}

function restoreButtons()
{
    if(!$('#batsman').hasClass('btn-danger')) $('#batsman').trigger('click');
    else if(!$('#bowler').hasClass('btn-danger')) $('#bowler').trigger('click');
    else if(!$('#wkeeper').hasClass('btn-danger')) $('#wkeeper').trigger('click');
    else if(!$('#rounder').hasClass('btn-danger')) $('#rounder').trigger('click');
    else if(!$('#captain').hasClass('btn-danger')) $('#captain').trigger('click');
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

    else if (value<60)
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

function confirm16()
{
    var num = $('.userplayer').length;
    if(num != 16) return false;

    var ids = [];
    var iter = 0;
    $.each($(".userplayer"),function(i,obj){
          if($.inArray($(obj).attr('id'),ids)==-1)
          {
           ids[iter] = $(obj).attr('id');
            iter++;
          }
           });
    if(ids.length!=16)
        return false;

    var idString = ids.join(',');

    $.ajax({
        url: "./confirm16.php",
        method: "POST",
        data: { c16 : idString },
        dataType: "html"
    }).done(function(msg){
        alert(msg);
//        console.log(msg);
        location.reload();
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
