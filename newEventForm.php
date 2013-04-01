
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
    alert(title + " " + id);

    $.post('./scripts/addEvent.php', {title: title, userID: id} , function (data){

    	alert(data);
      $('#eventList').append('<li><a class="openEvent" eventID="' + data + '">' + title + '</a></li>').slideDown();
    });

  });

</script>