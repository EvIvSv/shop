<?php
/**
 * ������� ������
 * =======================
 * $title - ���������
 * $islogin - �������� ���������������� ������������
 * $user - ��� ������������
 * $colBag - ���������� ������� � �������
 * $content - ����������� ����������� ������� 
 * $all_categ - ������ ���������
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
		<!--���� ����-->
		<nav class="nav">
			<ul class="hmenu">
				<li><a href="index.php" class="active">�������</a></li>
				<li><a href="index.php?str=Bag">�������</a></li>
				<li><a href="index.php?str=About">� ���</a></li>
			</ul> 
		</nav>
		<!--����� ����� ����-->

		<div class="sheet clearfix">
			<div class="layout-wrapper">
				<div class="content-layout">
					<div class="content-layout-row">
					
						<!--����� �������-->
						<div class="layout-cell sidebar1">
						
							<!--���� �����������-->
							<div class="block clearfix">
								<div class="blockheader">
									<h3 class="t">�����������</h3>
								</div>
								<div class="blockcontent">
									<form method="post">	
									<? if ($islogin == false): ?>	
										<p>�����<br></p>
										<p><input type="text" name="login"/><br></p>
										<p>������<br></p>
										<p><input type="password" name="pass"/><br></p>
										<p><input type="checkbox" name="remember" class="checkbox"/> ��������� ����<br></p>
										<p>&nbsp;<a href="index.php?str=Reg"/>�����������</a>&nbsp;<br></p>
										<p class="rig"><input type="submit" name="auth" value="�����" class="button"/><br></p>
									<? else: ?>
       									<?=$user?> 
       									<p><a href="index.php?out=1">�����</a></p>
    								<? endif ?>
									</form>
								</div>
							</div>
							<!--����� ����� �����������-->
							
							<!--���� �������-->
							<div class="block clearfix">
								<div class="blockheader">
									<h3 class="t">�������</h3>
								</div>
								<div class="blockcontent">
									<p class="cent">������� � �������<br></p>
									<h3 class="t"><?=$colBag?></h3>
									<form method="post">
										<p class="cent"><input type="submit" name="delbag" value="�������� �����" class="button"/></p>
									</form>
								</div>
							</div>
							<!--����� ����� �������-->
						</div>
						<!--����� ������ ��������-->
						
						<!--���� ��������-->
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
						<!--����� ����� ��������-->
						
						<!--������ �������-->
						<div class="layout-cell sidebar2">
							<!--���� ���������-->
							<div class="block clearfix">
								<div class="blockheader">
									<h3 class="t">������</h3>
								</div>
								<div class="blockcontent">
									<ul>
										<?foreach ($all_categ as $val):?>
											<li><a href="index.php?cat=<?=$val['id_cat']?>"><?=$val['cat_name']?></a></li>
										<?endforeach;?>
									</ul>
								</div>
							</div>
							<!--����� ����� �������-->
						</div>
						<!--����� ������� ��������-->
					</div>
				</div>
			</div>
			<footer class="footer">
				<p>Copyright © 2013. All Rights Reserved.<br></p>
			</footer>

		</div>
		<p class="page-footer"></p>
	</div>
</body>
</html>