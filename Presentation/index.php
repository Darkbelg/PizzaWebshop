
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        Test
    </title>
</head>
<body>
<?php
//print($zaak[1]->getNaam());
?>
<div class="well">
	<div id="datetimepicker1" class="input-append date">
		<input data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
		<span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
	</div>
</div>
<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR'
        });
    });
</script>
</body>
</html>