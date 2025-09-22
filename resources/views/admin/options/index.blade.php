@extends('admin.layouts.app')

@section('title', 'Options Management')
@section('page-title', 'Options Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i>
            <strong>Options Management:</strong> Configure your application settings including logos, contact information, and social media links.
        </div>
    </div>
</div>

<!-- General Settings -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="bi bi-gear me-2"></i>General Settings
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.options.update-general') }}">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="site_name" class="form-label">Site Name</label>
                        <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                               id="site_name" name="site_name" value="{{ old('site_name', $options['site_name']) }}" required>
                        @error('site_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="site_description" class="form-label">Site Description</label>
                        <input type="text" class="form-control @error('site_description') is-invalid @enderror" 
                               id="site_description" name="site_description" value="{{ old('site_description', $options['site_description']) }}" required>
                        @error('site_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Update General Settings
            </button>
        </form>
    </div>
</div>

<!-- Contact Information -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="bi bi-telephone me-2"></i>Contact Information
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.options.update-contact') }}">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="contact_email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                               id="contact_email" name="contact_email" value="{{ old('contact_email', $options['contact_email']) }}" required>
                        @error('contact_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="contact_phone" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" 
                               id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $options['contact_phone']) }}" required>
                        @error('contact_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="contact_address" class="form-label">Address</label>
                        <textarea class="form-control @error('contact_address') is-invalid @enderror" 
                                  id="contact_address" name="contact_address" rows="3" required>{{ old('contact_address', $options['contact_address']) }}</textarea>
                        @error('contact_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Update Contact Information
            </button>
        </form>
    </div>
</div>

<!-- Social Media Links -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="bi bi-share me-2"></i>Social Media Links
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.options.update-social') }}">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="social_facebook" class="form-label">Facebook URL</label>
                        <input type="url" class="form-control @error('social_facebook') is-invalid @enderror" 
                               id="social_facebook" name="social_facebook" value="{{ old('social_facebook', $options['social_facebook']) }}" 
                               placeholder="https://facebook.com/yourpage">
                        @error('social_facebook')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="social_twitter" class="form-label">Twitter URL</label>
                        <input type="url" class="form-control @error('social_twitter') is-invalid @enderror" 
                               id="social_twitter" name="social_twitter" value="{{ old('social_twitter', $options['social_twitter']) }}" 
                               placeholder="https://twitter.com/yourhandle">
                        @error('social_twitter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="social_instagram" class="form-label">Instagram URL</label>
                        <input type="url" class="form-control @error('social_instagram') is-invalid @enderror" 
                               id="social_instagram" name="social_instagram" value="{{ old('social_instagram', $options['social_instagram']) }}" 
                               placeholder="https://instagram.com/yourhandle">
                        @error('social_instagram')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="social_linkedin" class="form-label">LinkedIn URL</label>
                        <input type="url" class="form-control @error('social_linkedin') is-invalid @enderror" 
                               id="social_linkedin" name="social_linkedin" value="{{ old('social_linkedin', $options['social_linkedin']) }}" 
                               placeholder="https://linkedin.com/company/yourcompany">
                        @error('social_linkedin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info">
                <i class="bi bi-check-circle"></i> Update Social Media Links
            </button>
        </form>
    </div>
</div>

<!-- Logo & Favicon Management -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="bi bi-image me-2"></i>Logo & Favicon Management
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.options.update-media') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        @if($options['logo'])
                            <div class="mb-2">
                                <img src="{{ Storage::url($options['logo']) }}" alt="Current Logo" class="img-thumbnail" style="max-height: 100px;">
                                <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeFile('logo')">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                               id="logo" name="logo" accept="image/*">
                        <small class="form-text text-muted">Recommended size: 200x60px. Max file size: 2MB.</small>
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="favicon" class="form-label">Favicon</label>
                        @if($options['favicon'])
                            <div class="mb-2">
                                <img src="{{ Storage::url($options['favicon']) }}" alt="Current Favicon" class="img-thumbnail" style="max-height: 32px;">
                                <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeFile('favicon')">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('favicon') is-invalid @enderror" 
                               id="favicon" name="favicon" accept=".ico,.png">
                        <small class="form-text text-muted">Recommended size: 32x32px or 16x16px. Max file size: 512KB.</small>
                        @error('favicon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-warning">
                <i class="bi bi-upload"></i> Update Logo & Favicon
            </button>
        </form>
    </div>
</div>

<!-- Banner Management Link -->
<div class="card shadow mb-4 border-primary">
    <div class="card-header py-3 bg-primary text-white">
        <h6 class="m-0 font-weight-bold">
            <i class="bi bi-images me-2"></i>Banner Management
        </h6>
    </div>
    <div class="card-body text-center">
        <i class="bi bi-images text-primary" style="font-size: 3rem;"></i>
        <h5 class="mt-3">Manage Homepage Banners</h5>
        <p class="text-muted">Create and manage multiple homepage banners/sliders with drag-and-drop ordering.</p>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-right-circle"></i> Go to Banner Management
        </a>
    </div>
</div>

<!-- Danger Zone -->
<div class="card shadow mb-4 border-danger">
    <div class="card-header py-3 bg-danger text-white">
        <h6 class="m-0 font-weight-bold">
            <i class="bi bi-exclamation-triangle me-2"></i>Danger Zone
        </h6>
    </div>
    <div class="card-body">
        <p class="text-danger"><strong>Warning:</strong> This action will reset all options to their default values. This cannot be undone.</p>
        <form method="POST" action="{{ route('admin.options.reset') }}" onsubmit="return confirm('Are you sure you want to reset all options to default values? This action cannot be undone.');">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-arrow-clockwise"></i> Reset All Options to Defaults
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function removeFile(type) {
    if (confirm('Are you sure you want to remove this file?')) {
        fetch('{{ route("admin.options.remove-file") }}', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ type: type })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while removing the file.');
        });
    }
}
</script>
@endsection