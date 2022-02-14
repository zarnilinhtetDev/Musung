<div wire:poll.1000ms>
    <select class="form-control" name="category[]" id="category_select" required>
        <option></option>
        @foreach($p_detail as $p)
        <option value="{{ $p->p_cat_id }}">{{ $p->p_cat_name }}</option>
        @endforeach
    </select>
</div>
