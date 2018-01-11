@extends('layouts.dashboard-btn')
@section('title', 'Metrics Report')
@section('secondary-btn')
    <a data-toggle="modal"
       data-target="#pdf-{{ $book->book_id }}"
       class="btn btn-default pointer pull-right">
            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            Download PDF
    </a>
    @include('pdf-selector')
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $year !== null ? $year . " " : "" }}
                        Metrics report - {{ $book->title }}
                    </div>

                    <div class="panel-body">
                        @include('books.report')
                        <p class="text-muted">
                            <i class="fa fa-info-circle" aria-hidden="true"></i> You may click on a year to view its monthly breakdown.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
