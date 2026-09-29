<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>JELAJAH NUSA - Petualangan Kelas 4</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.11/dist/htmx.min.js" integrity="sha384-2OatzQy1H+Zd/IIrjr1TcuDGqLXeHhbooAyJY1KdQMKnr4LZ22k31GBLdYKHmVjg" crossorigin="anonymous"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        ink: '#2D3348',
        cream: '#F4F7FF',
        nbyellow: '#FFCF48',
        nborange: '#FF9F5A',
        nbred: '#FF6B7A',
        nbgreen: '#34C98E',
        nbblue: '#4DABF7',
        nbpurple: '#9F8CFB',
        nbpink: '#F783AC',
        nbscarlet: '#ff2400',
        nbtruered: '#ff0000',
        white: '#f2f3f4'
      },
      fontFamily: {
        sans: ['Plus Jakarta Sans', 'sans-serif'],
        display: ['Google Sans', 'system-ui', 'sans-serif']
      },
      boxShadow: {
        nb: '0 4px 14px rgba(45,51,72,.10)',
        nbsm: '0 2px 6px rgba(45,51,72,.12)',
        nblg: '0 12px 32px rgba(45,51,72,.16)'
      }
    }
  }
}
</script>
<style>
  :root{ color-scheme: light; }
  html,body{ height:100%; }
  body{ background-color:#E9EEFB; overscroll-behavior:none; -webkit-tap-highlight-color:transparent; }
  #mainScroll{ -webkit-overflow-scrolling:touch; overscroll-behavior:contain; }
  .nb-border{ border:1.5px solid rgba(45,51,72,.10); }
  .nb-card{ background-color:rgba(255,255,255,.62); -webkit-backdrop-filter:blur(18px) saturate(170%); backdrop-filter:blur(18px) saturate(170%); border:1px solid rgba(255,255,255,.8); border-radius:1.5rem; box-shadow:0 8px 28px rgba(45,51,72,.09); }
  .glass{ background-color:rgba(255,255,255,.6); -webkit-backdrop-filter:blur(18px) saturate(170%); backdrop-filter:blur(18px) saturate(170%); border:1px solid rgba(255,255,255,.8); box-shadow:0 8px 30px rgba(45,51,72,.12); }
  .glass-header{ background-color:rgba(255,255,255,.55); -webkit-backdrop-filter:blur(18px) saturate(170%); backdrop-filter:blur(18px) saturate(170%); border-bottom:1px solid rgba(255,255,255,.8); box-shadow:0 4px 20px rgba(45,51,72,.06); }
  .nb-btn{ border-radius:1rem; font-weight:400; box-shadow:0 2px 6px rgba(45,51,72,.15); transition:transform .1s ease; }
  .nb-btn:active{ transform:scale(.97); }
  .nb-pill{ -webkit-backdrop-filter:blur(8px); backdrop-filter:blur(8px); border-radius:999px; font-weight:700; box-shadow:0 1px 4px rgba(45,51,72,.12); transition:transform .1s ease; }
  .nb-pill:active{ transform:scale(.97); }
  @keyframes toastIn{ from{opacity:0;} to{opacity:1;} }
  .animate-toast{ animation: toastIn .2s ease forwards; }
  .certificate-border{ border:3px solid #FFCF48; box-shadow: inset 0 0 0 5px #fff, inset 0 0 0 7px #FFE49A; }
  @media print{
    body *{ visibility:hidden; }
    #printable-certificate, #printable-certificate *{ visibility:visible; }
    #printable-certificate{ position:absolute; left:0; top:0; width:100%; margin:0; padding:20px; }
  }
</style>
</head>
<body class="font-sans text-ink flex flex-col antialiased selection:bg-nbyellow" style="width: 100vw; overflow-x: hidden; overscroll-behavior: none;">

<?= $this->include('partials/toast_container') ?>

<div class="max-w-md w-full mx-auto bg-gradient-to-b from-[#EAF2FF] via-[#F1F0FF] to-[#FF240055] h-[100dvh] md:h-[min(860px,calc(100dvh-3rem))] md:my-6 relative isolate flex flex-col md:rounded-[2rem] md:shadow-nblg overflow-hidden">
  <?= $this->renderSection('content') ?>
</div>

<script>
function showToast(message, type = 'info') {
  const container = document.getElementById('toastContainer');
  const toast = document.createElement('div');
  let bar = 'bg-nbblue';
  let icon = 'fa-circle-info';
  if (type === 'success') { bar = 'bg-nbgreen'; icon = 'fa-circle-check'; }
  else if (type === 'warning') { bar = 'bg-nborange'; icon = 'fa-triangle-exclamation'; }

  toast.className = "nb-card !bg-white/90 px-4 py-3 flex items-center gap-2.5 text-xs font-bold animate-toast pointer-events-auto max-w-xs";
  toast.innerHTML = `<span class="w-7 h-7 ${bar} nb-border rounded-lg flex items-center justify-center text-white shrink-0"><i class="fa-solid ${icon}"></i></span><span class="flex-1">${message}</span>`;
  container.appendChild(toast);
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transition = 'opacity .3s';
    setTimeout(() => toast.remove(), 300);
  }, 2800);
}

const colorMap = {
  emerald: 'nbgreen', sky: 'nbblue', amber: 'nborange', purple: 'nbpurple', rose: 'nbpink'
};

