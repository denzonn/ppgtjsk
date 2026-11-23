@php
    $h2 = 'mb-2 text-xl font-bold tracking-[0.1rem] text-white';
    $p = 'text-[0.8rem] font-extralight tracking-[0.1rem] text-[#d2d2d2]';
    $linkTerkait = App\Models\LinkTerkait::all();
@endphp
<footer class="relative mt-[60px] bg-navy pb-5 pt-[50px]">
    <div class="mx-auto max-w-[1220px] px-3">
        <div class="grid gap-6 lg:grid-cols-4">
            <div>
                <h2 class="{{ $h2 }}"><i class="fa-solid fa-location-dot"></i> Sekretariat</h2>
                <p class="{{ $p }}">
                    Jl. Satria Kasih, Paccerakkang, Kec. Biringkanaya, <br> Kota Makassar, Sulawesi Selatan 90245
                    <br>
                    (Masuk telkomas lalu belok kiri di samping funsit atau dallah)
                </p>
            </div>
            <div class="h-[300px]">
                <iframe class="size-full rounded-[5px] border-0"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d511.2876245891922!2d119.51002568820536!3d-5.126553155109209!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefbd4168ca635%3A0x84a8435213577ec7!2sPPGT%20JEMAAT%20SATRIA%20KASIH!5e0!3m2!1sid!2sid!4v1682579163490!5m2!1sid!2sid"
                    allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div>
                <h2 class="{{ $h2 }}">Hubungi Kami</h2>
                <p class="{{ $p }} leading-[35px]">
                    <i class="fa-solid fa-phone"></i> Ketua : Resky Palimbinan
                    <br>
                    ( <a href="https://wa.me/6282346484775" class="text-white hover:text-[#b4b4b4]">082346484775</a> )
                    <br>
                    <i class="fa-solid fa-phone"></i> Sekretaris : Hardianto Tandiseno
                    <br>
                    ( <a href="https://wa.me/6285155032260" class="text-white hover:text-[#b4b4b4]">082346484775</a> )
                </p>
            </div>
            <div>
                <h2 class="{{ $h2 }}">Media Sosial</h2>
                <p class="mb-4 flex gap-5 text-2xl leading-[35px]">
                    <a href="https://www.instagram.com/ppgtsatriakasih?igsh=MWh0Y2lxdmp6YjB5eA==" target="_blank"
                        class="text-white transition-transform duration-300 hover:-translate-y-[5px]"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.youtube.com/@ppgtsatriakasih1038" target="_blank"
                        class="text-white transition-transform duration-300 hover:-translate-y-[5px]"><i
                            class="fa-brands fa-youtube"></i></a>
                </p>
                <h2 class="{{ $h2 }}">Link Terkait</h2>
                <p class="{{ $p }} leading-[35px]">
                    @forelse ($linkTerkait as $item)
                        <a href="{{ $item->link }}" class="text-white hover:text-[#b4b4b4]">{{ $item->label }}</a>
                        <br>
                    @empty
                        No Data
                    @endforelse
                </p>
            </div>
        </div>
        <hr class="mb-4 mt-[50px] border-gray-500">
        <p class="text-center text-gray-400">
            &copy; 2023 PPGT Jemaat Satria Kasih
        </p>
    </div>
</footer>
