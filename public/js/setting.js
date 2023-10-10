$(document).ready(() => {
    $('.account-click').click(() => {
        $('.account-down-arrow').fadeToggle();
    })
    $('.security-click').click(() => {
        $('.security-down-arrow').fadeToggle();
    })

    // for crop profile image
    var $modal = $('#image');
    var image = document.getElementById('cropImage');
    var cropper;

    $("body").on("change", ".cropImage", function(e) {
        var files = e.target.files;
        var done = function(url) {
            image.src = url;
            $modal.modal('show');
        };

        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function() {
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var image = reader.result;
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/account/image/update",
                    data: {
                        '_token': $('#_token').val(),
                        'id': $('#id').val(),
                        'image': image
                    },
                    success: function(data) {
                        $modal.modal('hide');
                        location.reload();
                    }
                });
            }
        });
    });
})
