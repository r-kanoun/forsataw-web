{{-- The three measurement units. Saved with the rest of Business Info by business_setup(),
     which requires all three. Switching one changes only the unit stored numbers are read in;
     nothing is converted. --}}
@php($unitGroups = [
    'distance_unit' => ['label' => 'Distance unit', 'value' => $distanceUnit ?? 'km', 'options' => ['km' => 'Kilometer', 'mi' => 'Mile']],
    'weight_unit' => ['label' => 'Weight unit', 'value' => $weightUnit ?? 'kg', 'options' => ['kg' => 'Kilogram', 'lb' => 'Pound']],
    'dimension_unit' => ['label' => 'Dimension unit', 'value' => $dimensionUnit ?? 'in', 'options' => ['cm' => 'Centimeter', 'in' => 'Inch']],
])
<div class="shadow-sm p-xxl-20 p-xl-3 p-2 bg-white mb-20" id="measurement-units">
    <div class="mb-20">
        <h4 class="mb-1">
            {{ translate('Measurement units') }}
        </h4>
    </div>
    <div class="bg-light2 rounded p-xxl-20 p-3">
        <div class="row g-3">
            @foreach ($unitGroups as $name => $group)
                @php($selected = old($name, $group['value']))
                <div class="col-sm-6 col-md-4 col-xl-4">
                    <div class="form-group mb-0">
                        <label class="form-label text-capitalize">{{ translate($group['label']) }}
                            <span class="text-danger">*</span></label>
                        <div class="resturant-type-group bg-white border">
                            @foreach ($group['options'] as $unit => $unitName)
                                <label class="form-check form--check mr-2 mr-md-4">
                                    <input class="form-check-input" type="radio" value="{{ $unit }}"
                                        name="{{ $name }}" {{ $selected == $unit ? 'checked' : '' }}>
                                    <span class="form-check-label">
                                        {{ translate($unitName) }} ({{ $unit }})
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
