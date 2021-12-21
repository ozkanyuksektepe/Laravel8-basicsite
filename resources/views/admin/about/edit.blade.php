@extends('admin.admin_master')
@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Edit About</h2>
            </div>
            <div class="card-body">
                <form action="{{url('update/about/'.$home_abouts->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">About Title</label>
                        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{$home_abouts->title}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">About Short Description</label>
                        <textarea class="form-control" name="short_desc" id="exampleFormControlTextarea1" rows="3"> {{$home_abouts->short_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">About Long Description</label>
                        <textarea class="form-control" name="long_desc" id="exampleFormControlTextarea1" rows="3"> {{$home_abouts->long_desc}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-default">Update</button>
                </form>
            </div>
        </div>
@endsection
