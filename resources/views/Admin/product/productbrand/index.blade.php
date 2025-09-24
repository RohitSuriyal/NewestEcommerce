@extends('layouts.app')

@section('content')
    <x-admin.pageheader title="Brands" subtitle="Manage all registered brands" buttontext="Add ProductBrand"
        buttonlink="{{ route('admin.productbrand.create') }}" />

    <x-admin.input name="searchbar" class="brandsearch w-25 ms-3 my-3" type="text" placeholder="Enter the brand name" />


    @if (session('success'))
        <div class="alert alert-success mx-3" role="alert">
            {{session('success')}}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-success mx-3" role="alert">
            {{session('success')}}
        </div>
    @endif
    @php
        $headers = ['ID', 'Name', 'Created At'];
        $actions = [
            [
                'label' => 'Edit',
                'class' => 'warning',
                'link' => fn($brandnew) => route('admin.productbrand.edit', $brandnew->id)
            ],
            [
                'label' => 'Delete',
                'class' => 'danger delete',
                'link' => fn($brand) => route('admin.productbrand.destroy', $brand->id)
            ]
        ];
    @endphp

    <div id="tablewrapper">
        <x-admin.table :headers="$headers" :items="$Brands" :actions="$actions" />
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const searchInput = document.querySelector(".brandsearch");
            const tableWrapper = document.querySelector("#tablewrapper");

            // --- Debounced AJAX search ---
            let searchTimeout;
            searchInput.addEventListener("input", () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => performSearch(searchInput.value), 300);
            });

            // --- Pagination (event delegation) ---
            document.addEventListener("click", e => {
                const link = e.target.closest(".pagination a");
                if (!link) return;
                e.preventDefault();
                const url = new URL(link.href);
                const page = url.searchParams.get("page") || 1;
                performSearch(searchInput.value, page);
            });

            // --- Perform AJAX search ---
            async function performSearch(query = '', page = 1) {
                try {
                    const res = await fetch(`{{ route('admin.searchbrand') }}?page=${page}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken
                        },
                        body: JSON.stringify({ searchValue: query })
                    });
                    const data = await res.json();
                    if (data.html) tableWrapper.innerHTML = data.html;
                } catch (err) {
                    console.error("Search error:", err);
                }
            }

            // --- Event delegation for Delete buttons ---
            tableWrapper.addEventListener("click", async e => {
                const btn = e.target.closest(".delete");
                if (!btn) return;
                e.preventDefault();

                const confirmed = await Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to delete this?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                });

                if (!confirmed.isConfirmed) return;

                try {
                    const res = await fetch(btn.href, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                    });
                    if (!res.ok) throw new Error('Delete failed');
                    btn.closest("tr").remove();
                    Swal.fire('Deleted!', 'The brand has been deleted.', 'success');
                    location.reload();
                } catch (err) {
                    console.error(err);
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                }
            });
        });
    </script>

@endpush