const chaptersData = [
            {
                id: 1,
                semester: 1,
                babNum: "Bab 1",
                title: "Misteri Tumbuhan & Energi x Teks Eksplanasi",
                ipasTopic: "Proses Fotosintesis & Transformasi Energi Tumbuhan",
                bindoTopic: "Membaca Teks Eksplanasi & Ide Pokok",
                icon: "fa-leaf",
                color: "emerald",
                materialText: `
                    <p>Tumbuhan adalah produsen utama di bumi. Melalui proses <span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Fotosintesis', 'Proses pembuatan makanan pada tumbuhan hijau dengan bantuan cahaya matahari, air, dan karbondioksida.', 'Daun melakukan fotosintesis di siang hari.')">fotosintesis</span>, tumbuhan mengubah energi cahaya matahari menjadi energi kimia dalam bentuk gula dan oksigen.</p>
                    <p>Dalam teks eksplanasi ilmiah, paragraf pertama berisi pernyataan umum tentang pentingnya <span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Klorofil', 'Zat hijau daun yang menyerap sinar matahari.', 'Daun yang terkena sinar matahari akan membentuk klorofil.')">klorofil</span>. Paragraf berikutnya menjelaskan deretan penjelas mengenai proses masuknya air melalui akar hingga dilepaskannya oksigen ke udara.</p>
                `,
                videoTitle: "Animasi Fotosintesis & Struktur Eksplanasi",
                checkpointQuiz: {
                    q: "Apa zat hijau daun yang membantu fotosintesis?",
                    options: ["Klorofil", "Oksigen", "Karbohidrat", "Stomata"],
                    correct: 0
                },
                miniGame: {
                    title: "Pencocok Pasangan Fotosintesis",
                    pairs: [
                        { item: "Sinar Matahari", match: "Energi Cahaya" },
                        { item: "Klorofil", match: "Zat Hijau Daun" },
                        { item: "Hasil Utama", match: "Oksigen & Glukosa" }
                    ]
                },
                assessmentIPAS: [
                    { q: "Gas yang diserap tumbuhan saat fotosintesis adalah...", options: ["Oksigen", "Karbondioksida", "Nitrogen", "Helium"], correct: 1 },
                    { q: "Energi apa yang diubah tumbuhan saat fotosintesis?", options: ["Cahaya menjadi Kimia", "Panas menjadi Gerak", "Bunyi menjadi Cahaya", "Listrik menjadi Panas"], correct: 0 },
                    { q: "Bagian tumbuhan yang berfungsi menyerap air dari tanah adalah...", options: ["Bunga", "Daun", "Akar", "Batang"], correct: 2 },
                    { q: "Hasil fotosintesis yang dihirup manusia adalah...", options: ["Karbondioksida", "Karbonmonoksida", "Oksigen", "Metana"], correct: 2 },
                    { q: "Tempat terjadinya fotosintesis terutama pada...", options: ["Akar", "Daun", "Biji", "Buah"], correct: 1 }
                ],
                assessmentBIndo: [
                    { q: "Teks eksplanasi bertujuan untuk menjelaskan...", options: ["Cara membuat makanan", "Proses terjadinya suatu fenomena", "Pengalaman liburan", "Dongeng fiksi"], correct: 1 },
                    { q: "Gagasan utama dalam suatu paragraf disebut...", options: ["Ide pendukung", "Ide pokok", "Kalimat penjelas", "Judul"], correct: 1 },
                    { q: "Bagian awal teks eksplanasi berisi...", options: ["Pernyataan Umum", "Kesimpulan Akhir", "Deretan Penjelas", "Saran"], correct: 0 },
                    { q: "Kalimat yang menjelaskan ide pokok dinamakan...", options: ["Kalimat Utama", "Kalimat Penjelas", "Kalimat Tanya", "Kalimat Perintah"], correct: 1 },
                    { q: "Kata 'fotosintesis' termasuk contoh kosakata...", options: ["Sastra", "Ilmiah/Teknis", "Gaul", "Daerah"], correct: 1 }
                ]
            },
            {
                id: 2,
                semester: 1,
                babNum: "Bab 2",
                title: "Gaya di Sekitar Kita x Laporan Hasil Pengamatan",
                ipasTopic: "Gaya Otot, Gesek, Magnet & Gravitasi",
                bindoTopic: "Menulis Laporan Pengamatan & Ide Pendukung",
                icon: "fa-magnet",
                color: "sky",
                materialText: `
                    <p><span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Gaya', 'Tarikan atau dorongan yang dapat menyebabkan benda bergerak atau berubah bentuk.', 'Ayah memberikan gaya dorong pada mobil.')">Gaya</span> adalah tarikan atau dorongan yang mempengaruhi gerak benda. Ketika kamu mengerem sepeda, terjadi <span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Gaya Gesek', 'Gaya yang timbul akibat gesekan dua permukaan benda.', 'Ban sepeda bergesekan dengan jalan.')">gaya gesek</span> antara permukaan ban dan jalan.</p>
                    <p>Laporan hasil pengamatan harus memuat fakta objektif: waktu pengamatan, tempat, objek yang diamati, serta hasil observasi gaya secara runtut.</p>
                `,
                videoTitle: "Mengenal Gaya & Menulis Laporan",
                checkpointQuiz: {
                    q: "Gaya apa yang terjadi saat buah kelapa jatuh dari pohon?",
                    options: ["Gaya Magnet", "Gaya Gravitasi", "Gaya Otot", "Gaya Pegas"],
                    correct: 1
                },
                miniGame: {
                    title: "Pengelompokan Jenis Gaya",
                    pairs: [
                        { item: "Mendorong Meja", match: "Gaya Otot" },
                        { item: "Kompas Menunjuk Utara", match: "Gaya Magnet" },
                        { item: "Mengerem Sepeda", match: "Gaya Gesek" }
                    ]
                },
                assessmentIPAS: [
                    { q: "Gaya yang dihasilkan oleh tarikan bumi disebut...", options: ["Gaya Pegas", "Gaya Gravitasi", "Gaya Magnet", "Gaya Gesek"], correct: 1 },
                    { q: "Makin kasar permukaan benda, gaya gesek akan semakin...", options: ["Kecil", "Besar", "Hilang", "Sama"], correct: 1 },
                    { q: "Benda berikut yang dapat ditarik magnet adalah...", options: ["Pensil Kayu", "Paku Besi", "Penghapus Karet", "Baskom Plastik"], correct: 1 },
                    { q: "Ketapel menggunakan prinsip kerja gaya...", options: ["Pegas", "Magnet", "Gravitasi", "Listrik"], correct: 0 },
                    { q: "Saat menendang bola, kita menggunakan gaya...", options: ["Otot", "Listrik", "Magnet", "Gravitasi"], correct: 0 }
                ],
                assessmentBIndo: [
                    { q: "Laporan hasil pengamatan ditulis berdasarkan...", options: ["Khayalan penulis", "Fakta dan observasi langsung", "Cerita tetangga", "Mimpi"], correct: 1 },
                    { q: "Bagian yang TIDAK wajib ada dalam laporan pengamatan adalah...", options: ["Waktu pengamatan", "Hasil pengamatan", "Puisi penutup", "Tempat pengamatan"], correct: 2 },
                    { q: "Bahasa yang digunakan dalam laporan harus bersifat...", options: ["Baku dan Jelas", "Bebas dan Gaul", "Rahasia", "Rumit"], correct: 0 },
                    { q: "Informasi tambahan yang memperjelas ide pokok disebut...", options: ["Ide Pendukung", "Judul Teks", "Tema", "Amanat"], correct: 0 },
                    { q: "Mengapa teks laporan pengamatan harus jujur?", options: ["Agar pembaca tidak keliru mendapatkan fakta", "Agar tulisan jadi panjang", "Agar dapat hadiah", "Tidak wajib jujur"], correct: 0 }
                ]
            },
            {
                id: 3,
                semester: 1,
                babNum: "Bab 3",
                title: "Jejak Budaya Daerahku x Cerita Rakyat & Wawancara",
                ipasTopic: "Keanekaragaman Rumah Adat & Tarian Nusantara",
                bindoTopic: "Menyimak Cerita Rakyat & Unsur Wawancara",
                icon: "fa-masks-theater",
                color: "amber",
                materialText: `
                    <p>Indonesia kaya akan <span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Keragaman Budaya', 'Variasi kebiasaan, adat, dan kesenian dalam suatu daerah.', 'Indonesia memiliki ratusan suku dan keragaman budaya.')">keragaman budaya</span>. Setiap daerah memiliki keunikan rumah adat, pakaian tradisional, dan tarian daerah.</p>
                    <p>Untuk menggali sejarah lokal, kita dapat melakukan <span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Wawancara', 'Tanya jawab dengan narasumber untuk memperoleh informasi.', 'Siswa melakukan wawancara dengan tokoh masyarakat.')">wawancara</span> dengan tokoh adat menggunakan kata tanya 5W+1H (Apa, Siapa, Di mana, Kapan, Mengapa, Bagaimana).</p>
                `,
                videoTitle: "Warisan Budaya & Etika Wawancara",
                checkpointQuiz: {
                    q: "Kata tanya untuk menanyakan alasan terjadinya peristiwa adalah...",
                    options: ["Siapa", "Mengapa", "Kapan", "Di mana"],
                    correct: 1
                },
                miniGame: {
                    title: "Jodohkan Budaya Daerah",
                    pairs: [
                        { item: "Rumah Gadang", match: "Sumatera Barat" },
                        { item: "Tari Kecak", match: "Bali" },
                        { item: "Rumah Tongkonan", match: "Toraja (Sulsel)" }
                    ]
                },
                assessmentIPAS: [
                    { q: "Rumah adat khas dari daerah Papua dinamakan...", options: ["Honai", "Joglo", "Gadang", "Tongkonan"], correct: 0 },
                    { q: "Sikap yang baik terhadap perbedaan budaya teman adalah...", options: ["Mengejek", "Saling Mengandalkan", "Saling Menghormati", "Acuh Tak Acuh"], correct: 2 },
                    { q: "Suku Asmat berasal dari provinsi...", options: ["Papua", "Jawa Timur", "Aceh", "Bali"], correct: 0 },
                    { q: "Senjata tradisional Kujang berasal dari daerah...", options: ["Jawa Barat", "Sumatera Utara", "NTT", "Kalimantan"], correct: 0 },
                    { q: "Pakaian adat biasanya digunakan saat...", options: ["Tidur", "Upacara Adat & Pernikahan", "Olah Raga", "Berenang"], correct: 1 }
                ],
                assessmentBIndo: [
                    { q: "Orang yang memberikan informasi saat wawancara disebut...", options: ["Pewawancara", "Narasumber", "Notulen", "Moderator"], correct: 1 },
                    { q: "Kata tanya 'Kapan' digunakan untuk menanyakan...", options: ["Tempat", "Waktu", "Alasan", "Nama Orang"], correct: 1 },
                    { q: "Tokoh utama dalam cerita rakyat biasanya memiliki sifat...", options: ["Protagonis", "Antagonis", "Campuran", "Penjahat"], correct: 0 },
                    { q: "Pesan moral yang terkandung dalam cerita dinamakan...", options: ["Latar", "Amanat", "Alur", "Sudut Pandang"], correct: 1 },
                    { q: "Sebelum melakukan wawancara, kita harus menyiapkan...", options: ["Daftar Pertanyaan", "Hadiah Mewah", "Makanan", "Kamera Mahal"], correct: 0 }
                ]
            },
            {
                id: 4,
                semester: 1,
                babNum: "Bab 4",
                title: "Pasar & Ekonomi Cilik x Teks Prosedur Jual-Beli",
                ipasTopic: "Kebutuhan Manusia & Kegiatan Ekonomi Pasar",
                bindoTopic: "Teks Prosedur & Percakapan Santun",
                icon: "fa-store",
                color: "purple",
                materialText: `
                    <p><span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Kebutuhan Primer', 'Kebutuhan pokok yang wajib dipenuhi seperti makanan, pakaian, dan rumah.', 'Makan nasi adalah kebutuhan primer.')">Kebutuhan primer</span> adalah hal pokok untuk bertahan hidup. Di pasar tradisional, terjadi interaksi antara penjual dan pembeli dalam kegiatan ekonomi.</p>
                    <p>Teks prosedur menyajikan langkah-langkah bertransaksi secara runtut menggunakan kalimat perintah yang santun dan jelas.</p>
                `,
                videoTitle: "Pasar Tradisional & Teks Prosedur",
                checkpointQuiz: {
                    q: "Manakah yang termasuk kebutuhan primer manusia?",
                    options: ["Mobil Mewah", "Makanan Sehat", "Gadget Canggih", "Perhiasan Emas"],
                    correct: 1
                },
                miniGame: {
                    title: "Klasifikasi Kebutuhan",
                    pairs: [
                        { item: "Rumah & Pakaian", match: "Kebutuhan Primer" },
                        { item: "Sepeda Motor", match: "Kebutuhan Sekunder" },
                        { item: "Liburan Luar Negeri", match: "Kebutuhan Tersier" }
                    ]
                },
                assessmentIPAS: [
                    { q: "Tempat bertemunya penjual dan pembeli dinamakan...", options: ["Pasar", "Sekolah", "Rumah Sakit", "Terminal"], correct: 0 },
                    { q: "Berikut yang merupakan contoh kegiatan produksi adalah...", options: ["Petani menanam padi", "Anak membeli permen", "Supir mengantar barang", "Siswa memakai baju"], correct: 0 },
                    { q: "Orang yang menggunakan atau menghabiskan barang disebut...", options: ["Produsen", "Konsumen", "Distributor", "Agen"], correct: 1 },
                    { q: "Alat pembayaran sah di Indonesia saat ini adalah...", options: ["Barter", "Uang Rupiah", "Emas", "Perak"], correct: 1 },
                    { q: "Kebutuhan yang pemenuhannya dapat ditunda setelah kebutuhan pokok dipenuhi disebut...", options: ["Kebutuhan Primer", "Kebutuhan Sekunder", "Kebutuhan Utama", "Kebutuhan Mutlak"], correct: 1 }
                ],
                assessmentBIndo: [
                    { q: "Ciri utama teks prosedur adalah memuat...", options: ["Langkah-langkah kerja/kegiatan", "Cerita khayalan", "Daftar belanjaan bebas", "Puisi indah"], correct: 0 },
                    { q: "Kata kerja imperatif yang sering ada pada teks prosedur contohnya...", options: ["Campurkan!", "Melihat", "Berlari", "Di rumah"], correct: 0 },
                    { q: "Saat menawar barang di pasar, kita harus menggunakan bahasa yang...", options: ["Kasar", "Santun dan Ramah", "Membentak", "Berbisik-bisik"], correct: 1 },
                    { q: "Urutan dalam teks prosedur harus bersifat...", options: ["Acak", "Runtut dan Sistematis", "Bebas", "Terbalik"], correct: 1 },
                    { q: "Tujuan penulisan teks prosedur adalah...", options: ["Petunjuk melakukan sesuatu secara benar", "Menghibur pembaca", "Menceritakan masa lalu", "Mengajak berkelahi"], correct: 0 }
                ]
            },
            {
                id: 5,
                semester: 2,
                babNum: "Bab 5",
                title: "Pahlawan Nusantara x Teks Biografi Tokoh",
                ipasTopic: "Kerajaan Kerajaan Nusantara & Tokoh Sejarah",
                bindoTopic: "Membaca Teks Biografi & Unsur Intrinsik Cerita",
                icon: "fa-shield-halved",
                color: "rose",
                materialText: `
                    <p>Kerajaan Hindu-Buddha dan Islam meninggalkan warisan sejarah di Nusantara. Tokoh seperti <span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Patih Gajah Mada', 'Mahapatih Kerajaan Majapahit yang terkenal dengan Sumpah Palapa.', 'Gajah Mada bersumpah menyatukan Nusantara.')">Patih Gajah Mada</span> memperjuangkan persatuan wilayah.</p>
                    <p>Teks <span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Biografi', 'Teks yang menceritakan riwayat hidup seseorang secara nyata.', 'Biografi Pangeran Diponegoro penuh perjuangan.')">biografi</span> berisi keteladanan, riwayat perjuangan, dan sifat pantang menyerah pahlawan yang patut kita contoh.</p>
                `,
                videoTitle: "Jejak Kerajaan & Biografi Pahlawan",
                checkpointQuiz: {
                    q: "Sumpah terkenal yang diucapkan Mahapatih Gajah Mada adalah...",
                    options: ["Sumpah Pemuda", "Sumpah Palapa", "Sumpah Prajurit", "Sumpah Setia"],
                    correct: 1
                },
                miniGame: {
                    title: "Pencocokan Tokoh Pahlawan",
                    pairs: [
                        { item: "R.A. Kartini", match: "Emansipasi Wanita" },
                        { item: "Pangeran Diponegoro", match: "Perang Jawa" },
                        { item: "Sultan Hasanuddin", match: "Ayam Jantan dari Timur" }
                    ]
                },
                assessmentIPAS: [
                    { q: "Kerajaan Majapahit mencapai puncak kejayaan pada masa Raja...", options: ["Hayam Wuruk", "Mulawarman", "Purnawarman", "Raden Patah"], correct: 0 },
                    { q: "Candi Borobudur merupakan peninggalan bercorak...", options: ["Hindu", "Buddha", "Islam", "Konghucu"], correct: 1 },
                    { q: "Kerajaan Kutai adalah kerajaan Hindu tertua di Indonesia yang terletak di...", options: ["Jawa Timur", "Kalimantan Timur", "Sumatera Selatan", "Sulawesi"], correct: 1 },
                    { q: "Julukan 'Ayam Jantan dari Timur' diberikan kepada...", options: ["Sultan Ageng", "Sultan Hasanuddin", "Tuanku Imam Bonjol", "Cut Nyak Dien"], correct: 1 },
                    { q: "Prasasti Yupa merupakan peninggalan dari kerajaan...", options: ["Kutai", "Tarumanagara", "Sriwijaya", "Singasari"], correct: 0 }
                ],
                assessmentBIndo: [
                    { q: "Teks yang menceritakan riwayat hidup seorang tokoh ditulis oleh orang lain disebut...", options: ["Autobiografi", "Biografi", "Novel", "Komik"], correct: 1 },
                    { q: "Hal yang dapat kita teladani dari tokoh pahlawan dalam biografi adalah...", options: ["Kekayaannya", "Semangat Pantang Menyerah", "Gaya Pakaiannya", "Kekuasaannya"], correct: 1 },
                    { q: "Urutan peristiwa dalam teks biografi ditulis berdasarkan...", options: ["Waktu (Kronologis)", "Abjad", "Lokasi Acak", "Keinginan Penulis"], correct: 0 },
                    { q: "Sifat tokoh pahlawan yang rela berkorban demi bangsa disebut...", options: ["Patriotik", "Egois", "Pesimis", "Sombong"], correct: 0 },
                    { q: "Unsur intrinsik cerita yang berisi waktu dan tempat dinamakan...", options: ["Tema", "Latar / Setting", "Alur", "Amanat"], correct: 1 }
                ]
            },
            {
                id: 6,
                semester: 2,
                babNum: "Bab 6",
                title: "Peta & Bentang Alam x Petunjuk Arah & Denah",
                ipasTopic: "Kenampakan Alam & Peta Wilayah",
                bindoTopic: "Membaca Denah & Menyampaikan Petunjuk Arah",
                icon: "fa-map-location-dot",
                color: "emerald",
                materialText: `
                    <p><span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Kenampakan Alam', 'Bentuk muka bumi alami seperti gunung, sungai, dan pantai.', 'Gunung dan laut adalah bentang alam.')">Bentang alam</span> Nusantara terdiri dari pegunungan, dataran tinggi, dataran rendah, dan perairan.</p>
                    <p>Membaca <span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Denah', 'Gambar petunjuk lokasi suatu tempat secara sederhana.', 'Denah lokasi berada di kartu undangan.')">denah</span> memerlukan pemahaman arah mata angin (Utara, Timur, Selatan, Barat) agar dapat menyampaikan petunjuk jalan dengan tepat.</p>
                `,
                videoTitle: "Membaca Peta & Petunjuk Arah",
                checkpointQuiz: {
                    q: "Arah mata angin yang berada di antara Utara dan Timur adalah...",
                    options: ["Barat Daya", "Timur Laut", "Tenggara", "Barat Laut"],
                    correct: 1
                },
                miniGame: {
                    title: "Navigasi Mata Angin",
                    pairs: [
                        { item: "Matahari Terbit", match: "Arah Timur" },
                        { item: "Matahari Terbenam", match: "Arah Barat" },
                        { item: "Jarum Kompas Utama", match: "Arah Utara" }
                    ]
                },
                assessmentIPAS: [
                    { q: "Simbol warna biru pada peta wilayah menunjukkan...", options: ["Pegunungan", "Dataran Tinggi", "Perairan / Laut", "Hutan Legat"], correct: 2 },
                    { q: "Dataran yang cocok untuk lahan pertanian padi adalah...", options: ["Dataran Tinggi", "Dataran Rendah", "Puncak Gunung", "Lembah Terjal"], correct: 1 },
                    { q: "Kumpulan dari beberapa gunung dinamakan...", options: ["Lembah", "Pegunungan", "Tanjung", "Danau"], correct: 1 },
                    { q: "Skala pada peta berfungsi untuk...", options: ["Mempercantik warna", "Membandingkan jarak di peta dengan jarak sebenarnya", "Menghitung jumlah penduduk", "Menentukan harga peta"], correct: 1 },
                    { q: "Wilayah daratan yang menjorok ke laut disebut...", options: ["Teluk", "Tanjung", "Selat", "Sungai"], correct: 1 }
                ],
                assessmentBIndo: [
                    { q: "Gambar sederhana yang menunjukkan tata letak ruangan atau lokasi disebut...", options: ["Denah", "Lukisan", "Komik", "Poster"], correct: 0 },
                    { q: "Arah mata angin utama berjumlah...", options: ["4 Arah", "8 Arah", "12 Arah", "2 Arah"], correct: 1 },
                    { q: "Ketika menghadap ke timur, maka punggung kita menghadap ke arah...", options: ["Utara", "Barat", "Selatan", "Tenggara"], correct: 1 },
                    { q: "Kalimat petunjuk arah harus memuat informasi yang...", options: ["Runtut dan Jelas", "Bebas dan Membingungkan", "Singkat Tanpa Arah", "Panjang Berbelit-belit"], correct: 0 },
                    { q: "Simbol kompas pada denah selalu menunjuk arah...", options: ["Selatan", "Utara", "Barat", "Timur"], correct: 1 }
                ]
            },
            {
                id: 7,
                semester: 2,
                babNum: "Bab 7",
                title: "Bijak Berteknologi x Pesan Singkat & Surat",
                ipasTopic: "Interaksi Sosial & Aturan Digital",
                bindoTopic: "Menulis Surat / Pesan Singkat & Berargumen",
                icon: "fa-mobile-screen-button",
                color: "sky",
                materialText: `
                    <p>Teknologi gawai mempermudah <span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Interaksi Sosial', 'Hubungan timbal balik antar individu maupun kelompok.', 'Berbicara dengan teman adalah bentuk interaksi sosial.')">interaksi sosial</span>. Namun, penggunaannya harus dibatasi agar kita tetap bersosialisasi secara nyata.</p>
                    <p>Dalam menyampaikan tanggapan di media digital, kita harus menyusun kalimat <span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Argumen', 'Alasan yang digunakan untuk memperkuat suatu pendapat.', 'Siswa menyampaikan argumen yang masuk akal.')">argumen</span> yang sopan, menghargai privasi, dan menghindari berita bohong (hoaks).</p>
                `,
                videoTitle: "Etika Digital & Menulis Pesan",
                checkpointQuiz: {
                    q: "Sikap bijak saat menerima informasi yang belum jelas kebenarannya adalah...",
                    options: ["Membagikan langsung", "Mengecek kebenarannya dahulu", "Mengejek pengirim", "Marah-marah"],
                    correct: 1
                },
                miniGame: {
                    title: "Etika Menggunakan Gadget",
                    pairs: [
                        { item: "Membaca Berita", match: "Cek Kebenaran (Saring)" },
                        { item: "Mengirim Pesan", match: "Gunakan Bahasa Santun" },
                        { item: "Waktu Bermain", match: "Batasi Maksimal 1 Jam" }
                    ]
                },
                assessmentIPAS: [
                    { q: "Dampak negatif terlalu lama bermain game di HP adalah...", options: ["Mata lelah dan malas belajar", "Badan tambah sehat", "Nila sekolah naik", "Banyak teman"], correct: 0 },
                    { q: "Aturan atau norma di masyarakat dibuat agar kehidupan menjadi...", options: ["Kacau", "Tertib dan Aman", "Tegang", "Mewah"], correct: 1 },
                    { q: "Contoh interaksi sosial langsung adalah...", options: ["Mengirim Email", "Mengobrol tatap muka di taman", "Melihat video online", "Membaca buku"], correct: 1 },
                    { q: "Sikap saat ada teman menyampaikan pendapat dalam diskusi adalah...", options: ["Mendengarkan dengan menghargai", "Menyela bicara", "Tertawa keras", "Pergi keluar"], correct: 0 },
                    { q: "Informasi bohong yang tersebar di internet dinamakan...", options: ["Fakta", "Hoaks", "Opini Baku", "Kabar Gembira"], correct: 1 }
                ],
                assessmentBIndo: [
                    { q: "Penggunaan kalimat santun dalam pesan singkat bertujuan untuk...", options: ["Menjaga perasaan penerima", "Agar dipuji", "Menambah biaya", "Pamer tulisan"], correct: 0 },
                    { q: "Surat pribadi ditujukan kepada...", options: ["Kepala Sekolah", "Teman atau Keluarga", "Instansi Pemerintah", "Perusahaan"], correct: 1 },
                    { q: "Pendapat yang disertai alasan kuat dinamakan...", options: ["Puisi", "Argumen", "Pantun", "Slogan"], correct: 1 },
                    { q: "Bagian pembuka dalam surat pribadi biasanya berisi...", options: ["Tanyaan Kabar dan Salam", "Daftar Utang", "Pengumuman Lomba", "Kesimpulan Ujian"], correct: 0 },
                    { q: "Kata sapaan yang santun untuk guru adalah...", options: ["Bapak/Ibu", "Kamu", "Bro", "Hei"], correct: 0 }
                ]
            },
            {
                id: 8,
                semester: 2,
                babNum: "Bab 8",
                title: "Kelestarian Bumi x Teks Persuasi & Poster Ajakan",
                ipasTopic: "Pelestarian Lingkungan & Bencana Alam",
                bindoTopic: "Menulis Teks Persuasi & Membuat Poster",
                icon: "fa-earth-americas",
                color: "amber",
                materialText: `
                    <p><span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Erosi', 'Pengikisan tanah oleh air sungai atau hujan.', 'Pohon mencegah erosi tanah.')">Pengikisan tanah</span> dan banjir dapat dicegah dengan menanam pohon kembali (reboisasi).</p>
                    <p>Melalui <span class="text-emerald-600 font-bold cursor-pointer underline decoration-emerald-400" onclick="openGlossary('Teks Persuasi', 'Teks yang berisi ajakan untuk membujuk pembaca melakukan hal positif.', 'Poster persuasi mengajak siswa membuang sampah pada tempatnya.')">teks persuasi</span> dan poster menarik, kita dapat mengajak masyarakat untuk menjaga kebersihan dan kelestarian alam Nusantara.</p>
                `,
                videoTitle: "Aksi Selamatkan Bumi & Poster Persuasi",
                checkpointQuiz: {
                    q: "Apa nama kegiatan penanaman hutan kembali yang gundul?",
                    options: ["Erosi", "Reboisasi", "Irigasi", "Urbanisasi"],
                    correct: 1
                },
                miniGame: {
                    title: "Aksi Pelestarian Lingkungan",
                    pairs: [
                        { item: "Sampah Plastik", match: "Daur Ulang" },
                        { item: "Hutan Gundul", match: "Reboisasi" },
                        { item: "Limbah Pabrik", match: "Pengolahan Air" }
                    ]
                },
                assessmentIPAS: [
                    { q: "Bencana banjir sering disebabkan oleh kebiasaan buruk...", options: ["Membuang sampah ke sungai", "Menanam pohon", "Mendaur ulang plastik", "Membersihkan selokan"], correct: 0 },
                    { q: "Penanaman kembali hutan gundul dinamakan...", options: ["Erosi", "Reboisasi", "Korupsi", "Evakuasi"], correct: 1 },
                    { q: "Berikut yang merupakan sumber energi terbarukan adalah...", options: ["Batu Bara", "Sinar Matahari", "Minyak Bumi", "Gas Alam"], correct: 1 },
                    { q: "Pengikisan pantai akibat gelombang air laut dinamakan...", options: ["Abrasi", "Erosi", "Longsor", "Tsunami"], correct: 0 },
                    { q: "Tindakan yang menunjukkan sikap hemat energi listrik adalah...", options: ["Menyalakan lampu siang hari", "Mematikan TV saat tidak ditonton", "Membiarkan kipas menyala terus", "Menyalakan radio kencang"], correct: 1 }
                ],
                assessmentBIndo: [
                    { q: "Teks persuasi berisi kalimat...", options: ["Ajakan / Himbauan", "Perintah Kasar", "Berita Duka", "Dongeng Khayalan"], correct: 0 },
                    { q: "Kata ajakan yang sering digunakan dalam poster adalah...", options: ["Ayo dan Mari", "Jangan pernah", "Awas", "Kemarin"], correct: 0 },
                    { q: "Poster yang baik harus memiliki gambar yang...", options: ["Sesuai tema dan Menarik", "Sangat Kecil", "Gelap", "Acak-acakan"], correct: 0 },
                    { q: "Slogan 'Jagalah Kebersihan, Kebersihan Sebagian dari Iman' berisi ajakan untuk...", options: ["Gaya hidup bersih", "Membeli barang mahal", "Tidur siang", "Olahraga berat"], correct: 0 },
                    { q: "Tempat yang efektif untuk menempelkan poster persuasi adalah...", options: ["Di dalam lemari", "Tempat umum yang strategis", "Lantai rumah", "Sawah"], correct: 1 }
                ]
            }
        ];
