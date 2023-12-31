@extends('layouts.user_layout')

@section('content')
    <div class="container mt-5">
        <form method="post" action="{{ url('file-upload') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" />
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea id="summernote" name="content"></textarea>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-danger btn-block">Publish</button>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 450,
            });
        });

    </script>
@endsection
