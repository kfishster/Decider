
<h3>Create a new event</h3>
<form class="form-horizontal" id="submitEvent">
  
    
      <input type="text" id="titleinp" placeholder="Title">
    
  
  <button type="submit" class="btn">Create</button>
</form>
<script type="text/javascript">

$('#submitEvent').submit(function(event){
    event.preventDefault();
    var $form = $(this);

    title = $('#titleinp').val(),
    id = $('#getUserID').attr('userID');

    $.post('./scripts/addEvent.php', {title: title, userID: id} , function (data){

      $('#eventList').append('<li><a class="openEvent" eventID="' + data + '">' + title + '</a></li>').slideDown();



      $('.openEvent').click(function(){

        id = $(this).attr('eventID');
        $('#eventContent').fadeOut("slow", function(){

            $(this).load('eventPage.php',{id:id} ,function(){

              $(this).fadeIn("slow");
          });

        });

      });

    });

  });

</script>