let currentSemester = 1;
let currentChapter = chaptersData[0];
let currentTab = 'material';
let currentAssessmentSubject = 'ipas';
let currentQuizIndex = 0;
let userQuizAnswers = { ipas: [], bindo: [] };
let quizScores = { ipas: 90, bindo: 95 };
let studentName = "Ahmad Rizky";
let totalStars = 12;
let isSpeaking = false;

const mainTabs = { home: 'nbblue', missions: 'nbgreen', achievements: 'nborange', profile: 'nbpurple' };
let currentMain = 'home';
let returnMain = 'missions';

window.onload = function() {
  // renderChaptersGrid();
  updateCertDate();
  switchMain('home');
  const saved = LS.get('jn_session');
  if (saved) startSession(saved, true);
};

const LS = {
  get(k) { try { return localStorage.getItem(k); } catch (e) { return null; } },
  set(k, v) { try { localStorage.setItem(k, v); } catch (e) {} },
  del(k) { try { localStorage.removeItem(k); } catch (e) {} }
};

function getUsers() {
  try { return JSON.parse(LS.get('jn_users') || '{}'); } catch (e) { return {}; }
}


function loginAsGuest() {
  startSession('Tamu', false);
}

function startSession(name, silent) {
  studentName = name;
  document.getElementById('studentNameInput').value = name;
//   document.getElementById('loginView').classList.add('hidden');
  updateCertDisplay();
  switchMain('home');
  if (!silent) showToast(`Selamat datang, ${name}!`, 'success');
}

