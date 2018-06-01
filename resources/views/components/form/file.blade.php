<div class="form-group">
    {{ Form::label($name, 'Image Product', ['class' => 'control-label col-md-3']) }}
    {{ Form::file($name,array_merge(['class' => 'form-control','multiple'], $attributes)) }}
</div>