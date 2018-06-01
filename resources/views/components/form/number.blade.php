<div class="form-group">
    {{ Form::label($name, null, ['class' => 'control-label col-md-3']) }}
    {{ Form::number($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
</div>