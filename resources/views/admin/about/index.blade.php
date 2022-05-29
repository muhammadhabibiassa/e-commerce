@extends('admin.admin_master')


@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h3 class="mb-3">About</h3>
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-header">
                        <a href="{{ route('add.about') }}" class="btn btn-primary btn-sm float-right">Add</a>
                    </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="15%">Title</th>
                                    <th scope="col" width="25%">Short Description</th>
                                    <th scope="col" width="15%">Long Description</th>
                                    <th scope="col" width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($abouts as $about)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td> {{ $about->title }} </td>
                                    <td> {{ $about->short_dis }} </td>
                                    <td> {{ $about->long_dis }} </td>
                                    <td>
                                        <a href="{{ url('edit/about/'.$about->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <a href="{{ url('delete/about/'.$about->id) }}" onclick="return confirm('Are you sure to delete this data?')" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection