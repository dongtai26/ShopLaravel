@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="slider">Title</label>
                <input type="text" name='name' value="{{ old('name') }}" class="form-control" id="slider" placeholder="Enter slider title">
            </div>
            <div class="form-group">
                <label for="slider">Path</label>
                <input type="text" name='url' value="{{ old('url') }}" class="form-control" id="slider">
            </div>
            <div class="form-group">
                <label for="slider">Image</label>
                <input type="file" name="file" id="upload" class="form-control">
                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>
            <div class="form-group">
                <label for="slider">Sort</label>
                <input type="number" name='sort_by' value="{{ old('sort_by') }}" class="form-control" id="slider">
            </div>
            <label>Status</label>
            <div class="form-group">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="active" name="active" value="1">
                    <label for="active" class="custom-control-label">Active</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="inactive" name="active" value="0">
                    <label for="no_active" class="custom-control-label">Inactive</label>
                </div>
            </div>
        </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
        @csrf
    </form>
@endsection
@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
