@extends('admin.admin_master')


@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h3 class="mb-3">Message</h3>
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="15%">Name</th>
                                    <th scope="col" width="25%">Email</th>
                                    <th scope="col" width="15%">Subject</th>
                                    <th scope="col" width="15%">Message</th>
                                    <!-- <th scope="col" width="15%"></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($messages as $message)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td> {{ $message->name }} </td>
                                    <td> {{ $message->email }} </td>
                                    <td> {{ $message->subject }} </td>
                                    <td> {{ $message->message }} </td>
                                    <!-- <td>
                                        <a href="{{ url('delete/message/'.$message->id) }}" onclick="return confirm('Are you sure to delete this data?')" class="btn btn-danger btn-sm">Delete</a>
                                    </td> -->
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