@extends('template')

@section('content')
    <div class="container-fluid">
        <div class="row"></div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="content">
                    @foreach($records as $key=>$record)
                        <div id="post_{{$record->id}}" style="margin-bottom: 50px">
                            <h2>{{$record->title}}</h2>
                            <p style="color:gray">{{date('d/m/Y', strtotime($record->pub_date))}}</p>
                            <img src="pics/{{$record->image ? $record->image : 'no_img.png'}}"
                                 style="margin-bottom:10px"/>
                            <p style="color:gray; width: 40%">{{str_limit($record->desc, 200)}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@stop