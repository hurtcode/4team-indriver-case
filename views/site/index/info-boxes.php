<?php
/**
 * @var \yii\web\View $this
 */

?>
	<div class="row">
		<div class="col-sm-4">
			<div class="info-box" style="height: 100px">
				<span class="info-box-icon bg-info">
					<i class="fas fa-angle-double-down"></i>
				</span>
				<div class="info-box-content">
					<span class="info-box-text">Издержки на километр</span>
					<div id="costs" class="info-box-number">
						<div class="spinner-border" role="status">
							<span class="sr-only">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="info-box" style="height: 100px">
				<span class="info-box-icon bg-info">
					<i class="fas fa-dollar-sign"></i>
				</span>
				<div class="info-box-content">
					<span class="info-box-text">Минимальная цена за километр</span>
					<div id="minimal-price" class="info-box-number">
						<div class="spinner-border" role="status">
							<span class="sr-only">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="info-box" style="height: 100px">
				<span class="info-box-icon bg-info">
					<i class="fas fa-money-bill"></i>
				</span>
				<div class="info-box-content">
					<span class="info-box-text">Желаемый доход</span>
					<div class="form-group">
						<input type="text" class="form-control" id="wish-income"
							   aria-describedby="wish-describe" placeholder="150.000ТГ">
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
$js = <<<JS

async function fetchCosts() {
    return new Promise(function (resolve) {
        $.ajax({
            url: "/driver/costs",
            type: "GET",
            success: function (result) {
                resolve(result)
            },
            error: function () {
                resolve('Непредвиденная ошибка!')
            }
        })
    })
}

fetchCosts().then(function (result) {
    let container = $("#costs");
    container.fadeOut({
        duration: anim_duration,
        complete: function () {
            container.html(result)
            container.fadeIn()
        }
    })
})

async function calculateMinPrice()
{
    
}

async function fetchMinPrice()
{
    
}


JS;
$this->registerJs($js);
?>