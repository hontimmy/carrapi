@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div class="d-flex flex-column col-sm-12 col-md-6">
    <!-- Name Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('name', trans("lang.option_group_name"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.option_group_name_placeholder")]) !!}
        </div>
    </div>

</div>
<div class="d-flex flex-column col-sm-12 col-md-6">

    <!-- 'Boolean Allow Multiple Field' -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('allow_multiple', trans("lang.option_group_allow_multiple"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!} {!! Form::hidden('allow_multiple', 0, ['id'=>"hidden_allow_multiple"]) !!}
        <div class="col-md-9 icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('allow_multiple', 1, null) !!} <label for="allow_multiple"></label>
        </div>
    </div>

</div>
@if($customFields)
    <div class="clearfix"></div>
    <div class="col-12 custom-field-container">
        <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
        {!! $customFields !!}
    </div>
@endif
<!-- Submit Field -->
<div class="form-group col-12 d-flex flex-column flex-md-row justify-content-md-end justify-content-sm-center border-top pt-4">
    <button type="submit" class="btn bg-success text-white mx-md-3 my-lg-0 my-xl-0 my-md-0 my-2">
        <i class="fas fa-save"></i> {{trans('lang.save')}} {{trans('lang.option_group')}}</button>
    <a href="{!! route('optionGroups.index') !!}" class="btn btn-primary text-white"><i class="fas fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
