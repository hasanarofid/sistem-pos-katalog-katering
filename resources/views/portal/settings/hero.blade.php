@extends('layouts.portal')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-image me-2"></i> Pengaturan Hero Banner</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('portal.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group mb-4">
                                <label class="fw-bold">Background Header (Hero Image)</label>
                                <input type="file" name="hero_image" class="form-control mb-2" onchange="previewImage(this)">
                                <small class="text-muted text-italic">Rekomendasi ukuran: 1920x1080 px atau foto landscape berkualitas tinggi.</small>
                                
                                <div id="preview-container" class="mt-4 {{ ($setting->hero_image ?? false) ? '' : 'd-none' }}">
                                    <p class="small fw-bold">Pratinjau Banner:</p>
                                    <div class="rounded border p-2 bg-light text-center">
                                        <img id="hero-preview" src="{{ ($setting->hero_image ?? false) ? asset('storage/'.$setting->hero_image) : '' }}" class="img-fluid rounded shadow-sm" style="max-height: 300px; width: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="bg-light p-4 rounded border mb-4">
                                <h6>Tips Hero Banner:</h6>
                                <ul class="small text-muted ps-3">
                                    <li>Gunakan foto hasil masakan asli.</li>
                                    <li>Pastikan foto terang dan menggugah selera.</li>
                                    <li>Foto landscape bekerja paling baik.</li>
                                </ul>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="fw-bold">Slogan Utama (Large Text)</label>
                                <input type="text" name="company_name" class="form-control" value="{{ $setting->company_name }}" placeholder="Nama katering anda">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="fw-bold">Sub-Slogan (Description)</label>
                                <textarea name="about_us" class="form-control" rows="3">{{ $setting->about_us }}</textarea>
                            </div>

                            <hr>
                            <h6 class="text-primary fw-bold mb-3"><i class="fas fa-id-card me-1"></i> Pengaturan Hero Card (Section Putih)</h6>
                            
                            <div class="form-group mb-3">
                                <label class="fw-bold">Judul Hero Card</label>
                                <input type="text" name="hero_card_title" class="form-control" value="{{ $setting->hero_card_title ?? 'Cita Rasa Autentik dengan Standar Kebersihan Sempurna' }}">
                            </div>

                            <div class="form-group mb-3">
                                <label class="fw-bold">Gambar Hero Card (Samping Teks)</label>
                                <input type="file" name="hero_card_image" class="form-control mb-2" onchange="previewCardImage(this)">
                                <div id="card-preview-container" class="mt-2 {{ ($setting->hero_card_image ?? false) ? '' : 'd-none' }}">
                                    <img id="card-preview" src="{{ ($setting->hero_card_image ?? false) ? asset('storage/'.$setting->hero_card_image) : '' }}" class="img-fluid rounded border" style="max-height: 150px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-3 text-end mt-4">
                        <button type="submit" class="btn btn-primary px-5">Simpan Perubahan Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-container').classList.remove('d-none');
                document.getElementById('hero-preview').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewCardImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('card-preview-container').classList.remove('d-none');
                document.getElementById('card-preview').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