function logout() {
  LS.del('jn_session');
  stopSpeech();
  document.getElementById('loginName').value = '';
  document.getElementById('loginPin').value = '';
  document.getElementById('loginError').innerText = '';
//   document.getElementById('loginView').classList.remove('hidden');
}

function switchMain(tab) {
  currentMain = tab;
  stopSpeech();
  Object.keys(mainTabs).forEach(t => {
    document.getElementById('view-' + t).classList.toggle('hidden', t !== tab);
    const btn = document.getElementById('mainBtn-' + t);
    const span = btn.querySelector('span');
    if (t === tab) {
      btn.className = "py-2.5 flex flex-col items-center gap-0.5 text-[11px] font-extrabold text-ink";
      span.className = `w-10 h-8 rounded-xl flex items-center justify-center bg-${mainTabs[t]} text-white`;
    } else {
      btn.className = "py-2.5 flex flex-col items-center gap-0.5 text-[11px] font-bold text-ink/40";
      span.className = "w-10 h-8 rounded-xl flex items-center justify-center";
    }
  });
  document.getElementById('chapterDetailView').classList.add('hidden');
  document.getElementById('chapterNav').classList.add('hidden');
  document.getElementById('mainNav').classList.remove('hidden');
  document.getElementById('mainScroll').scrollTop = 0;
  updateStats();
}

