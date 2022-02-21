<div wire:poll.1000ms>
    <select class="form-control" name="category[]" id="category_select" required>
        <option></option>
        @foreach($p_detail as $p)
        <option value="{{ $p->p_cat_id }}">{{ $p->p_cat_name }}</option>
        @endforeach
    </select>

    @push('select-box-scripts-2')
    <script>
        var i = 1;
        $("#add_product_detail_2").click(function () {
                            i++;
                            $("#dynamic_field_2").append(
                                '<tr class="setting-tr-2" id="row' +
                                    i +
                                    '"><td><label>Category</label><select class="form-control" name="category[]" id="category_select" required><option></option>@foreach ($p_detail as $p) <option value="{{ $p->p_cat_id }}">{{ $p->p_cat_name }}</option> @endforeach</select></td><td><label>Product Name</label><input type="text" class="form-control" id="p_name" name="p_name[]" placeholder="Musung Shirt" required /></td><td><label>Target</label><input type="number" class="form-control" name="category_target[]" id="setting_target" placeholder="Target" required /></td><td><br/><button type="button" name="remove" id="' +
                                    i +
                                    '" class="btn btn-danger btn_remove">X</button></td></tr>'
                            );
                        });
    </script>
    @endpush
</div>
