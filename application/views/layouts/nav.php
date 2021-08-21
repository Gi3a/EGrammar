<div class="page">
	<nav>
		<div class="nav-left">
			<a href="/id/<? echo $_SESSION['user']['id'] ?>" title="Перейти в профиль <? echo $_SESSION['user']['name'] ?>">
				<i class="far fa-user-circle fa-2x"></i>
			</a>
		</div>
		<div class="nav-mid">
			<? if ($vars['progress'] > 100):?>
				<? $progress = 100; ?>
			<? else: ?>
				<? $progress = $vars['progress']; ?>
			<? endif; ?>
			<div class="meter" title="<? echo $progress ?>%">
				<span style="width: <? echo $progress ?>%"></span>
			</div>
		</div>
		<div class="nav-right">
			<a href="/exit" title="Выйти">
				<i class="fas fa-power-off fa-2x"></i>
			</a>
		</div>
	</nav>