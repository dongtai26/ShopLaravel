@extends('admin.main')
@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Menu name</label>
                <input type="text" name='name' value="{{ $menu->name }}" class="form-control" id="menu"
                    placeholder="Enter menu name">
            </div>
            <div class="form-group">
                <label for="menu">Menu</label>
                <select name='parent_id' class="form-control">
                    <option value="0" {{ $menu->parent_id == 0 ? 'selected' : '' }}>
                        Parent Menu
                    </option>
                    @foreach ($menus as $menuParent)
                        <option value="{{ $menuParent->id }}" {{ $menu->parent_id == $menuParent->id ? 'selected' : '' }}>
                            {{ $menuParent->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="menu">Description</label>
                <textarea name="description" class="form-control">{{ $menu->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="menu">Description Detail</label>
                <textarea name="content" id="content" class="form-control">{{ $menu->content }}</textarea>
            </div>
            <label>Status</label>
            <div class="form-group">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="active" name="active"
                        {{ $menu->active == 1 ? 'checked' : '' }} value="1">
                    <label for="active" class="custom-control-label">Active</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="inactive" name="active"
                        {{ $menu->active == 0 ? 'checked' : '' }} value="0">
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
