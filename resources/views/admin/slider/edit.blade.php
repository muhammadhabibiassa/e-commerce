@extends('admin.admin_master')


@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="card-header">Edit Slider</div>
                        <div class="card-body">
                            <form action="{{ url('update/slider/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" name="old_image" value="{{ $sliders->image }}">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{ $sliders->title }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $sliders->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleFormControlInput2" class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleFormControlInput2" value="{{ $sliders->image }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset($sliders->image) }}" style="width:400px; height:200px;">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
