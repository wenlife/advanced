  <link rel="stylesheet" href="js/cropper.css">
  <style>
   .co .container {
      max-width: 960px;
      margin: 20px auto;
    }

  .co  img {
      max-width: 100%;
    }

   .co .row,
   .co .preview {
      overflow: hidden;
    }

    .co .col {
      float: left;
    }

   .co .col-6 {
      width: 50%;
    }

   .co .col-3 {
      width: 25%;
    }

   .co .col-2 {
      width: 16.7%;
    }

   .co .col-1 {
      width: 8.3%;
    }
  </style>
<div class="row">
  <div class="container co">
    <h1>Customize preview for Cropper</h1>
    <div class="row">
      <div class="col col-6">
        <img id="image" src="images/picture.jpg" alt="Picture">
      </div>
      <div class="col col-3">
        <div class="preview"></div>
      </div>
      <div class="col col-2">
        <div class="preview"></div>
      </div>
      <div class="col col-1">
        <div class="preview"></div>
      </div>
    </div>
    <p>Data: <span id="data"></span></p>
    <p>Crop Box Data: <span id="cropBoxData"></span></p>
    <h3>Result</h3>
       <div class="alert" role="alert"></div>
        <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
    <p>
      <button type="button" id="button">Crop</button>
    </p>
    <div id="result"></div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="js/cropper.js"></script>
  <script>
    function each(arr, callback) {
      var length = arr.length;
      var i;

      for (i = 0; i < length; i++) {
        callback.call(arr, arr[i], i, arr);
      }

      return arr;
    }

    window.addEventListener('DOMContentLoaded', function () {
      var $alert = $('.alert');
      var image = document.querySelector('#image');
      var avatar = document.querySelector('#image');
      var previews = document.querySelectorAll('.preview');
      var data = document.querySelector('#data');
      var cropBoxData = document.querySelector('#cropBoxData');
      var button = document.getElementById('button');
      var result = document.getElementById('result');
            var $progress = $('.progress');
      var $progressBar = $('.progress-bar');
       $alert.hide();
      var cropper = new Cropper(image, {
          ready: function () {
            cropper.zoomTo(1);
            var clone = this.cloneNode();

            clone.className = '';
            clone.style.cssText = (
              'display: block;' +
              'width: 100%;' +
              'min-width: 0;' +
              'min-height: 0;' +
              'max-width: none;' +
              'max-height: none;'
            );

            each(previews, function (elem) {
              elem.appendChild(clone.cloneNode());
            });
          },

          crop: function (event) {
            var data = event.detail;
            var cropper = this.cropper;
            var imageData = cropper.getImageData();
            var previewAspectRatio = data.width / data.height;
            data.textContent = JSON.stringify(cropper.getData());
          cropBoxData.textContent = JSON.stringify(cropper.getCropBoxData());

            each(previews, function (elem) {
              var previewImage = elem.getElementsByTagName('img').item(0);
              var previewWidth = elem.offsetWidth;
              var previewHeight = previewWidth / previewAspectRatio;
              var imageScaledRatio = data.width / previewWidth;

              // elem.style.height = previewHeight + 'px';
              // previewImage.style.width = imageData.naturalWidth / imageScaledRatio + 'px';
              // previewImage.style.height = imageData.naturalHeight / imageScaledRatio + 'px';
              // previewImage.style.marginLeft = -data.x / imageScaledRatio + 'px';
              // previewImage.style.marginTop = -data.y / imageScaledRatio + 'px';
            });
          },
          zoom: function (event) {
          // Keep the image in its natural size
          if (event.detail.oldRatio === 1) {
            event.preventDefault();
          }
        },
        });
      button.onclick = function () {
        result.innerHTML = '';
        result.appendChild(cropper.getCroppedCanvas());

        var initialAvatarURL;
        var canvas;

        if (cropper) {
          canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
          });

          initialAvatarURL = avatar.src;
          avatar.src = canvas.toDataURL();
          
        //  $progress.show();
        //  $alert.removeClass('alert-success alert-warning');
          canvas.toBlob(function (blob) {

            var formData = new FormData();

            formData.append('avatar', blob, 'avatar.jpg');
            formData.append('avatar','avatar.jpg');
            //alert();
            $.ajax({
              type: 'POST',
              url: "index.php?r=center/setavatar",
              data: formData,
              processData: false,
             // contentType: false,
              dataType:"text",

              xhr: function () {
                var xhr = new XMLHttpRequest();

                xhr.upload.onprogress = function (e) {
                  var percent = '0';
                  var percentage = '0%';

                  if (e.lengthComputable) {
                    percent = Math.round((e.loaded / e.total) * 100);
                    percentage = percent + '%';
                    $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                  }
                };

                return xhr;
              },

              success: function (data) {
                $alert.show().addClass('alert-success').text('Upload success'+data);
              },

              error: function () {
                avatar.src = initialAvatarURL;
                $alert.show().addClass('alert-warning').text('Upload error');
              },

              complete: function () {
                $progress.hide();
              },
            });
          });
        }
      };
    });
  </script>