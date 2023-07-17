$(document).ready(function(){

    $('#selectallboxes').click(function(){
        if(this.checked) {
            $('.checkboxes').each(function(){
                this.checked = true;
            })
        } else {
            $('.checkboxes').each(function(){
                this.checked = false;
            })
        }
    });


  var div_box = "<div id='load-screen'><div id='loading'></div></div>";
  $("body").prepend(div_box);
  $('#load-screen').delay(700).fadeOut(600, function(){
    $(this).remove();
  });

});

 function loadUsersOnline() {
     $.get("function.php?onlineusers=result", function(data){

        $(".useronline").text(data);

     });
 }

 setInterval(function(){
    loadUsersOnline();

 },500);




    // CKEditor  
    // ClassicEditor
    //     .create( document.querySelector( '#body' ) )
    //     .catch( error => {
    //     console.error( error );
    // } );

    // ClassicEditor
    //     .create( document.querySelector( '#editp' ) )
    //     .catch( error => {
    //     console.error( error );
    // });

       





















