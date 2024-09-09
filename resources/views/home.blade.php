<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <h3 class="text-2xl font-semibold mb-4">Selamat datang di Sistem Pemilihan Kandidat berbasis DSS</h3>

        <p class="mb-6 text-lg text-gray-700">
            Sistem ini dirancang untuk membantu Anda dalam menilai dan memilih kandidat berdasarkan berbagai kriteria menggunakan metode Decision Support System (DSS). Dengan antarmuka yang intuitif, Anda dapat dengan mudah memasukkan data dan memperoleh hasil yang akurat untuk pengambilan keputusan yang lebih baik.
        </p>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h4 class="text-xl font-medium mb-4">Cara Menggunakan Sistem</h4>
            <ul class="list-disc list-inside space-y-2">
                <li><strong>Menambahkan Kandidat:</strong> Akses halaman <a href="/alternative" class="text-blue-500 hover:underline">/alternative</a> untuk memasukkan nama-nama kandidat yang akan dinilai.</li>
                <li><strong>Menambahkan Kriteria Penilaian:</strong> Kunjungi halaman <a href="/criteria" class="text-blue-500 hover:underline">/criteria</a> untuk mendefinisikan kriteria yang akan digunakan dalam penilaian kandidat.</li>
                <li><strong>Menetapkan Kriteria untuk Kandidat:</strong> Anda dapat mengaitkan kriteria dengan kandidat melalui halaman <a href="/alternative" class="text-blue-500 hover:underline">/alternative</a> atau <a href="/criteria" class="text-blue-500 hover:underline">/criteria</a>, sesuai dengan preferensi Anda.</li>
                <li><strong>Melakukan Kalkulasi:</strong> Lakukan kalkulasi hasil penilaian dengan mengunjungi halaman <a href="/calculation" class="text-blue-500 hover:underline">/calculation</a>. Sistem akan memproses data yang telah dimasukkan dan menghasilkan hasil yang relevan.</li>
                <li><strong>Melihat Riwayat Perhitungan:</strong> Anda dapat memeriksa riwayat perhitungan sebelumnya di halaman <a href="/history" class="text-blue-500 hover:underline">/history</a>, yang menyediakan informasi tentang perhitungan yang telah dilakukan.</li>
            </ul>
        </div>
    </div>
</x-layout>
