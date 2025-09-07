@extends('layouts.admin')

@section('title', $title)

@section('content')
<!-- ...styles and layout unchanged... -->

<div id="app">
    <style>
    /* Override default Choices.js styles */
    :root {
    --primary: #2563eb;
    --primary-dark: #1e4ed8;
    --border: #d1d5db;
    --bg: #f8fafc;
    --muted: #6b7280;
    --danger: #ef4444;
  }
  body {
    /* margin: 0;
    font-family: system-ui, sans-serif;
    background: var(--bg);
    color: #111827;
    padding: 32px 16px;
    display: grid;
    gap: 32px;
    place-items: start center; */
  }
  .uploader {
    width: 100%;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    padding: 20px;
  }
  h2 { margin: 0 0 8px; font-size: 1.1rem; }
  .hint { margin: 0 0 12px; font-size: 0.9rem; color: var(--muted); }

  .dropzone {
    border: 2px dashed var(--border);
    border-radius: 12px;
    background: #f9fafb;
    display: grid;
    place-items: center;
    gap: 8px;
    padding: 28px;
    text-align: center;
    cursor: pointer;
    transition: background .2s, border-color .2s, box-shadow .2s;
  }
  .dropzone:hover,
  .dropzone.drag { background: #f3f4f6; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37,99,235,.15); }
  .dropzone .icon { width: 36px; height: 36px; color: var(--muted); }
  .grid-1 {
    margin-top: 14px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 12px;
  }
  .thumb {
    position: relative;
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    height: 100px;
    display: grid;
    place-items: center;
  }
  .thumb img { width: 100%; height: 100%; object-fit: cover; }
  .thumb.empty { color: var(--muted); background: #f3f4f6; font-size: 0.9rem; }
  .remove {
    position: absolute;
    top: 6px;
    right: 6px;
    border: none;
    background: rgba(17,24,39,.7);
    color: white;
    width: 24px; height: 24px;
    border-radius: 50%;
    cursor: pointer;
  }
  .remove:hover { background: rgba(17,24,39,.9); }
  .error { margin-top: 8px; color: var(--danger); font-size: .9rem; min-height: 1.2em; }
  .actions { margin-top: 14px; }
  .btn {
    background: var(--primary);
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    cursor: pointer;
  }
  .btn:disabled { opacity: .5; cursor: not-allowed; }
</style>
    @include('admin.partials.top_nav')
    @include('admin.partials.nav')

    <!-- ...title bars unchanged... -->
    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>{{$title}}</li>
            </ul>
        </div>
    </section>

    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
            {{$title}}
            </h1>
            <a href="{{ url()->previous() }}" data-target="add-facility-modal" class="button blue --jb-modal">Go Back</a>
        </div>
    </section>

    <section class="section main-section">
        @if(session('success'))
            <!-- ...success notification unchanged... -->
        @endif
        <div class="card mb-6">
            <header class="card-header">
                <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-ballot"></i></span>
                Upload Home Images
                </p>
            </header>
            <div class="card-content">
                <!-- Featured Image AJAX Form -->
                {{-- <form id="featuredImageForm" enctype="multipart/form-data">
                    <div class="uploader mb-6">
                        <h2>Featured Image</h2>
                        <div class="dropzone" onclick="document.getElementById('featuredImageInput').click();">
                            <small>Drag & drop or click</small>
                            <input type="file" accept="image/*" id="featuredImageInput" name="image" hidden>
                        </div>
                        <div class="grid-1" id="featuredImagePreview">
                            <!-- Preview will be inserted here -->
                        </div>
                        <div class="error" id="featuredImageError"></div>
                        <input type="hidden" name="home_id" value="{{ $homeId }}">
                        <button type="submit" class="btn mt-2">Upload Featured Image</button>
                    </div>
                </form> --}}

                <!-- Gallery Images AJAX Form -->
                <form id="galleryImagesForm" enctype="multipart/form-data">
                    <div class="uploader">
                        <h2>Gallery Images</h2>
                        <p class="hint">Select one or more images (Max: 6)</p>
                        <div id="drop2" class="dropzone" onclick="document.getElementById('galleryImagesInput').click();">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            </svg>
                            <small>click to Upload Images</small>
                            <input type="file" accept="image/*" multiple id="galleryImagesInput" name="images[]" hidden>
                        </div>
                        <div class="grid-1" id="galleryImagesPreview">
                            <!-- Previews will be inserted here -->
                        </div>
                        <div class="error" id="galleryImagesError"></div>
                        <input type="hidden" name="home_id" value="">
                        <button type="submit" class="btn mt-2">Upload Slider Images</button>
                    </div>
                </form>
            </div>
        </div>
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
                @if ($images)
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>SL no.</th>
                                <th>Image</th>
                                <th>Is Featured</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            //    print_r($images->toArray());die;
                            @endphp
                            @foreach($images->toArray() as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td> 
                                    <div class="thumb" style="width: 120px; height: 80px;">
                                        <img src="{{ $row['url'] }}" class="preview">
                                    </div>
                                </td>
                                <td> 
                                    <div class="field">
                                    {{-- <label class="label">Select</label> --}}
                                        <div class="field-body">
                                            <div class="field">
                                            <label class="switch">
                                                <input type="checkbox" name="featured" value="1"
                                                {{ $row['is_featured'] ? 'checked' : '' }}>
                                                <span class="check"></span>
                                                <span class="control-label">Featured</span>
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="actions-cell">
                                    <div class="buttons right nowrap">
                                        
                                        <button class="delete-btn button small red" data-id="{{$row['id']}}" onclick="deleteGalleryImage('{{$row['id']}}', this)" type="button">
                                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="table-pagination">
                        <div class="flex items-center justify-between">
                            {{-- <div class="buttons">
                            <button type="button" class="button active">1</button>
                            <button type="button" class="button">2</button>
                            <button type="button" class="button">3</button>
                            </div>
                            <small>Page 1 of 3</small> --}}
                        </div>
                    </div>
                </div>
                @else
                <div class="card empty">
                    <div class="card-content">
                        <div>
                            <span class="icon large"><i class="mdi mdi-emoticon-sad mdi-48px"></i></span>
                        </div>
                        <p>Nothing's here…</p>
                    </div>
                </div>
                @endif
            </div>
    </section>
</div>

{{-- <div id="ajaxLoader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999;">
    <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div> --}}
<div id="ajaxLoader"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Featured Image Preview
    // document.getElementById('featuredImageInput').addEventListener('change', function(e) {
    //     let previewDiv = document.getElementById('featuredImagePreview');
    //     previewDiv.innerHTML = '';
    //     if (this.files && this.files[0]) {
    //         let reader = new FileReader();
    //         reader.onload = function(ev) {
    //             previewDiv.innerHTML = `<div class="thumb"><img src="${ev.target.result}"></div>`;
    //         };
    //         reader.readAsDataURL(this.files[0]);
    //     }
    // });

    // Gallery Images Preview
    document.getElementById('galleryImagesInput').addEventListener('change', function(e) {
        let previewDiv = document.getElementById('galleryImagesPreview');
        previewDiv.innerHTML = '';
        let files = this.files;
        if (files.length > 6) {
            previewDiv.innerHTML = '<div class="error">You can upload a maximum of 6 images.</div>';
            return;
        }
        Array.from(files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function(ev) {
                let thumb = document.createElement('div');
                thumb.className = 'thumb';
                thumb.innerHTML = `<img src="${ev.target.result}" class="preview">`;
                previewDiv.appendChild(thumb);
            };
            reader.readAsDataURL(file);
        });
    });

    

    // Gallery Images AJAX Submit
    document.getElementById('galleryImagesForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let form = e.target;
        let input = form.querySelector('input[type="file"]');
        let errorDiv = document.getElementById('galleryImagesError');
        let previewDiv = document.getElementById('galleryImagesPreview');
        errorDiv.textContent = '';
        // Do not clear previewDiv.innerHTML here, so previews stay visible
        if (!input.files.length) {
            errorDiv.textContent = 'Please select images.';
            return;
        }
        let files = input.files;
        if (files.length > 6) {
            errorDiv.textContent = 'You can upload a maximum of 6 images.';
            return;
        }
        let uploadedCount = 0;
        Array.from(files).forEach(file => {
            let formData = new FormData();
            formData.append('image', file);
            formData.append('home_id', form.querySelector('input[name="home_id"]').value);
            $('#ajaxLoader').fadeIn();
            fetch('{{ route("admin.shortStoryImageUpload") }}', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                $('#ajaxLoader').fadeOut();
                if (data.success) {
                    let thumb = document.createElement('div');
                    // thumb.className = 'thumb';
                    // thumb.innerHTML = `<img src="${data.url}" class="preview"><button type="button" class="remove" onclick="deleteGalleryImage(${data.id}, this)">✕</button>`;
                    // previewDiv.appendChild(thumb);
                    uploadedCount++;
                    if (uploadedCount === files.length) {
                        alert('Images uploaded successfully');
                        window.location.reload();
                    }
                } else {
                    errorDiv.textContent = data.errors?.image?.[0] || 'Upload failed';
                }
                
            });
        });
    });
});

