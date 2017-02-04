/**
 * Created by Pratik on 11/16/2016.
 */
$(document).ready(function () {

    $('input[name=filter]').change(function(){

        /*get the script to select the radio button*/
        var value = $("input[type='radio']:checked").val();
        if (value==1){
            $('#title').css('display','block');
            $('#desc').css('display','none');

        }else if (value==2){
            $('#desc').css('display','block');
            $('#title').css('display','none');

        }else if (value==3){

            $('#desc').css('display','none');
            $('#title').css('display','none');
        }
    });


    $('#filterButton').on('click',function () {
        var value = $("input[type='radio']:checked").val();
        if(value==1){
            var searchText = $('#title').val();
            window.location.replace('Part04_Search.php?title='+searchText);
        }else if(value==2){
            var searchText = $('#desc').val();
            window.location.replace('Part04_Search.php?desc='+searchText);
        }else if(value==3){
            window.location.replace('Part04_Search.php?nofilter=all')       ;
        }
    })


    $('#navSearch').on('click',function () {
        var search_text = $('#navbar_search_id').val();
        //alert(search_text);
       // var prefix = location.pathname.split('/')[1];
        if(search_text!=null)
            window.location.replace('Part04_Search.php?title='+search_text);
    })

});