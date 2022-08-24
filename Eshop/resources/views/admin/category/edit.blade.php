@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edet/Updet Category</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" value="{{$category->name}}" class="form-control" name="name">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" value="{{$category->slug}}" class="form-control" name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" row="3" class="form-control">{{ $category->description }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" {{ $category->status =="1" ? 'checked':''}} name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Popular</label>
                        <input type="checkbox"   {{ $category->popular =="1" ? 'checked':''}} name="popular">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta title</label>
                        <input type="text"  value="{{$category->meta_title}}" class="form-control" name="meta_title">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta description</label>
                        <textarea class="form-control" row="3" name="meta_descrip">{{$category->meta_descrip}}</textarea>

                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta keywords</label>
                        <textarea class="form-control" row="3" name="meta_keywords">{{$category->meta_keywords}}</textarea>
                    </div>
                    @if ($category->image)
                         <img src="{{asset('assets/uploads/category/'.$category->image)  }}" alt="Category image">
                        
                    @endif
                    <div class="col-md-12 mb-3">
                        <label for=""> Images</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>


                </div>



            </form>
        </div>
    </div>
@endsection
