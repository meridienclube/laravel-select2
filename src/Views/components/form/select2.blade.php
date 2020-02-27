@php
    $attributes['id'] = $attributes['id']?? mt_rand();
@endphp

{{ Form::select($name, $values, $selected, $attributes) }}

@push('scripts')

        <script>
            $(document).ready(function() {
                @isset($select2Attr['server_side'])
                $('#{{ $attributes['id']  }}').select2({
                    dropdownAutoWidth: true,
                    width: 'resolve',
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
                @else
                $('#{{ $attributes['id'] }}').select2();
                @endisset
            });
        </script>

@endpush
