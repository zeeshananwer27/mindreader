<ul class="custom-info-list list-group-flush">
    @foreach ($lists as $k => $list)
        @if (@$db_list)
            <li class="d-flex justify-content-between align-items-center">
                <span class="label info-ad-col">{{ translate(ucfirst($k)) }}</span>
                @if ($list->type == 'file')
                    @php
                        $file = $report->file->where('type', $k)->first();
                    @endphp
                    <div class="custom-profile">
                        <div class="image-v-preview" title="{{ k2t($k) }}">
                            <img src="{{ imageURL($file, @$file_path, true) }}" alt="{{ ucfirst($k).'.jpg' }}">
                        </div>
                    </div>
                @else
                    <span class="value">{{ $list->field_name }}</span>
                @endif
            </li>
        @else
            <li class="d-flex justify-content-between align-items-center">
                <span class="label info-ad-col">{{ Arr::get($list, 'title') }}</span>
                @php 
                    $value = Arr::get($list, 'value');
                @endphp
                @if (Arr::has($list, 'href') && Arr::get($list, 'href'))
                    <a href="{{ Arr::get($list, 'href') }}" class="value">
                        {{ $value }}
                    </a>
                @else
                    @if (Arr::has($list, 'is_html'))
                        <span class="value">{!! $value !!}</span>
                    @else
                        <span class="value">{{ $value }}</span>
                    @endif
                @endif
            </li>
        @endif
    @endforeach
</ul>
