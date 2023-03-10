<div class="mb-3">
    <label for="description" class="form-label">{{$lang['attributes']['description']}}</label>
    <textarea class="form-control" id="description" rows="3" name="description">{{$post->description ?? null}}</textarea>
</div>
