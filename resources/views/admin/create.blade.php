<h2 class="page-header">New record</h2>
{!! Form::open(["id"=>"frm","class"=>"form-horizontal", "files" => true]) !!}
@include("admin/_form")
{!! Form::close() !!}