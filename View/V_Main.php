<?php
/**
 * Главный шаблон
 * =======================
 * $title - заголовок
 * $islogin - проверка авторизованности пользователя
 * $user - имя пользователя
 * $colBag - количество товаров в корзине
 * $content - подключение внутреннего шаблона 
 * $all_categ - массив категорий
 * 
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$title?></title>
		<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

		<!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<link rel="stylesheet" href="View/style/style.css" media="screen">
		<!--[if lte IE 7]><link rel="stylesheet" href="View/V_Main/style.ie7.css" media="screen" /><![endif]-->
		<link rel="stylesheet" href="View/style/style.responsive.css" media="all">

		<script src="View/script/jquery.js"></script>
		<script src="View/script/script.js"></script>
		<script src="View/script/script.responsive.js"></script>

		<style>

		</style>
	</head>
<body>
	<div id="main">
		<header class="header">
			<div class="shapes"></div>				
		</header>
		<!--Блок меню-->
		<nav class="nav">
			<ul class="hmenu">
				<li><a href="index.php" class="active">Главная</a></li>
				<li><a href="index.php?str=Bag">Корзина</a></li>
				<li><a href="index.php?str=About">О нас</a></li>
			</ul> 
		</nav>
		<!--Конец блока меню-->

		<div class="sheet clearfix">
			<div class="layout-wrapper">
				<div class="content-layout">
					<div class="content-layout-row">
					
						<!--Левый сайдбар-->
						<div class="layout-cell sidebar1">
						
							<!--Блок авторизации-->
							<div class="block clearfix">
								<div class="blockheader">
									<h3 class="t">Авторизация</h3>
								</div>
								<div class="blockcontent">
									<form method="post">	
									<? if ($islogin == false): ?>	
										<p>Логин<br></p>
										<p><input type="text" name="login"/><br></p>
										<p>Пароль<br></p>
										<p><input type="password" name="pass"/><br></p>
										<p><input type="checkbox" name="remember" class="checkbox"/> Запомнить меня<br></p>
										<p>&nbsp;<a href="index.php?str=Reg"/>Регистрация</a>&nbsp;<br></p>
										<p class="rig"><input type="submit" name="auth" value="Войти" class="button"/><br></p>
									<? else: ?>
       									<?=$user?> 
       									<p><a href="index.php?out=1">Выход</a></p>
    								<? endif ?>
									</form>
								</div>
							</div>
							<!--Конец блока авторизации-->
							
							<!--Блок корзины-->
							<div class="block clearfix">
								<div class="blockheader">
									<h3 class="t">Корзина</h3>
								</div>
								<div class="blockcontent">
									<p class="cent">Товаров в корзине<br></p>
									<h3 class="t"><?=$colBag?></h3>
									<form method="post">
										<p class="cent"><input type="submit" name="delbag" value="Оформить заказ" class="button"/></p>
									</form>
								</div>
							</div>
							<!--Конец блока корзины-->
						</div>
						<!--Конец левого сайдбара-->
						
						<!--Блок контента-->
						<div class="layout-cell content">
							<article class="post article">
								<div class="postmetadataheader">
									<h2 class="postheader"><?=$title?></h2>
								</div>								
								<div class="postcontent postcontent-0 clearfix">
									<div class="content-layout layout-item-0">
										<div class="content-layout-row">
											<div class="layout-cell layout-item-1" style="width: 100%">
												<?=$content?>
											</div>
										</div>
									</div>
								<!--</div>-->
							</article>
						</div>
						<!--Конец блока контента-->
						
						<!--Правый сайдбар-->
						<div class="layout-cell sidebar2">
							<!--Блок категорий-->
							<div class="block clearfix">
								<div class="blockheader">
									<h3 class="t">Товары</h3>
								</div>
								<div class="blockcontent">
									<ul>
										<?foreach ($all_categ as $val):?>
											<li><a href="index.php?cat=<?=$val['id_cat']?>"><?=$val['cat_name']?></a></li>
										<?endforeach;?>
									</ul>
								</div>
							</div>
							<!--Конец блока товаров-->
						</div>
						<!--Конец правого сайдбара-->
					</div>
				</div>
			</div>
			<footer class="footer">
				<p>Copyright В© 2013. All Rights Reserved.<br></p>
			</footer>

		</div>
		<p class="page-footer"></p>
	</div>
</body>
</html>