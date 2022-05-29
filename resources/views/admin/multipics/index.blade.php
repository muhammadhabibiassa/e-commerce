@extends('admin.admin_master')


@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            <h3 class="mb-3">Multipics</h3>
                <div class="card-group">
                @foreach($images as $multipics)

                <div class="col-md-4 mt-4">
                    <div class="card">
                        <img src="{{ asset($multipics->image)}}" alt="";>
                    </div>
                </div>
            @endforeach
            </div>
            
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Multipics</div>
                    <div class="card-body">
                        <form action="{{ route('store.multipics') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput2" class="form-label">Multi Image</label>
                                <input type="file" name="image[]" class="form-control" id="exampleFormControlInput2" multiple="">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Add Image</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection