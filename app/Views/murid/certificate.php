<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Piagam Penghargaan Siswa</title>
<style>
  @page { size: A4 landscape; margin: 0; }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { background: #ffffff; font-family: DejaVu Serif, Georgia, serif; color: #263238; }

  .certificate { position: relative; width: 294mm; height: 207mm; overflow: hidden; background-color: #fffdf7; border: 2px solid #c6a24b; }
  .outer-border { position: absolute; top: 6mm; left: 6mm; right: 6mm; bottom: 6mm; border: 1px solid #d8b866; }

  .corner { position: absolute; width: 30mm; height: 30mm; color: #c6a24b; border-color: #c6a24b; border-style: solid; }
  .tl { top: 9mm; left: 9mm; border-width: 3px 0 0 3px; }
  .tr { top: 9mm; right: 9mm; border-width: 3px 3px 0 0; }
  .bl { bottom: 9mm; left: 9mm; border-width: 0 0 3px 3px; }
  .br { bottom: 9mm; right: 9mm; border-width: 0 3px 3px 0; }

  .certificate-no { position: absolute; top: 12mm; right: 16mm; font-family: DejaVu Sans, Arial, sans-serif; font-size: 8pt; color: #8a8a8a; }

  .content { position: absolute; top: 14mm; left: 20mm; right: 20mm; bottom: 12mm; text-align: center; }

  .school { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12pt; font-weight: bold; letter-spacing: 3px; text-transform: uppercase; color: #876b22; }
  .title { margin-top: 2mm; font-size: 28pt; letter-spacing: 4px; color: #183b56; font-weight: bold; }
  .subtitle { margin-top: 1mm; font-family: DejaVu Sans, Arial, sans-serif; font-size: 10pt; letter-spacing: 2px; color: #6d7478; }

  .ornament { color: #c6a24b; font-size: 14pt; letter-spacing: 6px; margin: 3mm 0; font-family: DejaVu Sans, Arial, sans-serif; }

  .recipient-label { font-family: DejaVu Sans, Arial, sans-serif; font-size: 10pt; color: #777; }
  .student-name { font-size: 26pt; font-weight: bold; color: #183b56; border-bottom: 2px solid #c6a24b; padding: 1mm 20mm 2mm; margin-top: 2mm; display: inline-block; }

  .statement { max-width: 170mm; margin: 3mm auto 0; font-family: DejaVu Sans, Arial, sans-serif; font-size: 11pt; line-height: 1.5; color: #4e575c; }
  .task { font-family: DejaVu Serif, Georgia, serif; font-size: 17pt; font-weight: bold; color: #8b6b20; margin: 2mm 0; }

  .score-box { margin-top: 4mm; display: inline-block; padding: 2mm 10mm; border: 1px solid #d8b866; background-color: #fbf6e9; }
  .score-label { font-family: DejaVu Sans, Arial, sans-serif; font-size: 9pt; text-transform: uppercase; letter-spacing: 2px; color: #777; }
  .score { font-family: DejaVu Sans, Arial, sans-serif; font-size: 22pt; font-weight: bold; color: #183b56; margin-left: 6mm; }

  .footer { position: absolute; bottom: 0; left: 0; right: 0; font-family: DejaVu Sans, Arial, sans-serif; font-size: 9pt; color: #626a6e; }
  .footer table { width: 100%; }
  .footer td { vertical-align: bottom; font-size: 9pt; color: #626a6e; }
  .signature { width: 55mm; text-align: center; }
  .signature-line { border-bottom: 1px solid #777; height: 12mm; margin-bottom: 1.5mm; }
</style>
</head>
<body>
<div class="certificate">
  <div class="outer-border"></div>
  <div class="corner tl"></div>
  <div class="corner tr"></div>
  <div class="corner bl"></div>
  <div class="corner br"></div>
  <div class="certificate-no">No. <?= str_pad((string) $submission['id'], 3, '0', STR_PAD_LEFT) ?>/SISWA/<?= date('m/Y') ?></div>

  <div class="content">
    <div class="school">NUSA LEARNING</div>
    <div class="title">PIAGAM PENGHARGAAN</div>
    <div class="subtitle">APRESIASI PRESTASI BELAJAR SISWA</div>

    <div class="ornament">&#9670; &mdash;&mdash;&mdash; &#9670;</div>

    <div class="recipient-label">Diberikan kepada</div>
    <div class="student-name"><?= esc($submission['student_name']) ?></div>

    <div class="statement">
      Sebagai bentuk penghargaan atas keberhasilan menyelesaikan tugas<br>
      <span class="task"><?= esc($submission['assignment_title']) ?></span><br>
      <?php if (!empty($submission['book_title'])): ?>Buku: <?= esc($submission['book_title']) ?><?php endif; ?>
      <?php if (!empty($submission['material_title'])): ?> &bull; Materi: <?= esc($submission['material_title']) ?><?php endif; ?><br>
      Kelas <?= esc($submission['assignment_class'] ?? $submission['student_class']) ?>
      dengan hasil yang sangat baik.
    </div>

    <div class="score-box">
      <span class="score-label">Nilai</span>
      <span class="score"><?= esc($submission['score']) ?></span>
    </div>

    <div class="ornament">&#9670; &mdash;&mdash;&mdash; &#9670;</div>

    <?php if (!empty($submission['guru_name'])): ?>
      <br/>
      <br/>
      <p style="font-family: DejaVu Sans, Arial, sans-serif; font-size: 10pt; color: #4e575c;">
        Diberikan sebagai apresiasi atas kerja keras dan pencapaian siswa.<br><br/>
        <?= date('d F Y', strtotime($submission['graded_at'] ?? $submission['updated_at'] ?? 'now')) ?><br>
        <strong style="text-decoration: underline;"><?= esc($submission['guru_name']) ?></strong> <br>
        Guru Pengampu
      </p>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
