<?php
/**
 * @var \yii\web\View $this
 */

?>

	<div class="row">
		<div class="col-md-12">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">
						Совершенные поездки
					</h3>
					<div class="float-right">
						<a id="reload-history" href="#"><i class="fas fa-circle"></i></a>
					</div>
				</div>
				<div id="trip-history" class="card-body">
					<div class="spinner-border" role="status">
						<span class="sr-only">Loading...</span>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
$js = <<< JS

async function fetchTrips() {
    return new Promise(function (resolve) {
        $.ajax({
            url: "/trip/all-trips",
            type: "GET",
            success: function (result) {
                resolve(result)
            }, error: function () {
                resolve("Непредвиденная ошибка!")
            }
        })
    })
}

fetchTrips().then((result) => {
    let container = $("#trip-history")
    container.fadeOut({
        duration: anim_duration,
        complete: () => {
            container.html(result)
            container.fadeIn({
                duration: anim_duration
            })
        }
    })
})

$("#reload-history").on('click', function () {
    let container = $("#trip-history")
    let result = fetchTrips()
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
});

JS;
$this->registerJs($js);
?>