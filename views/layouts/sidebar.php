<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
		<img src="/indriverlogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">Hackathon</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
            <?= \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Водитель',
                        'icon' => 'id-card',
                        'items' => [
                            ['label' => 'Автомобиль', 'url' => ['driver/car'], 'icon' => 'car'],
                        ]
                    ],
                ],
            ]);
            ?>
		</nav>
	</div>
</aside>