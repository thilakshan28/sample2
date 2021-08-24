@extends('layouts.admin.master')
@section('title','Report')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">

                <h6 class="float-left ml-2">Monthly Post Report</br>
                    </br>
                    Month:{{ date("F", strtotime($month)).' '. $year }}
                </h6>
            </div>
            <div class="card-body">
                <form method="get">
                    <select name="year" class="btn btn-outline-info ml-2">
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ request()->input('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                    <select name="month" class="btn btn-outline-info ml-2">
                        @foreach($months as $month)
                            <option value="{{ date("m", strtotime($month)) }}" {{ request()->input('month') == date("m", strtotime($month)) ? 'selected' : '' }}>{{ date("F", strtotime($month)) }}</option>
                        @endforeach
                    </select>
                    <input class="btn btn-success ml-2" type="submit" name="action" value="Generate">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export</button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item" type="submit" name="action" value="pdf"><i class="mdi mdi-file-pdf mdi-18px"></i>PDF</button>
                          </div>
                </form>
            <table class="table table-striped">

                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Post </th>
                        <th>Comments</th>
                    </tr>

                    @foreach ( $data as $data1 )
                    <tr>
                        <td>{{$data1['user']}}</td>
                        <td>{{$data1['date']}}</td>
                        <td>{{$data1['posts']}}</td>
                        <td>{{$data1['comments']}}</td>
                    </tr>
                    @endforeach

            </table>
            <div class="pt-2">
            </div>
        </div>
    </div>
</div>
</div>
@endsection
