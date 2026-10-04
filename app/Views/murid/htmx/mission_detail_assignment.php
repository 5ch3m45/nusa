<?php if (empty($assignments)): ?>
  <div class="text-center text-ink/40 text-sm py-8">
    <i class="fa-solid fa-clipboard-list text-3xl mb-2"></i>
    <p>Belum ada tugas untuk materi ini.</p>
  </div>
<?php else: ?>
  <div class="space-y-3">
    <?php foreach ($assignments as $assignment): ?>
      <div class="bg-white/50 nb-border rounded-xl p-3 space-y-1.5">
        <div class="flex justify-between items-center gap-2">
          <h5 class="font-bold text-sm leading-snug"><?= esc($assignment['title']) ?></h5>
          <?php if (!empty($assignment['due_date'])): ?>
            <span class="text-[10px] font-bold text-ink/50 shrink-0"><i class="fa-regular fa-calendar mr-1"></i><?= esc(date('d M Y', strtotime((string) $assignment['due_date']))) ?></span>
          <?php endif; ?>
        </div>
        <p class="text-[11px] text-ink/50 font-semibold"><?= esc($assignment['subject'] ?? '') ?> &bull; Kelas <?= esc($assignment['class'] ?? '') ?> &bull; Semester <?= esc($assignment['semester'] ?? '') ?></p>
        <?php if (!empty($assignment['description'])): ?>
          <p class="text-[11px] text-ink/60 leading-relaxed"><?= esc($assignment['description']) ?></p>
        <?php endif; ?>

        <?php $sub = $submissions[$assignment['id']] ?? null; ?>
        <?php $isQuiz = ($assignment['type'] ?? 'upload') === 'quiz'; ?>

        <?php if ($isQuiz): ?>
          <?php $questions = $quizQuestions[$assignment['id']] ?? []; ?>
          <?php if ($sub && $sub['score'] !== null): ?>
            <div class="mt-1 p-2.5 bg-nbgreen/10 rounded-xl">
              <p class="text-[11px] font-bold text-nbgreen"><i class="fa-solid fa-star mr-1"></i>Nilai: <?= esc($sub['score']) ?></p>
              <p class="text-[11px] text-ink/60 italic mt-0.5">"<?= esc($sub['feedback'] ?? '') ?>"</p>
            </div>
            <a href="/murid/sertifikat/<?= $sub['id'] ?>" target="_blank" class="block w-full py-2.5 mt-1 bg-nbyellow text-ink rounded-xl text-[11px] font-bold text-center nb-btn">
              <i class="fa-solid fa-award mr-1"></i> Unduh Piagam
            </a>
          <?php elseif (!empty($questions)): ?>
            <form action="/murid/assignments/<?= $assignment['id'] ?>/quiz" method="post" class="space-y-3 pt-2">
              <?php foreach ($questions as $i => $q): ?>
                <div class="nb-border rounded-xl p-3 space-y-2">
                  <p class="text-[11px] font-bold text-ink"><?= ($i + 1) ?>. <?= esc($q['question']) ?></p>
                  <?php foreach (['a' => 'option_a', 'b' => 'option_b', 'c' => 'option_c', 'd' => 'option_d'] as $key => $opt): ?>
                    <label class="flex items-center gap-2 text-[11px] text-ink/70 cursor-pointer">
                      <input type="radio" name="answers[<?= $q['id'] ?>]" value="<?= $key ?>" required class="accent-nbblue">
                      <span><?= strtoupper($key) ?>. <?= esc($q[$opt]) ?></span>
                    </label>
                  <?php endforeach; ?>
                </div>
              <?php endforeach; ?>
              <button type="submit" class="w-full py-2.5 bg-nbblue text-white rounded-xl text-[11px] font-bold nb-btn">
                Kumpulkan Jawaban
              </button>
            </form>
          <?php else: ?>
            <p class="text-[11px] text-ink/40">Belum ada soal untuk tugas ini.</p>
          <?php endif; ?>
        <?php else: ?>
        <?php if ($sub): ?>
          <p class="text-[11px] text-nbgreen font-semibold"><i class="fa-solid fa-circle-check mr-1"></i>Sudah dikumpulkan: <a href="/<?= esc($sub['file_path']) ?>" target="_blank" class="underline"><?= esc($sub['original_name']) ?></a></p>
          <?php if ($sub['score'] !== null): ?>
            <div class="mt-1 p-2.5 bg-nbgreen/10 rounded-xl">
              <p class="text-[11px] font-bold text-nbgreen"><i class="fa-solid fa-star mr-1"></i>Nilai: <?= esc($sub['score']) ?></p>
              <?php if (!empty($sub['feedback'])): ?>
                <p class="text-[11px] text-ink/60 italic mt-0.5">"<?= esc($sub['feedback']) ?>"</p>
              <?php endif; ?>
            </div>
            <a href="/murid/sertifikat/<?= $sub['id'] ?>" target="_blank" class="block w-full py-2.5 mt-1 bg-nbyellow text-ink rounded-xl text-[11px] font-bold text-center nb-btn">
              <i class="fa-solid fa-award mr-1"></i> Unduh Piagam
            </a>
          <?php else: ?>
            <p class="text-[11px] text-ink/40">Menunggu penilaian guru.</p>
          <?php endif; ?>
        <?php endif; ?>

        <form action="/murid/assignments/<?= $assignment['id'] ?>/submit" method="post" enctype="multipart/form-data" class="space-y-2 pt-1">
          <input type="file" name="file" required class="w-full text-[11px] text-ink/60 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-nbblue/10 file:text-nbblue file:font-bold file:text-[11px]">
          <input type="text" name="note" placeholder="Catatan (opsional)" class="w-full bg-white/50 nb-border rounded-xl px-3 py-2 text-[11px] focus:outline-none focus:border-nbblue">
          <button type="submit" class="w-full py-2.5 bg-nbblue text-white rounded-xl text-[11px] font-bold nb-btn">
            <?= $sub ? 'Ganti File Tugas' : 'Upload Tugas' ?>
          </button>
        </form>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
