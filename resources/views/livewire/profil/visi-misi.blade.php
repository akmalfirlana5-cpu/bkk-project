<div>
    <section class="pt-30 lg:pt-25">
        <div 
            style="background-image: url('{{ asset('/assets/static/background/hero-section.png') }}')"
            class="container mx-auto px-5 lg:px-0 rounded-3xl bg-cover bg-center relative h-[50vh] overflow-hidden">
            <div class="absolute inset-0 bg-linear-to-t from-bkkNeutral-900/90 to-88% to-bkkNeutral-900/45 z-1"></div>
            <div class="relative z-2 w-full h-full flex flex-col justify-center mx-0 lg:mx-14">
                <div class="flex items-center gap-2.5 paragraph-16s text-bkkNeutral-50 mb-7">
                    <a href="{{ route('beranda') }}">Beranda</a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L1 9" stroke="#FBFCFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a href="#">Profil BKK</a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L1 9" stroke="#FBFCFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a href="{{ route('visi-misi') }}">Visi Misi</a>
                </div>
                <h1 class="heading-48s text-bkkNeutral-50 mb-3 lg:w-[55%]">
                    Profil BKK
                </h1>
                <div class="paragraph-16r text-bkkNeutral-100 w-full lg:w-[60%]">
                    Mengenal Bursa Kerja Khusus (BKK) lebih dekat melalui informasi seputar peran, program, dan kegiatan yang diselenggarakan sebagai upaya mendukung kesiapan lulusan memasuki dunia kerja secara terarah dan berkelanjutan.
                </div>
            </div>
        </div>
    </section>
    <section class="py-15 md:py-20">
        <div class="container mx-auto px-5 lg:px-0">
            <h2 class="heading-48s text-bkkNeutral-900 mb-4">
                Visi Misi
            </h2>
            <div class="paragraph-16r text-bkkNeutral-700 mb-9">
                Visi dan misi BKK menjadi landasan dalam menetapkan arah dan tujuan kegiatan. Berikut adalah visi dan misi BKK SMK Negeri 4 Malang:
            </div>
            <div class="flex flex-col lg:flex-row items-center gap-4">
                <div class="flex flex-col items-start p-6 shadow-md rounded-[20px] bg-white w-full lg:w-[50%] min-h-[200px] lg:min-h-[300px]">
                    <div class="p-2 rounded-[12px] border border-bkkNeutral-100 mb-4">
                        <svg class="shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 14C13.1046 14 14 13.1046 14 12C14 10.8954 13.1046 10 12 10C10.8954 10 10 10.8954 10 12C10 13.1046 10.8954 14 12 14Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3 class="heading-20s text-black mb-3">
                        Visi BKK SMK Negeri 4 Malang
                    </h3>
                    <div class="paragraph-16r text-bkkNeutral-700 w-full lg:w-[65%]">
                        “Menjadikan unit kerja yang dapat menyediakan dan menyalurkan informasi tenaga kerja yang cepat, tepat dan akurat sesuai dengan kebutuhan dunia Industri”
                    </div>
                </div>
                <div class="flex flex-col items-start p-6 shadow-md rounded-[20px] bg-white w-full lg:w-[50%] min-h-[300px]">
                    <div class="p-2 rounded-[12px] border border-bkkNeutral-100 mb-4">
                        <svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.75 12.75H16.75M4.75 10.75L2.25 13.75L0.75 12.75M7.75 7.75H16.75M4.75 5.75L2.25 8.75L0.75 7.75M7.75 2.75H16.75M4.75 0.75L2.25 3.75L0.75 2.75" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3 class="heading-20s text-black mb-3">
                        Misi BKK SMK Negeri 4 Malang
                    </h3>
                    <ol class="paragraph-14r text-bkkNeutral-700 list-decimal list-inside space-y-2">
                        <li>Memberikan layanan informasi dunia kerja yang sesuai dengan kebutuhan.</li>
                        <li>Mempromosikan tenaga kerja lulusan SMK ke dunia industri.</li>
                        <li>Merekrut dan menyalurkan calon tenaga kerja ke perusahaan-perusahaan.</li>
                        <li>Memberikan pelayanan pelatihan untuk pemantapan memasuki dunia kerja.</li>
                        <li>Mengadakan kerjasama dengan masyarakat, dunia usaha dan dunia industri.</li>
                        <li>Penelusuran alumni.</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
</div>
