@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        <h2> Welcome {!! Auth::user()->name !!} to Arsenaltech - Portfolio Management</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