// Delete Featured Image AJAX
// function deleteFeaturedImage(id) {
//     if (!confirm('Delete this image?')) return;
//     $('#ajaxLoader').fadeIn();
//     fetch(`{{ url('/admin/homes/delete-image') }}/${id}`, {
//         method: 'DELETE',
//         headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
//     })
//     .then(res => res.json())
//     .then(data => {
//         $('#ajaxLoader').fadeOut();
//         if (data.success) {
//             document.getElementById('featuredImagePreview').innerHTML = '<div class="thumb empty">Empty</div>';
//             alert('Image deleted successfully');
//         }
//     });
// }

// Delete Gallery Image AJAX
function deleteGalleryImage(id, btn) {
    if (!confirm('Delete this image?')) return;
    $('#ajaxLoader').fadeIn();
    fetch(`{{ url('/admin/homes/delete-image') }}/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
    })
    .then(res => res.json())
    .then(data => {
        $('#ajaxLoader').fadeOut();
        if (data.success) {
            btn.parentElement.remove();
            alert('Image deleted successfully');
        }
        window.location.reload();
    });
}
document.querySelectorAll('input[name="featured"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        let row = this.closest('tr');
        let imageId = row.querySelector('.delete-btn').getAttribute('data-id');
        let isFeatured = this.checked ? 1 : 0;
        //$('#ajaxLoader').fadeIn();
        fetch(`{{ url('/admin/homes/set-featured') }}/${imageId}`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ featured: isFeatured })
        })
        .then(res => res.json())
        .then(data => {
            //$('#ajaxLoader').fadeOut();
            if (data.success) {
                alert('Featured status updated');
                window.location.reload();
            } else {
                alert('Failed to update featured status');
                window.location.reload();
            }
        });
    });
});
</script>
@endsection