function updateStats() {
  const avg = Math.round((quizScores.ipas + quizScores.bindo) / 2);
  const set = (id, v) => { const e = document.getElementById(id); if (e) e.innerText = v; };
  set('totalStarsCount', totalStars);
  set('homeGreeting', studentName + ' 👋');
  set('homeStars', totalStars);
  set('homeMissions', chaptersData.length);
  set('homeAvg', avg);
  set('homeContBab', currentChapter.babNum);
  set('homeContTitle', currentChapter.title);
  set('achStars', totalStars);
  set('achIpas', quizScores.ipas);
  set('achIpasPred', getPredicate(quizScores.ipas));
  set('achBindo', quizScores.bindo);
  set('achBindoPred', getPredicate(quizScores.bindo));
}

function filterSemester(sem) {
  currentSemester = sem;
  const btn1 = document.getElementById('btnSem1');
  const btn2 = document.getElementById('btnSem2');
  const active = "flex-1 py-2.5 nb-pill text-xs bg-nbyellow text-ink";
  const inactive = "flex-1 py-2.5 nb-pill text-xs bg-white/60 text-ink/60";
  if (sem === 1) {
    btn1.className = active; btn2.className = inactive;
    document.getElementById('semesterTitle').innerHTML = '<i class="fa-solid fa-map-location-dot text-nbgreen"></i> Peta Misi Semester 1';
  } else {
    btn2.className = active; btn1.className = inactive;
    document.getElementById('semesterTitle').innerHTML = '<i class="fa-solid fa-map-location-dot text-nbgreen"></i> Peta Misi Semester 2';
  }
  renderChaptersGrid();
}

