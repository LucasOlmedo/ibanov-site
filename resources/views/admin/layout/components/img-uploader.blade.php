@push('page-css')
    <style>
        .file-upload {
            background-color: #ffffff;
            margin: 0 auto;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            border: 3px dashed #007bff;
            border-radius: 5px;
            position: relative;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h5 {
            font-weight: 100;
            text-transform: uppercase;
            color: #007bff;
            padding: 20px 0;
        }

        .file-upload-image {
            height: 250px;
            margin: auto;
        }
    </style>
@endpush
@push('img-uploader-component')
<div class="file-upload">
    <div class="image-upload-wrap">
        <input class="file-upload-input" type='file' onchange="readURL(this);"
               accept="image/*" name="fileupload"/>
        <div class="drag-text">
            <h5>
                Arraste um arquivo ou clique para adicionar uma imagem <br>
                <i class="zmdi zmdi-hc-5x zmdi-cloud-upload"></i>
            </h5>
        </div>
    </div>
    <div class="file-upload-content">
        <img class="file-upload-image" src="#" alt="Imagem"/>
        <div class="image-title-wrap">
            <button type="button" onclick="removeUpload()" class="btn btn-danger m-t-15">
                <i class="zmdi zmdi-close"></i> &nbsp;Remover
            </button>
        </div>
    </div>
</div>
@endpush
@push('page-js')
    <script>
        let $imgUpWrap = $('.image-upload-wrap'),
            $fileUpdImg = $('.file-upload-image'),
            $fileUpdCnt = $('.file-upload-content');

        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $imgUpWrap.hide();
                    $fileUpdImg.attr('src', e.target.result);
                    $fileUpdCnt.show();
                    $('.image-title').html(input.files[0].name);
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            let $fileUpInput = $('.file-upload-input');
            $fileUpInput.replaceWith($fileUpInput.clone());
            $fileUpdCnt.hide();
            $imgUpWrap.show();
        }

        $imgUpWrap.bind('dragover', function () {
            $(this).addClass('image-dropping');
        }).bind('dragleave', function () {
            $(this).removeClass('image-dropping');
        });
    </script>
@endpush
