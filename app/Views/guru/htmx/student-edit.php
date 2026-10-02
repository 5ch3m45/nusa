<div class="mt-4 mb-4 flex items-center gap-3">
  <button hx-get="/guru/murid" hx-push-url="/guru/murid" hx-swap="innerHTML show:top" hx-target="#guru-content" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
    <i class="fa-solid fa-arrow-left"></i>
  </button>
  <div>
    <h2 class="font-display text-xl font-bold">Edit Murid</h2>
    <p class="text-sm text-ink/60">Perbarui data murid</p>
  </div>
</div>

<form action="/guru/murid/update/<?= $student['id'] ?>" method="post" class="nb-card p-4 space-y-4">
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Username</label>
    <input type="text" name="username" value="<?= esc($student['username']) ?>" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue" placeholder="Username untuk login">
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Nama Lengkap</label>
    <input type="text" name="name" value="<?= esc($student['name']) ?>" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Kelas</label>
    <input type="text" name="class" value="<?= esc($student['class']) ?>" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Nomor HP</label>
    <input type="text" name="phone" value="<?= esc($student['phone']) ?>" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Nama Orang Tua</label>
    <input type="text" name="parent_name" value="<?= esc($student['parent_name']) ?>" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
  </div>
  <div>
    <label class="text-xs font-bold text-ink/60 block mb-1">Alamat</label>
    <textarea name="address" rows="3" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"><?= esc($student['address']) ?></textarea>
  </div>
  <button type="submit" class="w-full py-3.5 bg-nbblue text-white rounded-xl text-sm font-bold nb-btn">
    Simpan Perubahan
  </button>
</form>
