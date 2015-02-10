$(document).ready(function(){

    $('#choiceBatting').click(function(){
       $('#battingTable').show();
       $('#bowlingTable').hide();
       $('#choiceBatting').removeClass('btn-danger').addClass('btn-success');
       $('#choiceBowling').removeClass('btn-success').addClass('btn-danger');
    });

    $('#choiceBowling').click(function(){
       $('#bowlingTable').show();
       $('#battingTable').hide();
       $('#choiceBowling').removeClass('btn-danger').addClass('btn-success');
       $('#choiceBatting').removeClass('btn-success').addClass('btn-danger');
    });

    $('#choiceBatting').trigger('click');

});
