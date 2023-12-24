@extends('admin.main')
@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="slider">Title</label>
                <input type="text" name='name' value="{{ $slider->name }}" class="form-control" id="slider" placeholder="Enter slider title">
            </div>
            <div class="form-group">
                <label for="slider">Path</label>
                <input type="text" name='url' value="{{ $slider->url }}" class="form-control" id="slider">
            </div>
            <div class="form-group">
                <label for="slider">Image</label>
                <input type="file" name="file" id="upload" class="form-control">
                <div id="image_show">
                    <a href="{{ $slider->thumb }} " target="_blank">
                        <img src="{{ $slider->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $slider->thumb }}" id="thumb">
            </div>
            <div class="form-group">
                <label for="slider">Sort</label>
                <input type="number" name='sort_by' value="{{ $slider->sort_by }}" class="form-control" id="slider">
            </div>
            <label>Status</label>
            <div class="form-group">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="active" name="active"
                    {{ $slider->active == 1 ? 'checked' : '' }} value="1">
                    <label for="active" class="custom-control-label">Active</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="inactive" name="active"
                    {{ $slider->active == 0 ? 'checked' : '' }} value="0">
                    <label for="no_active" class="custom-control-label">Inactive</label>
                </div>
            </div>
        </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        @csrf
    </form>
@endsection
@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
