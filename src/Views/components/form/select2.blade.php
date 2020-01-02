{{ Form::select($name, $values, $selected, $attributes) }}

@push('scripts')
    @isset($select2Attr['server_side'])
        <script>
            $('#{{ $attributes['id'] }}').select2({
                dropdownAutoWidth : true,
                width: 'auto',
                allowClear: false,
                placeholder: "{{ $attributes['placeholder'] ?? 'Selecione' }}",
                required: "{{ $attributes['required'] ?? false }}",
                minimumInputLength: 3,
                ajax: {
                    url: "{{ route($select2Attr['server_side']['route'], ['api_token' => auth()->user()->api_token]) }}",
                    dataType: "json",
                    delay: "{{ $attributes['delay'] ?? 400 }}",
                    data: function (params) {
                        return {
                            @isset($select2Attr['getValues'])
                                @foreach($select2Attr['getValues'] as $k => $v)
                                    {!! $k . ': $("' . $v . ' option:selected").val(),' !!}
                                @endforeach
                            @endisset
                            term: params.term
                        }
                    },
                    processResults: function (data) {
                        return {
                            results: data.data
                        };
                    }
                }
            });
        </script>
    @endisset
@endpush
