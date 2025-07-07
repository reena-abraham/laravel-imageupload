<!DOCTYPE html>
<html>
<head>
    <title>Ajax Image Upload</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

</head>
<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2>Ajax Image Upload</h2>
            </div>
            <div class="panel-body">
                <img id="preview-image" width="300px">

                <form  id="image-upload" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="inputImage">Image:</label>
                        <input type="file" name="image" id="inputImage" class="form-control">
                        <span class="text-danger" id="image-input-error"></span>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#image-upload').submit(function(e) {

        e.preventDefault();
        let formData = new FormData(this);
        $('#image-input-error').text('');
        $.ajax({
            type: 'POST',
            url: "{{ route('image.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response) {
                    var image_url = "{{ asset('uploads') }}/" + response.filePath;
                    $('#preview-image').attr('src', image_url);
                }
            },
            error: function(response) {
                $('#image-input-error').text(response.responseJSON.message);
            }
        });
    });
</script>
</html>
