<?php
/**
 * @var \yii\web\View $this
 * @var \OutDriver\Yii\Application\Trip\TripAddForm $tripAddForm
 */

?>
	<div class="row">
		<div class="col-md-12">
			<div class="info-box">
				<div class="info-box-icon">
					<i class="fas fa-car-side"></i>
				</div>
				<div id="add-trip" class="info-box-content">
					<div class="spinner-border" role="status">
						<span class="sr-only">Loading...</span>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
$js = <<<JS

async function fetchForm() {
    let r;
    await $.ajax({
        url: "/trip/add-trip",
        type: "GET",
        success: function (result) {
            r = result
        },
        error: function () {
            r = 'Непредвиденная ошибка'
        }
    })
    return r
}

fetchForm().then((result) => {
    let container = $("#add-trip");
    container.fadeOut({
        duration: anim_duration,
        complete: () => {
            container.html(result)
            container.fadeIn({duration: anim_duration})
        }
    })
})


$(document).on('beforeSubmit', '#trip-add-form', function (event) {
    result = sendForm(this)
    let container = $("#add-trip");
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
                                $(document).trigger("re-calculate")
                            }
                        })
                    })
                }
            })
        }
    })
    return false;
})

async function sendForm(form) {
    return new Promise(function (resolve) {
        $.ajax({
            url: $(form).attr('action'),
            data: $(form).serialize(),
            type: "POST",
            success: function (result) {
                resolve(result);
            },
            error: function (result) {
                resolve(result);
            }
        });
    });
}

JS;

$this->registerJs($js);
?>