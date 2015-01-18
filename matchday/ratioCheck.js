function ratioCheck()
{
//    alert('entered Ratiocheck');
    var returnVal = false;
    var i,j;

    if($('.userplayer').length!=11)
    {
        alert('not 11 players');
        return returnVal;
    }

    var playerJq = $('.userplayer');

    var batsman = 0;
    var bowler = 0;
    var rounder = 0;
    var wkeeper = 0;
    var captain = 0;

    for(i=0;i<11;i++)
    {
        for(j=i+1;j<11;j++)
        {
            if($(playerJq[i]).attr('id') == $(playerJq[j]).attr('id'))
            {
                returnVal = true;
                alert('duplicate');
                console.log(playerJq[i]);
                return false;
                break;
            }
        }
    }

    var incrementVals = function (){

    batsman = 0;
    bowler = 0;
    rounder = 0;
    wkeeper = 0;
    captain = 0;

     console.log("playerJq "+playerJq.length);
    for(i=0;i<playerJq.length;i++)
    {
//        alert(getPlayer($(playerJq[i]).attr('id')));
        $.when(getPlayer($(playerJq[i]).attr('id'))).then(function(obj){
//            alert('Entered callback');
            var playerType    = obj.playerType;
            var playerCaptain = obj.playerCaptain;
//            console.log(obj);

            if(playerType.indexOf('atsman')!=-1) batsman++;
            if(playerType.indexOf('owler')!=-1) bowler++;
            if(playerType.indexOf('ounder')!=-1) rounder++;
            if(playerType.indexOf('eeper')!=-1) wkeeper++;

            if(playerCaptain.indexOf('aptain')!=-1) captain++;

        });

    }
    }
    $.when(incrementVals()).then(function(){
//            alert('entered checking function');
            var checkString = batsman.toString() + bowler.toString() + rounder.toString() + wkeeper.toString();

            if(captain >= 1)
            {
                if((checkString=='5411')||(checkString=='5321')||(checkString=='4331')||(checkString=='6321'))
                {
                    alert('correct Ratio:'+checkString);
                    returnVal = true;
                    return true;
                }
                else
                {
                    alert('Your Ratio is not correct '+checkString);
                    returnVal = false;
                    return false;
                }
            }
            else
            {
                alert('You need one Captain'+checkString);
            }
    });

    return returnVal;
}
