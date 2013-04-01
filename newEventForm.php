
<h3>Create a new event</h3>
<form class="form-horizontal" id="submitEvent">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Title</label>
    <div class="controls">
      <input type="text" id="inputTitle" placeholder="Title">
    </div>
  </div>
  <button type="submit" class="btn">Create</button>
</form>
<script type="text/javascript">

$('#submitEvent').submit(function(event){
    event.preventDefault();
    var form = $(this);

    title = $form.find( 'input[name="title"]' ).val(),
    id = $('#getUserID').attr('userID');

    $.post('./scripts/addEvent.php', {title: title, userID: id}, function (data){

    	alert(data);
      $('#eventList').append('<li><a class="openEvent" eventID="' + data + '">' + title + '</a></li>').slideDown();
    });

  });

</script>
