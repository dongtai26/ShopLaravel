@extends('admin.main')
@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="product">Product name</label>
                <input type="text" name='name' value="{{ old('name') }}" class="form-control" id="product" placeholder="Enter product name">
            </div>
            <div class="form-group">
                <label for="product">Product</label>
                <select name='menu_id' class="form-control">
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="product">Price</label>
                <input type="number" name='price' value="{{ old('price') }} " class="form-control" id="price">
            </div>
            <div class="form-group">
                <label for="product">Price Sale</label>
                <input type="number" name='price_sale' value="{{ old('price_sale') }}" class="form-control" id="price_sale">
            </div>
            <div class="form-group">
                <label for="menu">Description</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="product">Description Detail</label>
                <textarea name="content" id="content" class="form-control">{{ old('content') }} </textarea>
            </div>
            <div class="form-group">
                <label for="product">Product image</label>
                <input type="file" name="file" id="upload" class="form-control">
                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
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
