@extends('layouts.admin')

@section('title', $title ?? 'Admin Panel')

<style>
    @import url('https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css');
    /* Custom styles for Choices.js */
</style>

@section('content')
    <div id="app">
        @include('admin.partials.top_nav')
        @include('admin.partials.nav')

        <section class="is-title-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <ul>
                    <li>Admin</li>
                    <li>{{$title}}</li>
                </ul>
            </div>
        </section>

        <!-- Hero Bar -->
        <section class="is-hero-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <h1 class="title">
                {{$title}}
                </h1>
                <button type="button" data-target="add-features-modal" class="button blue --jb-modal">Add Tags</button>
            </div>
        </section>

        <div id="add-features-modal" class="modal">
        <div class="modal-background --jb-modal-close"></div>
        <div class="modal-card">
            <form method="POST" action="{{ route('admin.tags.add') }}">
                @csrf
                <header class="modal-card-head">
                    <p class="modal-card-title">Add New Tags</p>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <label class="label">Tag Name</label>
                        <div class="field-body">
                            <div class="field">
                                <div class="control icons-left">
                                    <input class="input" type="text" placeholder="Name" name="name">
                                    <span class="icon left"><i class="mdi mdi-pin"></i></span>
                                    @error('name')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label">Tag Type</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="tagsType" multiple name="tagsType[]">
                                            @foreach($categoryTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('tagsType')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button type="submit" class="button green --jb-modal-close">Confirm</button>
                    <button type="button" class="button --jb-modal-close">Cancel</button>
                </footer>
            </form>
        </div>
    </div>
    <button id="modalShowBtn" class="--jb-modal" data-target=""></button>

    {{-- Edit Feature Modal --}}
    <div id="edit-tag-modal" class="modal">
        <div class="modal-background --jb-modal-close"></div>
        <div class="modal-card">
            <form id="edit-tag" method="POST" action="">
                @csrf
                <input type="hidden" name="id" value="">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edit Tags</p>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="field-body">
                            <div class="field">
                                <div class="control icons-left">
                                    <input class="input" type="text" placeholder="Name" name="name">
                                    <span class="icon left"><i class="mdi mdi-pin"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="grid gap-6 grid-cols-1">
                            <div class="field">
                                <label class="label">Tag Type</label>
                                <div class="control icons-left icons-right">
                                    <div class="select">
                                        <select id="editTagsType" multiple name="tagsType[]">
                                        </select>
                                        @error('tagsType')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button type="submit" class="button green --jb-modal-close">Confirm</button>
                    <button type="button" class="button --jb-modal-close">Cancel</button>
                </footer>
            </form>
        </div>
    </div>

    <div id="delete-tag-modal" class="modal">
        <div class="modal-background --jb-modal-close"></div>
        <div class="modal-card">
            <form id="deleteTag" method="POST" action="">
                @csrf
                @method('DELETE')
                <header class="modal-card-head">
                    <p class="modal-card-title">Delete {{$title}}</p>
                </header>
                <section class="modal-card-body">
                    <p>Are you sure you want to delete <span class="tagName"></span>?</p>
                </section>
                <footer class="modal-card-foot">
                    <button type="submit" class="button green --jb-modal-close">Confirm</button>
                    <button type="button" class="button --jb-modal-close">Cancel</button>
                </footer>
            </form>
        </div>
    </div>


        <section class="section main-section">
             @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="notification red">
                        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                            
                            <div>
                                <span class="icon"><i class="mdi mdi-buffer"></i></span>
                                <span>{{ $error }}</span>
                            </div>
                            
                            <button type="button" class="button small textual --jb-notification-dismiss">Dismiss</button>
                        </div>
                    </div>
                @endforeach
            @endif
            @if(session('success'))
                <div class="notification green">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                        <div>
                            <span class="icon"><i class="mdi mdi-buffer"></i></span>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" class="button small textual --jb-notification-dismiss">Dismiss</button>
                    </div>
                </div>
            @endif
            <div class="card has-table">
            <header class="card-header">
                <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                List
                </p>
                <a href="#" class="card-header-icon">
                <span class="icon"><i class="mdi mdi-reload"></i></span>
                </a>
            </header>
            <div class="card-content">
                <table>
                <thead>
                <tr>

                    <th>#</th>
                    <th>Tags Name</th>
                    <th>Tags Type</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $key => $item)
                        
                    
                    <tr>
                        <td data-label="Name">{{$key+1}}</td>
                        <td data-label="Name">{{$item->name}}</td>
                        <td data-label="Company">{{$item->types->pluck('name')->join(', ')}}</td>

                        <td class="actions-cell">
                        <div class="buttons right nowrap">
                            {{-- <button class="button small blue --jb-modal"  data-target="sample-modal-2" type="button">
                                <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                            </button> --}}
                            <button type="button" data-target="edit-tag-modal" data-id="{{$item->id}}" class="button small blue edit-btn"><span class="icon"><i class="mdi mdi-square-edit-outline"></i></span></button>
                            <button class="button small red delete-btn" data-target="sample-modal"  data-id="{{$item->id}}" data-name="{{$item->name}}" type="button">
                                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                            </button>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                
                </tbody>
                </table>
                <div class="table-pagination">
                {{-- <div class="flex items-center justify-between">
                    <div class="buttons">
                    <button type="button" class="button active">1</button>
                    <button type="button" class="button">2</button>
                    <button type="button" class="button">3</button>
                    </div>
                    <small>Page 1 of 3</small>
                </div> --}}
                </div>
            </div>
            </div>
        </section>
    </div>

    <div id="ajaxLoader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999;">
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Choices('#tagsType', { removeItemButton: true, searchEnabled: true });

            const choices = new Choices('#editTagsType', {
                    removeItemButton: true,
                    searchEnabled: true,
                });

            $('.edit-btn').on('click', function () {
                $('#modalShowBtn').attr('data-target', 'edit-tag-modal');
                $('#ajaxLoader').fadeIn();
                const tagId = $(this).data('id');
                let routeTemplateEdit = "{{ route('admin.tags.edit', ':id') }}";
                let routeTemplateUpdate = "{{ route('admin.tags.add', ':id') }}";
                $('#edit-tag-modal input[name="id"]').val('');
                $('#edit-tag-modal input[name="name"]').val('');
                choices.clearStore();
                choices.clearChoices();
                $.get(routeTemplateEdit.replace(':id', tagId), function (data) {
                    $('#edit-tag-modal input[name="id"]').val(data[0].id);
                    $('#edit-tag-modal input[name="name"]').val(data[0].name);
                    $('#edit-tag').attr('action', routeTemplateUpdate.replace(':id', tagId));
                    fetchType(data[0].types);
                    $('#ajaxLoader').fadeOut();
                    setTimeout(() => {
                        $('#modalShowBtn').click();
                    }, 500);
                }).fail(function () {
                    $('#ajaxLoader').fadeOut();
                    alert('Error fetching Category data.');
                });
            });
            let allTypes = @json($categoryTypes);
            function fetchType(types) {
                const selectedIds = types.map(type => type.id);
                // Clear existing options and set new ones
                choices.clearChoices();
                choices.setChoices(
                    allTypes.map(type => ({
                        value: type.id,
                        label: type.name,
                        selected: selectedIds.includes(type.id),
                        disabled: false,
                    })),
                    'value',
                    'label',
                    false
                );
            }

            $('.delete-btn').on('click', function () {
                $('#modalShowBtn').attr('data-target', 'delete-tag-modal');
                const tagId = $(this).data('id');
                $('#delete-tag-modal input[name="id"]').val(tagId);
                let routeTemplateDelete = "{{ route('admin.tags.destroy', ':id') }}";
                $('#deleteTag').attr('action', routeTemplateDelete.replace(':id', tagId));
                const tagName = $(this).data('name');
                    $('.tagName').text(tagName ? tagName : 'this tag');
                $('#modalShowBtn').click();

            });
        });

    </script>
@endsection