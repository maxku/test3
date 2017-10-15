<h2 class="page-header">Edit record</h2>
{!! Form::model($record,["id"=>"frm","class"=>"form-horizontal", "files" => true]) !!}
@include("admin/_form")
{!! Form::close() !!}