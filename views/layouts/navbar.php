<?php

use yii\helpers\Html;

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?= \yii\helpers\Url::home() ?>" class="nav-link">Dashboard</a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- Notifications Dropdown Menu -->
		<!--		<li class="nav-item dropdown">-->
		<!--			<a class="nav-link" data-toggle="dropdown" href="#">-->
		<!--				<i class="far fa-bell"></i>-->
		<!--				<span class="badge badge-warning navbar-badge"></span>-->
		<!--			</a>-->
		<!--			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">-->
		<!--				<span class="dropdown-header">0</span>-->
		<!--				<div class="dropdown-divider"></div>-->
		<!--				<a href="#" class="dropdown-item">-->
		<!--					<i class="fas fa-file mr-2"></i> 3 new reports-->
		<!--					<span class="float-right text-muted text-sm">2 days</span>-->
		<!--				</a>-->
		<!--			</div>-->
		<!--		</li>-->
		<li class="nav-item">
            <?= Html::a(
                '<i class="fas fa-sign-out-alt"></i>',
                ['/driver/logout'],
                ['data-method' => 'post', 'class' => 'nav-link']
            ) ?>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
	</ul>
</nav>
<!-- /.navbar -->