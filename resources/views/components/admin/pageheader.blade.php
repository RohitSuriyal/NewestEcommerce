@props([
    'title' => 'Default Title', 
    'buttontext' => '',  
    'buttonlink' => '#'
])

@push("styles")
<style>
    .main-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2% 3%;
        border-bottom: 1px solid #ddd;
        box-shadow: 1px 1px 2px 0.5px rgba(0,0,0,0.5);

        
    }

    .main-header h1 {
        margin: 0;
        font-size: 1.5rem;
    }

    .main-header a.button {
        padding: 0.5rem 1rem;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.2s ease;
    }

    .main-header a.button:hover {
        background-color: #0056b3;
    }
</style>
@endpush

<div class="main-header mx-3  my-2">
    <h1>{{ $title }}</h1>

    @if(!empty($buttontext))
        <a href="{{ $buttonlink }}" class="button">{{ $buttontext }}</a>
    @endif
</div>
