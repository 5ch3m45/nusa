<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Login - LENTERA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            ink: '#2D3348', cream: '#F4F7FF', nbyellow: '#FFCF48',
            nborange: '#FF9F5A', nbred: '#FF6B7A', nbgreen: '#34C98E',
            nbblue: '#4DABF7', nbpurple: '#9F8CFB', nbpink: '#F783AC',
            nbscarlet: '#ff2400', nbtruered: '#ff0000',
          },
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'sans-serif'],
            display: ['Bricolage Grotesque', 'system-ui', 'sans-serif']
          },
          boxShadow: {
            nb: 'none',
            nbsm: 'none',
            nblg: 'none'
          }
        }
      }
    }
  </script>
  <style>
    .nb-border{ border:1.5px solid rgba(45,51,72,.10); }
    .nb-btn{ border-radius:1rem; font-weight:400; transition:transform .1s ease; }
    .nb-btn:active{ transform:scale(.97); }
  </style>
</head>
<body class="font-sans text-ink min-h-screen bg-gradient-to-b from-[#EAF2FF] via-[#F4F0FF] to-[#FFF1F6] flex items-center justify-center p-4">
  <div class="w-full max-w-md">
    <div class="text-center mb-6">
      <img src="/logo.png" alt="Lentera" class="w-16 h-16 mx-auto rounded-2xl shadow-nb mb-3">
      <h1 class="font-display text-2xl font-bold">LENTERA</h1>
      <p class="text-xs text-ink/60 font-semibold">Masuk untuk mulai petualangan</p>
    </div>

    <div class="bg-white/70 backdrop-blur-xl rounded-3xl p-6 shadow-nblg">
      <?php if (session()->getFlashdata('errors')): ?>
        <div class="mb-4 p-3 bg-nbred/10 border border-nbred/30 rounded-xl text-xs font-bold text-nbred">
          <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <p><?= $error ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('error')): ?>
        <div class="mb-4 p-3 bg-nbred/10 border border-nbred/30 rounded-xl text-xs font-bold text-nbred">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-4 p-3 bg-nbgreen/10 border border-nbgreen/30 rounded-xl text-xs font-bold text-nbgreen">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <form action="/login" method="post" class="space-y-4">
        <div>
          <label class="text-xs font-extrabold text-ink/60 block mb-1">Email</label>
          <input type="email" name="email" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue" placeholder="email@example.com">
        </div>
        <div>
          <label class="text-xs font-extrabold text-ink/60 block mb-1">Password</label>
          <input type="password" name="password" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue" placeholder="Password">
        </div>
        <button type="submit" class="w-full py-3 bg-nbscarlet text-white nb-btn text-sm font-bold">
          Masuk <i class="fa-solid fa-arrow-right ml-1"></i>
        </button>
      </form>

      <p class="text-center text-xs text-ink/50 mt-4">
        Belum punya akun? <a href="/signup" class="text-nbblue font-bold">Daftar di sini</a>
      </p>
    </div>
  </div>
</body>
</html>