function renderChaptersGrid() {
  const grid = document.getElementById('chaptersGrid');
  grid.innerHTML = '';
  const filtered = chaptersData.filter(c => c.semester === currentSemester);
  filtered.forEach((ch, i) => {
    const nb = colorMap[ch.color] || 'nbgreen';
    const card = document.createElement('div');
    card.className = `nb-card p-4 space-y-3 cursor-pointer`;
    card.onclick = () => openChapter(ch.id);
    card.innerHTML = `
      <div class="flex justify-between items-center">
        <span class="text-[11px] font-extrabold bg-${nb} text-white nb-pill px-2.5 py-1">${ch.babNum}</span>
        <span class="text-[11px] text-orange-500 font-extrabold flex items-center gap-1"><i class="fa-solid fa-star"></i> 3/3</span>
      </div>
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-2xl bg-${nb}/15 nb-border border-${nb} flex items-center justify-center text-lg text-${nb}">
          <i class="fa-solid ${ch.icon}"></i>
        </div>
        <h4 class="font-display font-bold text-sm leading-snug">${ch.title}</h4>
      </div>
      <div class="text-[11px] text-ink/60 font-semibold space-y-1 bg-white/50 nb-border rounded-xl p-2.5">
        <p><strong class="text-nbgreen">IPAS:</strong> ${ch.ipasTopic}</p>
        <p><strong class="text-nbblue">B.Indo:</strong> ${ch.bindoTopic}</p>
      </div>
      <button class="w-full py-2.5 bg-${nb} text-white nb-btn text-xs flex items-center justify-center gap-2">
        Buka Petualangan <i class="fa-solid fa-arrow-right"></i>
      </button>
    `;
    grid.appendChild(card);
  });
}

function showDashboard() {
  switchMain(returnMain);
}

