@extends('admin.admin_master')
@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Contact</h2>
            </div>
            <div class="card-body">
                <form action="{{route('store.contact')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Contact Address</label>
                        <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Contact Email</label>
                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Contact Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Contact Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleFormControlInput1" placeholder="Contact Phone">
                    </div>
                    <button type="submit" class="btn btn-primary btn-default">Create</button>
                </form>
            </div>
        </div>
@endsection
