<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Curriculum Vitae - {{ $user->full_name }}</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1a202c;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #f4f6f8; /* Warna abu-abu sangat muda sesuai gambar */
            font-size: 13px;
        }
        .page-wrapper {
            padding: 50px 60px;
        }
        
        /* HEADER */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .header-left {
            width: 70%;
            vertical-align: middle;
        }
        .header-right {
            width: 30%;
            text-align: right;
            vertical-align: middle;
        }
        .name {
            font-size: 38px;
            font-weight: 900;
            margin: 0;
            text-transform: uppercase;
            line-height: 1.15;
            letter-spacing: 2px;
            color: #000;
        }
        .major {
            font-size: 13px;
            font-weight: 600;
            color: #4a5568;
            margin-top: 15px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        .photo-container {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            overflow: hidden;
            display: inline-block;
            background-color: #e2e8f0;
            border: 2px solid #fff;
        }
        .photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* SEPARATOR */
        .separator {
            border: 0;
            border-bottom: 2px solid #2d3748;
            margin: 15px 0 20px 0;
        }

        /* PROFILE TEXT */
        .section-title {
            font-size: 15px;
            font-weight: 900;
            color: #000;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .profile-text {
            text-align: justify;
            color: #1a202c;
            margin-bottom: 25px;
            font-size: 12px;
            line-height: 1.6;
        }

        /* TWO COLUMN LAYOUT */
        .body-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .col-left {
            width: 38%;
            vertical-align: top;
            padding-right: 25px;
            border-right: 2px solid #2d3748;
        }
        .col-right {
            width: 62%;
            vertical-align: top;
            padding-left: 30px;
        }

        /* LEFT SIDE DETAILS */
        .contact-text {
            color: #1a202c;
            font-size: 12px;
            padding-bottom: 12px;
            vertical-align: top;
        }
        .contact-icon {
            display: inline-block;
            width: 22px;
            height: 22px;
            background-color: #1a202c;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            line-height: 22px;
            font-size: 12px;
            font-weight: bold;
        }

        .edu-school {
            font-weight: bold;
            color: #000;
            margin-bottom: 2px;
            font-size: 12px;
        }
        .edu-major {
            color: #4a5568;
            margin-bottom: 25px;
            font-size: 12px;
        }

        .skill-list {
            padding-left: 15px;
            margin-top: 5px;
            margin-bottom: 15px;
            font-size: 12px;
            color: #1a202c;
        }
        .skill-list li {
            margin-bottom: 4px;
        }
        .skill-list p {
            margin: 0;
            padding: 0;
        }

        /* RIGHT SIDE DETAILS */
        .exp-item {
            margin-bottom: 22px;
        }
        .exp-title {
            font-weight: bold;
            color: #000;
            font-size: 13px;
        }
        .exp-desc {
            margin-top: 8px;
            color: #1a202c;
            font-size: 12px;
            line-height: 1.6;
            margin-left: 15px; /* Memberikan efek indent seperti bullet */
        }
        .exp-desc ul {
            padding-left: 15px;
            margin-top: 5px;
        }

        /* PORTFOLIO SECTION */
        .portfolio-separator {
            page-break-before: always;
        }
        .portfolio-item {
            margin-bottom: 40px;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        .portfolio-image {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .portfolio-desc {
            font-size: 13px;
            color: #4a5568;
            text-align: justify;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <!-- HEADER -->
        <table class="header-table">
            <tr>
                <td class="header-left">
                    @php
                        // Memisahkan nama menjadi 2 baris agar seperti desain "SAMIRA \n HADID"
                        $nameParts = explode(' ', $user->full_name);
                        if (count($nameParts) > 1) {
                            $firstName = array_shift($nameParts);
                            // Menggabungkan sisa nama di baris kedua
                            $lastName = implode(' ', $nameParts);
                        } else {
                            $firstName = $user->full_name;
                            $lastName = '';
                        }
                    @endphp
                    <div class="name">{{ $firstName }}<br>{{ $lastName }}</div>
                    <div class="major">{{ $user->major ?? 'Jurusan Anda' }}</div>
                </td>
                <td class="header-right">
                    <div class="photo-container">
                        @if($user->photo)
                            @php
                                $photoPath = storage_path('app/public/' . $user->photo);
                            @endphp
                            @if(file_exists($photoPath))
                                <img src="{{ $photoPath }}" class="photo" alt="Photo">
                            @endif
                        @else
                            <div style="text-align: center; line-height: 130px; font-size: 12px; color: #a0aec0;">No Photo</div>
                        @endif
                    </div>
                </td>
            </tr>
        </table>

        <!-- SEPARATOR 1 -->
        <hr class="separator">

        <!-- PROFIL TEXT -->
        <div class="section-title">PROFIL</div>
        <div class="profile-text">
            {{ $user->major_description ?? 'Lulusan SMK yang memiliki keterampilan adaptif dan organisasi yang baik. Berpengalaman dalam mendukung operasional secara efektif. Telah mengikuti berbagai program pendidikan vokasi untuk memperkuat kemampuan profesional dan keterampilan komunikasi yang bermanfaat bagi dunia kerja dan industri.' }}
        </div>

        <!-- SEPARATOR 2 -->
        <hr class="separator">

        <!-- CONTENT 38/62 -->
        <table class="body-table">
            <tr>
                <!-- KOLOM KIRI -->
                <td class="col-left">
                    <div class="section-title">KONTAK</div>
                    
                    <table style="width: 100%; margin-bottom: 10px;">
                        <tr>
                            <td style="width: 32px;"><div class="contact-icon">&#9990;</div></td>
                            <td class="contact-text">{{ $user->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="width: 32px;"><div class="contact-icon">&#9993;</div></td>
                            <td class="contact-text">{{ $user->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="width: 32px;"><div class="contact-icon">&#8962;</div></td>
                            <td class="contact-text">{{ $user->domicile ?? '-' }}</td>
                        </tr>
                    </table>

                    <div class="section-title" style="margin-top: 15px;">PENDIDIKAN</div>
                    <div class="edu-school">SMK Negeri 4 Bandung | {{ $user->graduation_year ?? 'Sekarang' }}</div>
                    <div class="edu-major">Jurusan {{ $user->major ?? '-' }}</div>

                    <div class="section-title" style="margin-top: 15px;">KEMAMPUAN</div>
                    <div class="skill-list">
                        {!! $user->hard_skills ?? '<ul><li>Belum diisi</li></ul>' !!}
                    </div>
                    <div class="skill-list" style="margin-top: -5px;">
                        {!! $user->soft_skills ?? '<ul><li>Belum diisi</li></ul>' !!}
                    </div>
                </td>
                
                <!-- KOLOM KANAN -->
                <td class="col-right">
                    <div class="section-title">PENGALAMAN</div>
                    
                    @if($user->pklExperiences && $user->pklExperiences->count() > 0)
                        @foreach($user->pklExperiences as $pkl)
                            <div class="exp-item">
                                <!-- Cetak tebal judul pengalaman/posisi -->
                                <div class="exp-title">{{ $pkl->position }} – {{ $pkl->company_name }}</div>
                                <div class="exp-desc">
                                    &#x2022; {!! nl2br(e($pkl->description)) !!}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="exp-item">
                            <div class="exp-desc" style="margin-left: 0;">- Belum ada pengalaman dimasukkan.</div>
                        </div>
                    @endif

                </td>
            </tr>
        </table>
    </div>
    
    <!-- HALAMAN BARU: PORTOFOLIO -->
    @if($user->portfolios && $user->portfolios->count() > 0)
        <!-- Kode 'page-break-before' akan memaksa DOMPDF merender elemen ini di kertas baru -->
        <div class="portfolio-separator"></div>
        
        <div class="page-wrapper">
            <h1 class="name" style="margin-bottom: 5px; font-size: 32px;">PORTOFOLIO</h1>
            <div class="major" style="margin-top: 0; margin-bottom: 20px;">DOKUMENTASI KARYA & SERTIFIKAT</div>
            
            <hr class="separator">
            
            @foreach($user->portfolios as $portofolio)
                <div class="portfolio-item">
                    <div class="section-title" style="margin-bottom: 5px; border:none; padding:0; font-size: 16px;">
                        {{ $portofolio->judul }}
                    </div>
                    @if($portofolio->image_path)
                        @php
                            $imgPath = storage_path('app/public/' . $portofolio->image_path);
                        @endphp
                        @if(file_exists($imgPath))
                            <img src="{{ $imgPath }}" class="portfolio-image" alt="Portofolio {{ $portofolio->judul }}">
                        @endif
                    @endif
                    <div class="portfolio-desc">
                        {{ $portofolio->description }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</body>
</html>
