<div class="col-md-12 pt-1 pb-2">
    <div class="form-group">
        <label>{{__("Title")}}</label>
        <input type="text" value="{{$translation->title}}" placeholder="{{__("Job Title")}}" name="title" class="form-control width-half required" required>
    </div>
</div>
<div class="col-md-12 pt-1 pb-2">
    <div class="form-group">
        <label class="control-label">{{__("Content")}}</label>
        <div class="" style="border-radius: 10px">
            <textarea name="content" class="d-none has-ckeditor required" cols="30" rows="10" required>{{$translation->content}}</textarea>
        </div>
    </div>
</div>
<style>
.tox.tox-tinymce{
    border-radius: 10px;
}    
</style>