@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="POST">
    <div class="card-body">

      <div class="form-group">
        <label for="menu">Tên danh mục</label>
        <input type="text" name="name" value="{{ $menu->name }}" class="form-control" placeholder="Nhập tên danh mục">
      </div>

      <div class="form-group">
        <label>Danh mục</label>
        <select class="form-control" name="parent_id" id="">
            <option value="0" {{ $menu->parent_id == 0 ? 'selected' : ''}}>Danh mục cha</option>
            @foreach ($menus as $menuParent)
                <option value="{{ $menuParent->id }}" 
                    {{ $menu->parent_id == $menuParent->parent_id ? 'selected' : ''}}>
                    {{ $menuParent->name }}</option>
            @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Mô tả</label>
        <textarea class="form-control" name="description">{{ $menu->description }}</textarea>
      </div>

      <div class="form-group">
        <label>Mô Tả chi Tiết</label>
        <textarea name="content" id="content" class="form-control">{{ $menu->content }}</textarea>
        </div>
      
      <div class="form-group">
        <label for="">Kích hoạt</label>
        <div class="form-check">
          <input class="form-check-input" value="1" type="radio" id="active" name="active" 
            {{ $menu->active ==1 ? 'checked="' : ''}}>
          <label for="active" class="form-check-label">Có</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" value="0" type="radio" id="no_active" name="active" 
          {{ $menu->active ==0 ? 'checked="' : ''}}>
          <label for="no_active" class="form-check-label">Không</label>
        </div>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
    </div>
    @csrf
  </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection