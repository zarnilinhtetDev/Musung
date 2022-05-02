<div wire:poll.1000ms>
    <select class="form-control" name="category[]" id="category_select" required>
        <option></option>
        @foreach($buyer_detail as $buyer)
        <option value="{{ $buyer->buyer_id }}">{{ $buyer->buyer_name }}</option>
        @endforeach
    </select>

    @push('select-box-scripts')
    <script>
        var i = 1;
        $("#add_product_detail").click(function () {
                            i++;
                            $("#dynamic_field").append(
                                '<tr class="setting-tr" id="row' +
                                    i +
                                    '"><td><label>Buyer</label><select class="form-control" name="category[]" id="category_select" required><option></option>@foreach ($buyer_detail as $buyer) <option value="{{ $buyer->buyer_id }}">{{ $buyer->buyer_name }}</option> @endforeach</select></td> <td><label>Style No.#</label><input type="text" class="form-control" id="style_name" name="style_name[]"placeholder="#0000" required /></td><td><label>Item Name</label><select class="form-control" name="p_name[]" id="p_name" required><option></option>@foreach($item_detail as $item) <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>@endforeach</select></td><td><label>Target</label><input type="number" class="form-control" name="category_target[]" id="setting_target" placeholder="Target" required /></td><td><br/><button type="button" name="remove" id="' +
                                    i +
                                    '" class="btn btn-danger btn_remove">X</button></td></tr>'
                            );
                        });
    </script>
    @endpush
</div>
