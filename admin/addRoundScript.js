$(document).ready(function(){
    $('#createButton').click(function(evt){
        var num = $('#roundNum').val();
        num = num - '0';

        if(isNaN(num))
        {
            alert('Please Enter a Number for the round');
            return;
        }
        else
        {
            var check = window.confirm("Do you want to create Round "+num+" ?");

            if(check == true)
            {
                $.ajax({
                    url: "./createRound.php",
                    method: "POST",
                    data: { rno: num },
                    dataType: "html"
                }).done(function(msg){
                     alert('Round '+num+' has been added!!');
//                     alert(msg);
                });
            }
            else{
                return;
            }
        }
    });
});
