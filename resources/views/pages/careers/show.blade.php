@extends('layouts.app')

@section('content')
    <!-- Cover Start-->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url('{{ $profile->cover }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white text-support mb-3 animated slideInDown">IT SUPPORT</h1>
            </div>
        </div>
    </div>
    <!-- Cover End-->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp"
                                data-wow-delay="0.1s">
                                <h3 class="text-uppercase">Tentang Pekerjaan</h3>
                                <hr>
                                <p class="m-0">
                                    Perkembangan teknologi yang kian pesat merupakan salah satu tantangan yang harus
                                    dihadapi oleh semua perusahaan di Indonesia, termasuk BCA. Menjawab tantangan ini, BCA
                                    terus mengedepankan inovasi agar dapat senantiasa menjadi bank yang dapat diandalkan
                                    oleh masyarakat. Inovasi yang dilakukan BCA selama ini membutuhkan dukungan dari semua
                                    pihak terutama bagian IT.
                                    <br><br>
                                    Untuk mempersiapkan tenaga profesional di bidang IT, BCA secara spesifik merancang
                                    program BDP IT. Peserta BDP IT akan mengikuti pelatihan selama 12 bulan di BCA mengenai
                                    perbankan dan Information Technologies. Lulusan program ini akan diangkat langsung
                                    menjadi karyawan tetap dan ditempatkan di Divisi IT BCA. Selama pelatihan, peserta akan
                                    mendapatkan uang saku bulanan, jaminan kesehatan, tunjangan hari raya, tunjangan akhir
                                    tahun dan tentunya pelatihan yang berkualitas dari BCA.
                                    <br><br>
                                    Program BDP IT terbuka untuk lowongan berikut:
                                    <br>
                                <ul>
                                    <li>Application Developer</li>
                                    <li>Back End Developer</li>
                                    <li>IT Security Specialist</li>
                                    <li>IT System Infrastructure Engineer</li>
                                    <li>Mainframe Developer</li>
                                    <li>Network Engineer</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 my-2">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp"
                                data-wow-delay="0.1s">
                                <h3 class="text-uppercase">Persyaratan</h3>
                                <hr>
                                <p class="m-0">
                                <ul>
                                    <li>Min. Sarjana S1 dengan IPK Min. 3,00</li>
                                    <li>Memiliki latar belakang pendidikan dari jurusan Teknik Informatika / Sistem
                                        Informasi /
                                        Teknik Komputer / Statistik / Fisika / Matematika / Teknik Industri / Teknik Mesin /
                                        Teknik Elektro</li>
                                    <li>Memiliki pengetahuan dasar dan ketertarikan di bidang IT</li>
                                    <li>Memiliki pengalaman bekerja di bidang teknologi (IT) menjadi nilai tambah</li>
                                    <li>Usia maks. 24 tahun (Strata 1) dan 26 tahun (Strata 2)</li>
                                    <li>Bersedia tidak menikah selama 1 tahun masa pendidikan</li>
                                    <li>Bersedia menjalani ikatan dinas setelah pendidikan selama 2 tahun</li>
                                    <li>Penempatan di Kantor Pusat (Jakarta / Tangerang)</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp"
                                data-wow-delay="0.1s">
                                <h5 class="text-uppercase">Tanggal Pendaftaran</h5>
                                <hr>
                                <p class="m-0">
                                    <i class="fa fa-calendar-alt text-primary me-2"></i>2 Desember 2024 - 20 Desember 2024
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 my-2">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp"
                                data-wow-delay="0.1s">
                                <h5 class="text-uppercase">Batas Usia</h5>
                                <hr>
                                <p class="m-0">
                                    <i class="fa fa-hourglass-half text-primary me-2"></i>18 - 26 Tahun
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 my-2">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp"
                                data-wow-delay="0.1s">
                                <h5 class="text-uppercase">Lokasi Penempatan</h5>
                                <hr>
                                <p class="m-0">
                                    <i class="fa fa-map-marker-alt text-primary me-2"></i>Magelang
                                    <br><i class="fa fa-map-marker-alt text-primary me-2"></i>Yogyakarta
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
