<div class="form-group">
    {{ Form::label($name, null, ['class' => 'control-label col-md-3']) }}
    {{ Form::select($name, $value,$selected, array_merge(['class' => 'form-control'], $attributes)) }}
</div>
