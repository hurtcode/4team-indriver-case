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
							   aria-describedby="wish-describe"
							   value="<?= Yii::$app->user->getIdentity()->authority()->goal ?>">
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

async function calculateMinPrice(goal = '') {
    let url = '/driver/calculate-min-price'
    if (goal !== '') {
        url += "?goal="+goal
    }
    return new Promise(function (resolve) {
        $.ajax({
            url: url,
            type: "GET",
            success: function (result) {
                resolve(result)
            },
            error: function () {
                resolve("0")
            }
        })
    })
}

async function fetchMinPrice() {
    return new Promise(function (resolve) {
        $.ajax({
            url: "/driver/min-price",
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

calculateMinPrice().then(fetchMinPrice).then(function (result) {
    let container = $("#minimal-price");
    container.fadeOut({
        duration: anim_duration,
        complete: function () {
            container.html(result)
            container.fadeIn()
        }
    })
})

$("#wish-income").on("focusout", function (){
    let container = $("#minimal-price");
    let goal = $("#wish-income").val()
    result = calculateMinPrice(goal).then(fetchMinPrice);
	container.fadeOut({
        duration: anim_duration,
        complete: () => {
            container.html(preloader())
            container.fadeIn({
                duration: anim_duration,
                complete: () => {
                    result.then((res) => {
                        container.fadeOut({
                            duration: anim_duration,
                            complete: () => {
                                container.html(res)
                                container.fadeIn({
                                    duration: anim_duration
                                })
                            }
                        })
                    })
                }
            })
        }
    })
})

$(document).on('re-calculate', function () {

    let costs_container = $("#costs");
    result = fetchMinPrice();
    costs_container.fadeOut({
        duration: anim_duration,
        complete: () => {
            costs_container.html(preloader())
            costs_container.fadeIn({
                duration: anim_duration,
                complete: () => {
                    result.then((res) => {
                        costs_container.fadeOut({
                            duration: anim_duration,
                            complete: () => {
                                costs_container.html(res)
                                costs_container.fadeIn({
                                    duration: anim_duration
                                })
                            }
                        })
                    })
                }
            })
        }
    })

    let minipal_price_container = $("#minimal-price");
    result = calculateMinPrice().then(fetchMinPrice);
    minipal_price_container.fadeOut({
        duration: anim_duration,
        complete: () => {
            minipal_price_container.html(preloader())
            minipal_price_container.fadeIn({
                duration: anim_duration,
                complete: () => {
                    result.then((res) => {
                        minipal_price_container.fadeOut({
                            duration: anim_duration,
                            complete: () => {
                                minipal_price_container.html(res)
                                minipal_price_container.fadeIn({
                                    duration: anim_duration
                                })
                            }
                        })
                    })
                }
            })
        }
    })
    
    $("#reload-history").trigger('click')
})

JS;
$this->registerJs($js, \yii\web\View::POS_LOAD);
?>