function openChapter(id) {
  currentChapter = chaptersData.find(c => c.id === id);
  document.getElementById('detailBabBadge').innerText = `${currentChapter.babNum} - Semester ${currentChapter.semester}`;
  document.getElementById('detailBabTitle').innerText = currentChapter.title;
  document.getElementById('materialBody').innerHTML = currentChapter.materialText;
  userQuizAnswers = { ipas: [], bindo: [] };
  switchTab('material');
  returnMain = currentMain;
  Object.keys(mainTabs).forEach(t => document.getElementById('view-' + t).classList.add('hidden'));
  document.getElementById('chapterDetailView').classList.remove('hidden');
  document.getElementById('mainNav').classList.add('hidden');
  document.getElementById('chapterNav').classList.remove('hidden');
  document.getElementById('mainScroll').scrollTop = 0;
  initMiniGame();
  updateCertDisplay();
}

function switchTab(tabName) {
  currentTab = tabName;
  stopSpeech();
  document.getElementById('mainScroll').scrollTop = 0;
  const tabs = { material: 'nbgreen', video: 'nbred', game: 'nbpurple', assessment: 'nborange', certificate: 'nbyellow' };
  Object.keys(tabs).forEach(t => {
    const btn = document.getElementById(`tabBtn-${t}`);
    const content = document.getElementById(`tab-${t}`);
    const iconSpan = btn.querySelector('span');
    if (t === tabName) {
      btn.className = "py-2.5 flex flex-col items-center gap-0.5 text-[10px] font-extrabold text-ink";
      iconSpan.className = `w-8 h-8 rounded-xl flex items-center justify-center bg-${tabs[t]} text-white`;
      content.classList.remove('hidden');
    } else {
      btn.className = "py-2.5 flex flex-col items-center gap-0.5 text-[10px] font-bold text-ink/40";
      iconSpan.className = "w-8 h-8 rounded-xl flex items-center justify-center";
      content.classList.add('hidden');
    }
  });
  if (tabName === 'assessment') { switchAssessmentSubTab('ipas'); }
  else if (tabName === 'certificate') { updateCertDisplay(); }
}

function toggleAudioSpeech() {
  if (isSpeaking) { stopSpeech(); } else { startSpeech(); }
}

function startSpeech() {
  if ('speechSynthesis' in window) {
    const text = document.getElementById('materialBody').innerText;
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'id-ID';
    utterance.rate = 0.9;
    utterance.onend = () => {
      isSpeaking = false;
      document.getElementById('speechTextBtn').innerText = "Dengarkan";
    };
    window.speechSynthesis.speak(utterance);
    isSpeaking = true;
    document.getElementById('speechTextBtn').innerText = "Berhenti";
    showToast("Memulai narasi suara", "info");
  } else {
    showToast("Browser tidak mendukung fitur suara.", "warning");
  }
}

function stopSpeech() {
  if ('speechSynthesis' in window) {
    window.speechSynthesis.cancel();
    isSpeaking = false;
    const btnText = document.getElementById('speechTextBtn');
    if (btnText) btnText.innerText = "Dengarkan";
  }
}

function openGlossary(word, def, example) {
  document.getElementById('glossaryWord').innerText = word;
  document.getElementById('glossaryDef').innerText = def;
  document.getElementById('glossarySentence').innerText = `"${example}"`;
  document.getElementById('glossaryModal').classList.remove('hidden');
}

function closeGlossary() {
  document.getElementById('glossaryModal').classList.add('hidden');
}

let videoProgress = 0;
let videoTimerInterval = null;

function playSimulatedVideo() {
  const btn = document.getElementById('btnPlayVideo');
  if (videoTimerInterval) {
    clearInterval(videoTimerInterval);
    videoTimerInterval = null;
    btn.innerHTML = '<i class="fa-solid fa-play"></i>';
    return;
  }
  btn.innerHTML = '<i class="fa-solid fa-pause"></i>';
  document.getElementById('videoCheckpointOverlay').classList.add('hidden');
  videoTimerInterval = setInterval(() => {
    videoProgress += 2;
    document.getElementById('videoProgressBar').style.width = videoProgress + '%';
    const secs = Math.floor((videoProgress / 100) * 210);
    const m = Math.floor(secs / 60).toString().padStart(2, '0');
    const s = (secs % 60).toString().padStart(2, '0');
    document.getElementById('videoTimer').innerText = `${m}:${s} / 03:30`;
    if (videoProgress >= 50 && videoProgress <= 52) {
      clearInterval(videoTimerInterval);
      videoTimerInterval = null;
      btn.innerHTML = '<i class="fa-solid fa-play"></i>';
      triggerCheckpointQuiz();
    }
    if (videoProgress >= 100) {
      clearInterval(videoTimerInterval);
      videoTimerInterval = null;
      videoProgress = 0;
      btn.innerHTML = '<i class="fa-solid fa-rotate-right"></i>';
    }
  }, 300);
}

function triggerCheckpointQuiz() {
  const overlay = document.getElementById('videoCheckpointOverlay');
  const cp = currentChapter.checkpointQuiz;
  document.getElementById('checkpointQuestion').innerText = cp.q;
  const opts = document.getElementById('checkpointOptions');
  opts.innerHTML = '';
  cp.options.forEach((opt, idx) => {
    const b = document.createElement('button');
    b.className = "py-2.5 px-3 bg-white/10 nb-border border-white/30 text-white rounded-xl text-xs font-bold text-left";
    b.innerText = opt;
    b.onclick = () => {
      if (idx === cp.correct) { showToast("Jawaban Tepat! Lanjut ya...", "success"); }
      else { showToast("Kurang tepat, tapi ayo lanjut!", "warning"); }
      overlay.classList.add('hidden');
      playSimulatedVideo();
    };
    opts.appendChild(b);
  });
  overlay.classList.remove('hidden');
}

function seekVideo(e) {
  const bar = e.currentTarget;
  const rect = bar.getBoundingClientRect();
  const clickX = e.clientX - rect.left;
  videoProgress = Math.floor((clickX / rect.width) * 100);
  document.getElementById('videoProgressBar').style.width = videoProgress + '%';
}

let selectedPairItem = null;

function initMiniGame() {
  const mg = currentChapter.miniGame;
  document.getElementById('gameTitle').innerText = mg.title;
  document.getElementById('gameScore').innerText = "0";
  const box = document.getElementById('gameTaskBox');
  box.innerHTML = '';
  const container = document.createElement('div');
  container.className = "grid grid-cols-2 gap-3";
  const leftItems = mg.pairs.map(p => p.item);
  const rightItems = mg.pairs.map(p => p.match).sort(() => Math.random() - 0.5);
  let leftCol = document.createElement('div');
  leftCol.className = "space-y-2";
  leftItems.forEach(item => {
    let btn = document.createElement('button');
    btn.className = "w-full p-2.5 bg-nbblue/20 nb-border border-nbblue rounded-xl text-[11px] font-bold text-left game-item-left";
    btn.innerText = item;
    btn.onclick = () => selectLeftGameItem(btn, item);
    leftCol.appendChild(btn);
  });
  let rightCol = document.createElement('div');
  rightCol.className = "space-y-2";
  rightItems.forEach(match => {
    let btn = document.createElement('button');
    btn.className = "w-full p-2.5 bg-nbpink/20 nb-border border-nbpink rounded-xl text-[11px] font-bold text-left game-item-right";
    btn.innerText = match;
    btn.onclick = () => selectRightGameItem(btn, match);
    rightCol.appendChild(btn);
  });
  container.appendChild(leftCol);
  container.appendChild(rightCol);
  box.appendChild(container);
}

