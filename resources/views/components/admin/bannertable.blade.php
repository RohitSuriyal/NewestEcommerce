@props([
    'headers' => [],
    'items' => [],
    'actions' => [],
    
])


<div class="table-responsive mx-3">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
                @if(!empty($actions))
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                      <img src="{{ asset('images/' . $item->main_image) }}" alt="Main Image" width="100">
                    </td>

                    @if(!empty($actions))
                        <td>
                            @foreach($actions as $action)
                                <a href="{{ $action['link']($item) }}"
                                   class="btn btn-sm btn-{{ $action['class'] ?? 'primary' }}">
                                    {{ $action['label'] }}
                                </a>
                            @endforeach
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) + (!empty($actions) ? 1 : 0) }}" class="text-center">
                        No data available
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $items->links() }}
    </div>

</div>



