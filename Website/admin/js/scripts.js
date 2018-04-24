ClassicEditor
    .create( document.querySelector( '#editor' ), {
        toolbar: [ 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
    }) 
    .catch( error => {
        console.log( error );
    });

$(document).ready(function(){
    //Select All Checkboxes
    $('#selectAllBoxes').click(function(event){
        if(this.checked) {
            $('.checkboxes').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkboxes').each(function(){
                this.checked = false;
            });
        }
    });
    //Admin Loader Animation
    var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    $('body').prepend('div_box');
    $('#load-screen').delay(700).fadeOut(600, function() {
       $(this).remove(); 
    });
});

