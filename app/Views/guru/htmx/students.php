<div class="mt-4 mb-4">
  <h2 class="font-display text-xl font-bold">Data Murid</h2>
  <p class="text-sm text-ink/60">Kelola data murid Anda</p>
</div>

<!-- Search & Filter -->
<div class="space-y-3 mb-4">
  <form action="/guru/murid" method="get" class="flex gap-2">
    <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Cari nama, username, atau kelas..." class="flex-1 bg-white/50 nb-border rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-nbblue">
    <button type="submit" class="px-4 py-2.5 bg-nbblue text-white rounded-xl text-sm font-bold nb-btn shrink-0">
      <i class="fa-solid fa-search"></i>
    </button>
  </form>
  <div class="flex gap-2 overflow-x-auto pb-1">
    <a href="/guru/murid" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= empty($class) ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>">Semua</a>
    <?php foreach ($classes as $c): ?>
      <a href="/guru/murid?class=<?= urlencode($c) ?>" class="px-3 py-1.5 rounded-full text-xs font-bold whitespace-nowrap <?= ($class ?? '') === $c ? 'bg-ink text-white' : 'bg-white/50 text-ink/60 nb-border' ?>"><?= esc($c) ?></a>
    <?php endforeach; ?>
  </div>
</div>

<!-- Student List -->
<div class="space-y-3">
  <?php if (empty($students)): ?>
    <div class="nb-card p-8 text-center text-ink/40 text-sm">
      <i class="fa-solid fa-users text-3xl mb-2"></i>
      <p>Tidak ada murid ditemukan.</p>
    </div>
  <?php else: ?>
    <?php foreach ($students as $s): ?>
      <div class="nb-card p-4">
        <div class="flex items-start gap-3">
          <div class="w-11 h-11 bg-nbblue/15 rounded-xl flex items-center justify-center text-nbblue font-bold text-sm shrink-0">
            <?= strtoupper(substr($s['name'], 0, 1)) ?>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-bold truncate"><?= esc($s['name']) ?></p>
            <?php if (!empty($s['username'])): ?>
              <p class="text-[11px] text-ink/50"><i class="fa-solid fa-at mr-1"></i><?= esc($s['username']) ?></p>
            <?php endif; ?>
            <p class="text-[11px] text-ink/50">Kelas <?= esc($s['class']) ?></p>
            <?php if ($s['phone']): ?>
              <p class="text-[11px] text-ink/50"><i class="fa-solid fa-phone mr-1"></i><?= esc($s['phone']) ?></p>
            <?php endif; ?>
            <?php if ($s['parent_name']): ?>
              <p class="text-[11px] text-ink/50"><i class="fa-solid fa-user mr-1"></i><?= esc($s['parent_name']) ?></p>
            <?php endif; ?>
          </div>
          <div class="flex gap-2 shrink-0">
            <button onclick='editStudent(<?= json_encode($s) ?>)' class="w-9 h-9 bg-nbblue/10 text-nbblue rounded-xl flex items-center justify-center active:bg-nbblue active:text-white transition" title="Edit">
              <i class="fa-solid fa-pen text-xs"></i>
            </button>
            <button onclick="resetPassword(<?= $s['id'] ?>)" class="w-9 h-9 bg-nbyellow/10 text-nborange rounded-xl flex items-center justify-center active:bg-nbyellow active:text-white transition" title="Reset Password">
              <i class="fa-solid fa-key text-xs"></i>
            </button>
            <a href="/guru/murid/delete/<?= $s['id'] ?>" onclick="return confirm('Hapus murid ini?')" class="w-9 h-9 bg-nbred/10 text-nbred rounded-xl flex items-center justify-center active:bg-nbred active:text-white transition" title="Hapus">
              <i class="fa-solid fa-trash text-xs"></i>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<!-- FAB -->
<button onclick="document.getElementById('addModal').classList.remove('hidden')" class="fixed right-4 w-14 h-14 bg-nbgreen text-white rounded-2xl shadow-nblg flex items-center justify-center text-xl z-30 active:scale-90 transition" style="bottom: calc(env(safe-area-inset-bottom, 0px) + 6rem);">
  <i class="fa-solid fa-user-plus"></i>
</button>

<!-- Add Modal (Full Screen) -->
<div id="addModal" class="hidden fixed inset-0 z-50 bg-white">
  <div class="flex items-center justify-between p-4 border-b border-ink/10" style="padding-top: calc(env(safe-area-inset-top, 0px) + 1rem);">
    <h3 class="font-display text-lg font-bold">Tambah Murid</h3>
    <button onclick="document.getElementById('addModal').classList.add('hidden')" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>
  <form action="/guru/murid" method="post" class="p-4 space-y-4">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Username</label>
      <input type="text" name="username" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue" placeholder="Username untuk login">
      <p class="text-[10px] text-ink/40 mt-1">Password default: 123456</p>
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Nama Lengkap</label>
      <input type="text" name="name" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Kelas</label>
      <input type="text" name="class" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue" placeholder="contoh: 4A">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Nomor HP</label>
      <input type="text" name="phone" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Nama Orang Tua</label>
      <input type="text" name="parent_name" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Alamat</label>
      <textarea name="address" rows="3" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"></textarea>
    </div>
    <button type="submit" class="w-full py-3.5 bg-nbgreen text-white rounded-xl text-sm font-bold nb-btn">
      Simpan Murid
    </button>
  </form>
</div>

<!-- Edit Modal (Full Screen) -->
<div id="editModal" class="hidden fixed inset-0 z-50 bg-white">
  <div class="flex items-center justify-between p-4 border-b border-ink/10" style="padding-top: calc(env(safe-area-inset-top, 0px) + 1rem);">
    <h3 class="font-display text-lg font-bold">Edit Murid</h3>
    <button onclick="document.getElementById('editModal').classList.add('hidden')" class="w-9 h-9 bg-ink/10 rounded-xl flex items-center justify-center">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>
  <form id="editForm" method="post" class="p-4 space-y-4">
    <input type="hidden" name="id" id="edit_id">
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Username</label>
      <input type="text" name="username" id="edit_username" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue" placeholder="Username untuk login">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Nama Lengkap</label>
      <input type="text" name="name" id="edit_name" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Kelas</label>
      <input type="text" name="class" id="edit_class" required class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Nomor HP</label>
      <input type="text" name="phone" id="edit_phone" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Nama Orang Tua</label>
      <input type="text" name="parent_name" id="edit_parent_name" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue">
    </div>
    <div>
      <label class="text-xs font-bold text-ink/60 block mb-1">Alamat</label>
      <textarea name="address" id="edit_address" rows="3" class="w-full bg-white/50 nb-border rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-nbblue"></textarea>
    </div>
    <button type="submit" class="w-full py-3.5 bg-nbblue text-white rounded-xl text-sm font-bold nb-btn">
      Simpan Perubahan
    </button>
  </form>
</div>

<script>
function editStudent(s) {
  document.getElementById('editForm').action = '/guru/murid/update/' + s.id;
  document.getElementById('edit_id').value = s.id;
  document.getElementById('edit_username').value = s.username || '';
  document.getElementById('edit_name').value = s.name;
  document.getElementById('edit_class').value = s.class;
  document.getElementById('edit_phone').value = s.phone;
  document.getElementById('edit_parent_name').value = s.parent_name;
  document.getElementById('edit_address').value = s.address;
  document.getElementById('editModal').classList.remove('hidden');
}

function resetPassword(id) {
  if (confirm('Reset password murid ini menjadi 123456?')) {
    window.location.href = '/guru/murid/reset-password/' + id;
  }
}
</script>