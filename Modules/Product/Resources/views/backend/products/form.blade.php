<div class="row">
    @php
        $fields = [
            'item_code' => ['type' => 'text', 'required' => true],
            'name' => ['type' => 'text', 'required' => true],
            'slug' => ['type' => 'text', 'required' => false],
            'price' => ['type' => 'number', 'required' => true, 'step' => '0.01'],
            'quantity' => ['type' => 'number', 'required' => true],
            'weight' => ['type' => 'number', 'required' => false, 'step' => '0.01'],
            'in_stock' => ['type' => 'number', 'required' => true]
        ];
    @endphp

    <div class="row">
        @php
            $categories = \Modules\Category\Models\Category::whereNull('parent_id')->pluck('name', 'id'); // Top-level categories
            $subCategories = isset($product->category_id) 
                ? \Modules\Category\Models\Category::where('parent_id', $product->category_id)->pluck('name', 'id') 
                : []; // Subcategories based on selected category
            $units = \Modules\Unit\Models\Unit::pluck('name', 'id'); // Units
        @endphp
    
        {{-- Category --}}
        <div class="col-12 col-sm-4 mb-3">
            <div class="form-group">
                {{ html()->label('Category', 'category_id')->class('form-label') }}
                {!! field_required('required') !!}
                {{ html()->select('category_id', $categories, old('category_id', $product->category_id ?? ''))->class('form-control select2')->attributes(['required', 'id' => 'category_id']) }}
            </div>
        </div>
    
        {{-- Subcategory --}}
        <div class="col-12 col-sm-4 mb-3">
            <div class="form-group">
                {{ html()->label('Sub Category', 'sub_category_id')->class('form-label') }}
                {!! field_required('required') !!}
                {{ html()->select('sub_category_id', $subCategories, old('sub_category_id', $product->sub_category_id ?? ''))->class('form-control select2')->attributes(['required', 'id' => 'sub_category_id']) }}
            </div>
        </div>
    
        {{-- Unit --}}
        <div class="col-12 col-sm-4 mb-3">
            <div class="form-group">
                {{ html()->label('Unit', 'unit_id')->class('form-label') }}
                {!! field_required('required') !!}
                {{ html()->select('unit_id', $units, old('unit_id', $product->unit_id ?? ''))->class('form-control select2')->attributes(['required', 'id' => 'unit_id']) }}
            </div>
        </div>
    </div>
    

    @foreach ($fields as $field_name => $field)
        <div class="col-12 col-sm-4 mb-3">
            <div class="form-group">
                {{ html()->label(label_case($field_name), $field_name)->class('form-label') }}
                {!! field_required($field['required'] ? 'required' : '') !!}
                
               
                    {{ html()->{$field['type']}($field_name, old($field_name, $product->$field_name ?? ''))->placeholder(label_case($field_name))->class('form-control')->attributes([$field['required'] ? 'required' : '', 'step' => $field['step'] ?? null]) }}
            </div>
        </div>
    @endforeach

 
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            {{ html()->label('Product Image', 'image')->class('form-label') }}
            {{ html()->file('image')->class('form-control') }}
            @if(isset($product) && $product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="mt-2 img-thumbnail" width="100">
            @endif
        </div>
    </div>


    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            {{ html()->label('Status', 'status')->class('form-label') }}
            {!! field_required('required') !!}
            {{ html()->select('status', ['1' => 'Published', '0' => 'Unpublished', '2' => 'Draft'], old('status', $product->status ?? ''))->class('form-control select2')->attributes(["required"]) }}
        </div>
    </div>

   
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            {{ html()->label('Product Type', 'type')->class('form-label') }}
            {!! field_required('required') !!}
            {{ html()->select('type', ['single' => 'Single', 'configurable' => 'Configurable'], old('type', $product->type ?? ''))->class('form-control')->attributes(["required", 'id' => 'product_type']) }}
        </div>
    </div>

    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            {{ html()->label(label_case('description'), 'description')->class('form-label') }}
            {!! field_required($field['required'] ? 'required' : '') !!}
            
           
                {{ html()->textarea('description', old('description', $product->description ?? ''))->placeholder(label_case('description'))->class('form-control')->attributes([$field['required'] ? 'required' : '']) }}
           
        </div>
    </div>

</div>


<h5 class="mt-4">Product Configurations</h5>
<div class="row">
    @php
        $configFields = [
            'is_subscribable' => 'Is Subscribable',
            'is_container' => 'Is Container',
            'is_feature' => 'Is Featured',
            'is_taxable' => 'Is Taxable'
        ];
    @endphp

    @foreach ($configFields as $field_name => $label)
        <div class="col-12 col-sm-4 mb-3">
            <div class="form-group">
                {{ html()->label($label, "configurations[$field_name]")->class('form-label') }}
                {{ html()->checkbox("configurations[$field_name]", old("configurations.$field_name", $product->configurations->$field_name ?? false))->class('form-check-input') }}
            </div>
        </div>
    @endforeach
</div>

{{-- Product Children Fields (Variants) --}}
            <h5 class="mt-4">Product Variants</h5>
            <div id="child-products">
                @if(isset($product) && $product->type == 'configurable')
                    @foreach($product->children as $index => $child)
                        <div class="row mb-3 child-product" id="child-product-{{ $index }}">
                            <div class="col-12 col-sm-3">
                                <input type="hidden" name="children[{{ $index }}][id]" value="{{ $child->id }}">
                                <label class="form-label">Variant Name</label>
                                <input type="text" name="children[{{ $index }}][name]" class="form-control" value="{{ $child->name }}">
                            </div>
                            <div class="col-12 col-sm-3">
                                <label class="form-label">Price</label>
                                <input type="number" name="children[{{ $index }}][price]" class="form-control" value="{{ $child->price }}" step="0.01">
                            </div>
                            <div class="col-12 col-sm-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="children[{{ $index }}][quantity]" class="form-control" value="{{ $child->quantity }}">
                            </div>
                            <div class="col-12 col-sm-3">
                                <label class="form-label"></label>
                                <button type="button" class="btn btn-danger remove-child-product form-control" data-id="{{ $index }}">Remove Variant</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" class="btn btn-success add-child-product" style="display: none;">Add Variant</button>


<x-library.select2 />


<script>
    
        const productTypeSelect = document.getElementById('product_type');
        const childProductsContainer = document.getElementById('child-products');
        const addChildButton = document.querySelector('.add-child-product');
        console.log('ddd');
        // Show the "Add Variant" button only when product type is configurable
        productTypeSelect.addEventListener('change', function() {
            console.log('ddd');
            if (this.value === 'configurable') {
                addChildButton.style.display = 'block';
            } else {
                addChildButton.style.display = 'none';
                // Remove all variants if product type is not configurable
                childProductsContainer.innerHTML = '';
            }
        });

        // Add Variant functionality
        addChildButton.addEventListener('click', function() {
            const index = childProductsContainer.children.length;
            const childHTML = `
                <div class="row mb-3 child-product" id="child-product-${index}">
                    <div class="col-12 col-sm-3">
                        <label class="form-label">Variant Name</label>
                        <input type="text" name="children[${index}][name]" class="form-control">
                    </div>
                    <div class="col-12 col-sm-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="children[${index}][price]" class="form-control" step="0.01">
                    </div>
                    <div class="col-12 col-sm-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="children[${index}][quantity]" class="form-control">
                    </div>
                    <div class="col-12 col-sm-3">
                         <label class="form-label"></label>
                        <button type="button" class="btn btn-danger remove-child-product form-control" data-id="${index}">Remove Variant</button>
                    </div>
                </div>
            `;
            childProductsContainer.insertAdjacentHTML('beforeend', childHTML);
        });

        // Remove Variant functionality (use event delegation)
        childProductsContainer.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-child-product')) {
                const id = e.target.dataset.id;
                document.getElementById('child-product-' + id).remove();
            }
        });
    
</script>
