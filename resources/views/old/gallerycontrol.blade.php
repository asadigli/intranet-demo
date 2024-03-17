@extends('new.master')

@section('body')
<link rel="stylesheet" href="{{ asset('css/dropzone.css')}}">
<style media="screen">
.dropzone {
  background: white;
  border-radius: 5px;
  border: 2px dashed rgb(0, 135, 247);
  border-image: none;
  max-width:93%;
  margin-left: auto;
  margin-right: auto;
}
.dz-max-files-reached {background-color: red};

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Gallery
        <small>more images can be added </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Gallery</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Product Gallery
                <!-- - <small><a href="/oldbalance">old balance</a> </small> -->
              </h3>
              <hr>
            </div>

            @if(Session::has('images_added'))
              <center>
                <div class="col-md-4" style="width:90%;">
                  <div class="alert alert-success">
                    {{Session::get('images_added')}}
                  </div>
                </div>
              </center>
            @endif
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-group" method="post" action="/addgallery" enctype="multipart/form-data">
                  {{ csrf_field() }}
                @php
                $prod = App\Products::all()
                @endphp
                <select class="form-control" name="product_id">
                    @foreach($prod as $prod)
                      <option value="{{$prod->id}}">{{$prod->product_name}}</option>
                    @endforeach
                </select>
                <br>
                <input type="file" class="form-control form-control-line" name="pictures[]" multiple>
                <br>
                <button class="btn btn-success pull-right" type="submit" name="submit">Add</button>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
  <script src="{{ asset('dist/js/app.min.js')}}"></script>
  <script src="{{ asset('dist/js/demo.js')}}"></script>
  <script src="{{ asset('/js/dropzone.js')}}"></script>
  <script type="text/javascript">
    Dropzone.autoDiscover = false;
      $(".dropzone").dropzone({
       addRemoveLinks: true,
       removedfile: function(file) {
        var name = file.name;

        $.ajax({
         type: 'POST',
         url: 'upload.php',
         data: {name: name,request: 2},
         sucess: function(data){
          console.log('success: ' + data);
         }
        });
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
       }
      });
      Dropzone.options.myAwesomeDropzone = {
          paramName: "file", // The name that will be used to transfer the file
          maxFilesize: 10, // MB
          accept: function(file, done) {
            if (file.name == "justinbieber.jpg") {
              done("Naha, you don't.");
            }
            else { done(); }
          }
        };
    var dropzone = new Dropzone('#demo-upload', {
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    parallelUploads: 2,
    thumbnailHeight: 120,
    thumbnailWidth: 120,
    maxFilesize: 3,
    filesizeBase: 1000,
    thumbnail: function(file, dataUrl) {
      if (file.previewElement) {
        file.previewElement.classList.remove("dz-file-preview");
        var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
        for (var i = 0; i < images.length; i++) {
          var thumbnailElement = images[i];
          thumbnailElement.alt = file.name;
          thumbnailElement.src = dataUrl;
        }
        setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
      }
    }

    });


    // Now fake the file upload, since GitHub does not handle file uploads
    // and returns a 404

    var minSteps = 6,
      maxSteps = 60,
      timeBetweenSteps = 100,
      bytesPerStep = 100000;

    dropzone.uploadFiles = function(files) {
    var self = this;

    for (var i = 0; i < files.length; i++) {

      var file = files[i];
      totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

      for (var step = 0; step < totalSteps; step++) {
        var duration = timeBetweenSteps * (step + 1);
        setTimeout(function(file, totalSteps, step) {
          return function() {
            file.upload = {
              progress: 100 * (step + 1) / totalSteps,
              total: file.size,
              bytesSent: (step + 1) * file.size / totalSteps
            };

            self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
            if (file.upload.progress == 100) {
              file.status = Dropzone.SUCCESS;
              self.emit("success", file, 'success', null);
              self.emit("complete", file);
              self.processQueue();
              //document.getElementsByClassName("dz-success-mark").style.opacity = "1";
            }
          };
        }(file, totalSteps, step), duration);
      }
    }
    }
  </script>
@endsection
