function addRows()
{
    var i =1;
    $.each(list,function(id,obj){
        var rank = i;
        var pid1 = obj.userId1;
        var pid2 = obj.userId2;
        var score = obj.score;
        var rowHtml = "<td>"+rank+"</td><td>"+pid1+"</td><td>"+pid2+"</td><td>"+score+"</td>";
        var row = "<tr id=\""+i+"\"></tr>";
        if((pid1==yourId)||(pid2==yourId))
        {
            $(row).html(rowHtml).addClass("you").appendTo('#rankingList');

            console.log("added Class");
        }
        else if(i<21)
        {
            $(row).html(rowHtml).appendTo('#rankingList');
        }
        i++;

    });
}
var list;
$(document).ready(function(){

    $.ajax({
        url:"./getRanking.php"
    }).done(function(msg){
        list = $.parseJSON(msg);
        addRows();
    });

});
