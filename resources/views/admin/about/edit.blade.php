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
                        <div class="card-header">Edit About</div>
                        <div class="card-body">
                            <form action="{{ url('update/about/'.$abouts->id) }}" method="POST">
                            @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{ $abouts->title }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_dis" id="exampleFormControlTextarea1" rows="3" value="{{ $abouts->short_dis }}">{{ $abouts->short_dis }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Long Description</label>
                                    <textarea class="form-control" name="long_dis" id="exampleFormControlTextarea1" rows="3" value="{{ $abouts->long_dis }}">{{ $abouts->long_dis }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
