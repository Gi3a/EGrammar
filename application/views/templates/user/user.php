
	<div class="block form">
		<div class="block_user">
			<span>Имя: <? echo $user['name'] ?></span>
			<span>Результат: <? echo $user['result'] ?></span>
			<span>Вопрос: <? echo $user['status'] ?></span>
		</div>
        <div class="block_button">
            <a href="/main" class="form__button form__submit">Продолжить</a>
        </div>
        <div class="block_logs">
            <?php foreach ($logs as $log): ?>
                <div class="block_log">
                    <span>Вопрос №<? echo $log['test_id'] ?></span>
                    <span>Текст на русском: <? echo $log['text_ru'] ?></span>
                    <span>Текст на английском: <? echo $log['text_en'] ?></span>
                    <span>Вы собрали: <? echo $log['correct'] ?></span>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</div>