function selectLeftGameItem(btn, item) {
  document.querySelectorAll('.game-item-left').forEach(b => b.classList.remove('!bg-nbyellow', 'ring-2', 'ring-nbyellow'));
  btn.classList.add('!bg-nbyellow', 'ring-2', 'ring-nbyellow');
  selectedPairItem = item;
}

function selectRightGameItem(btn, match) {
  if (!selectedPairItem) {
    showToast("Pilih item di kolom kiri dulu!", "warning");
    return;
  }
  const pairs = currentChapter.miniGame.pairs;
  const correctPair = pairs.find(p => p.item === selectedPairItem);
  if (correctPair && correctPair.match === match) {
    btn.className = "w-full p-2.5 bg-nbgreen text-white nb-border border-nbgreen rounded-xl text-[11px] font-bold text-left";
    const scoreEl = document.getElementById('gameScore');
    scoreEl.innerText = parseInt(scoreEl.innerText) + 35;
    showToast("Pasangan Tepat! +35 Skor", "success");
  } else {
    showToast("Belum pas, coba lagi!", "warning");
  }
  selectedPairItem = null;
}

function switchAssessmentSubTab(subj) {
  currentAssessmentSubject = subj;
  currentQuizIndex = 0;
  const btnIpas = document.getElementById('subTab-ipas');
  const btnBindo = document.getElementById('subTab-bindo');
  const active = "flex-1 px-2 py-2 rounded-xl text-white flex items-center justify-center gap-1";
  const inactive = "flex-1 px-2 py-2 rounded-xl text-ink/60 flex items-center justify-center gap-1";
  if (subj === 'ipas') {
    btnIpas.className = active + " bg-nbgreen";
    btnBindo.className = inactive;
    document.getElementById('quizSubjectLabel').innerText = "Asesmen IPAS";
  } else {
    btnBindo.className = active + " bg-nbblue";
    btnIpas.className = inactive;
    document.getElementById('quizSubjectLabel').innerText = "Asesmen B. Indonesia";
  }
  renderCurrentQuizQuestion();
}

function renderCurrentQuizQuestion() {
  const questions = (currentAssessmentSubject === 'ipas') ? currentChapter.assessmentIPAS : currentChapter.assessmentBIndo;
  const q = questions[currentQuizIndex];
  document.getElementById('quizProgressNum').innerText = `Soal ${currentQuizIndex + 1} dari ${questions.length}`;
  document.getElementById('quizProgressBar').style.width = `${((currentQuizIndex + 1) / questions.length) * 100}%`;
  document.getElementById('quizQuestionText').innerText = `${currentQuizIndex + 1}. ${q.q}`;
  const container = document.getElementById('quizOptionsContainer');
  container.innerHTML = '';
  q.options.forEach((opt, idx) => {
    const b = document.createElement('button');
    const answered = userQuizAnswers[currentAssessmentSubject][currentQuizIndex];
    const base = "w-full p-3 nb-border rounded-xl text-xs font-bold text-left flex items-center gap-2.5";
    b.className = (answered === idx) ? base + " bg-nbblue/10 !border-nbblue" : base + " bg-white/70";
    b.innerHTML = `<span class="w-6 h-6 shrink-0 bg-nbblue text-white rounded-full flex items-center justify-center text-[11px]">${String.fromCharCode(65 + idx)}</span><span>${opt}</span>`;
    b.onclick = () => {
      userQuizAnswers[currentAssessmentSubject][currentQuizIndex] = idx;
      renderCurrentQuizQuestion();
    };
    container.appendChild(b);
  });
  const btnNext = document.getElementById('btnNextQuestion');
  if (currentQuizIndex === questions.length - 1) {
    btnNext.innerHTML = 'Selesai! <i class="fa-solid fa-check ml-1"></i>';
  } else {
    btnNext.innerHTML = 'Lanjut <i class="fa-solid fa-arrow-right ml-1"></i>';
  }
}

function nextQuestion() {
  const questions = (currentAssessmentSubject === 'ipas') ? currentChapter.assessmentIPAS : currentChapter.assessmentBIndo;
  if (userQuizAnswers[currentAssessmentSubject][currentQuizIndex] === undefined) {
    showToast("Pilih salah satu jawaban dulu!", "warning");
    return;
  }
  if (currentQuizIndex < questions.length - 1) {
    currentQuizIndex++;
    renderCurrentQuizQuestion();
  } else {
    calculateSubjectScore();
  }
}

function calculateSubjectScore() {
  const questions = (currentAssessmentSubject === 'ipas') ? currentChapter.assessmentIPAS : currentChapter.assessmentBIndo;
  let correctCount = 0;
  questions.forEach((q, idx) => {
    if (userQuizAnswers[currentAssessmentSubject][idx] === q.correct) correctCount++;
  });
  const finalScore = Math.round((correctCount / questions.length) * 100);
  quizScores[currentAssessmentSubject] = finalScore;
  showToast(`Asesmen Selesai! Skor: ${finalScore}/100`, "success");
  totalStars += 3;
  updateStats();
  switchTab('certificate');
}

function updateCertDisplay() {
  document.getElementById('certStudentName').innerText = studentName;
  document.getElementById('certChapterTitle').innerText = `${currentChapter.babNum}: ${currentChapter.title}`;
  document.getElementById('certIpasScore').innerText = `${quizScores.ipas}/100`;
  document.getElementById('certIpasPred').innerText = getPredicate(quizScores.ipas);
  document.getElementById('certBindoScore').innerText = `${quizScores.bindo}/100`;
  document.getElementById('certBindoPred').innerText = getPredicate(quizScores.bindo);
}

function getPredicate(score) {
  if (score >= 90) return "Sangat Baik";
  if (score >= 75) return "Baik";
  return "Perlu Remedial";
}

function updateStudentName(val) {
  studentName = val || "Ahmad Rizky";
  if (LS.get('jn_session')) LS.set('jn_session', studentName);
  updateCertDisplay();
  updateStats();
  showToast(`Nama diperbarui: ${studentName}`, "info");
}

function updateCertDate() {
  const now = new Date();
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  document.getElementById('certDateText').innerText = `Semarang, ${now.toLocaleDateString('id-ID', options)}`;
}

function shareToWhatsApp() {
  const text = `*LAPORAN PRESTASI JELAJAH NUSA*\n\n` +
    `Nama Siswa: *${studentName}*\n` +
    `Misi: *${currentChapter.babNum} - ${currentChapter.title}*\n\n` +
    `IPAS: *${quizScores.ipas}* (${getPredicate(quizScores.ipas)})\n` +
    `B. Indonesia: *${quizScores.bindo}* (${getPredicate(quizScores.bindo)})\n\n` +
    `_Piagam telah terbit di aplikasi Jelajah Nusa!_`;
  const waUrl = `https://wa.me/?text=${encodeURIComponent(text)}`;
  window.open(waUrl, '_blank');
}
</script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
