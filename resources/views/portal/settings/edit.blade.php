@extends('layouts.portal')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Global Setting & SEO</h5>
            </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('portal.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Nama Perusahaan / Katering</label>
                                    <input type="text" name="company_name" class="form-control" value="{{ $setting->company_name ?? 'Nita Jaya Catering' }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>WhatsApp / Telepon (Aktif)</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $setting->phone ?? '' }}" required>
                                    <small class="text-muted">Gunakan format 08xx atau 62xxxx</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Pesan Otomatis WhatsApp</label>
                                    <textarea name="wa_message" class="form-control" rows="2" placeholder="Contoh: Halo Nita Jaya Catering, saya ingin pesan katering...">{{ $setting->wa_message ?? '' }}</textarea>
                                    <small class="text-muted">Pesan ini akan muncul secara otomatis saat pelanggan mengklik tombol WhatsApp.</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Alamat Lengkap (Google Maps Friendly)</label>
                                    <textarea name="address" class="form-control" rows="3" required>{{ $setting->address ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Logo Website</label>
                                    <input type="file" name="logo" class="form-control">
                                    @if($setting->logo ?? false)
                                        <div class="mt-2 text-center border p-2 rounded">
                                            <img src="{{ Str::contains($setting->logo, 'images/') ? asset($setting->logo) : asset('storage/'.$setting->logo) }}" height="50">
                                            <p class="small mb-0 mt-1">Logo Saat Ini</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label>Header Landing Page (Hero Image)</label>
                                    <input type="file" name="hero_image" class="form-control">
                                    @if($setting->hero_image ?? false)
                                        <div class="mt-2 text-center border p-2 rounded">
                                            <img src="{{ asset('storage/'.$setting->hero_image) }}" height="50">
                                            <p class="small mb-0 mt-1">Background Header Saat Ini</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label>Deskripsi Singkat (Tentang Kami / About Us)</label>
                                    <textarea name="about_us" class="form-control" rows="4">{{ $setting->about_us ?? '' }}</textarea>
                                    <small class="text-muted">Jelaskan layanan Anda secara singkat, muncul di bagian bawah hero banner.</small>
                                </div>

                                <hr>
                                <h6 class="text-primary fw-bold mb-3"><i class="fas fa-search me-1"></i> Optimasi SEO & Link Preview</h6>
                                
                                <div class="form-group mb-3">
                                    <label>Meta Title (Judul di Google & Tab Browser)</label>
                                    <input type="text" name="seo_title" class="form-control" value="{{ $setting->seo_title ?? '' }}" placeholder="Contoh: Nita Jaya Catering - Jasa Katering Terbaik di Surabaya">
                                    <small class="text-muted">Rekomendasi: 50-60 karakter.</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Meta Description (Deskripsi di Google & Preview Sosmed)</label>
                                    <textarea name="seo_description" class="form-control" rows="3" placeholder="Jelaskan secara detail layanan Anda untuk mesin pencari...">{{ $setting->seo_description ?? '' }}</textarea>
                                    <small class="text-muted">Rekomendasi: 150-160 karakter agar tidak terpotong di hasil pencarian Google.</small>
                                </div>
                            </div>
                        </div>
                        <div class="text-center pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-5">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
