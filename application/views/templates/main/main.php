
	<div class="test">
		<form class="form" method="post" action="/check">
			<div class="test-title">
				<span>Соберите предложение на английском языке</span>
				<span class="test-description">
					<? echo $vars['description'] ?>
				</span>
			</div>
			<div class="test-result" id="result">
				<input type="hidden" id="willSend" name="props">
			</div>
			<div class="test-words" id="words">
				<?php foreach ($words as $word): ?>
					<span><? echo $word ?></span><br>
				<?php endforeach; ?>
			</div>
			<div class="test-check">
				<input class="form__submit" type="submit" value="Проверить">
			</div>
		</form>
	</div>
</div>



<script>
	$(document).ready(function() {

	

	$("#words").on("click", "span", function (event) {
		var text = $(this).text();
		var getText = $(".test-result > span").text();
		if (!getText.indexOf(text) > -1)
		{
			$(".test-result").append("<span>" + text + "</span>	");
			$("#willSend").val($("#willSend").val() + " " + text);
			$(this).hide();
		}
	});

	

	$("#result").on("click", "span", function (event) {
		var text = $(this).text();
    	$(this).hide();
		$('#willSend').val( $('#willSend').val().replace(text + ' ',''));
		$(".test-words").append("<span>" + text + "</span>	");
	});

	function appendToStorage(name, data)
	{
		var old = localStorage.getItem(name);
		if(old === null) old = "";
		localStorage.setItem(name, old + data);
	}

	});
</script>