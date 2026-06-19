<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body { font-family: DejaVu Sans, sans-serif; background:#fff; color:#1e293b; font-size:13px; }
  .page { width:100%; max-width:600px; margin:0 auto; padding:32px; background:#fff; }

  /* ── HEADER ── */
  .header {
    background: linear-gradient(135deg, #064E3B 0%, #065F46 60%, #047857 100%);
    border-radius:14px; padding:22px 24px; margin-bottom:20px;
  }
  .header-inner { display:table; width:100%; border-collapse:collapse; }
  .header-logo { display:table-cell; width:60px; vertical-align:middle; }
  .header-info { display:table-cell; vertical-align:middle; padding-left:14px; }

  .logo-circle {
    width:54px; height:54px; line-height:54px;
    border-radius:27px;
    background:rgba(255,255,255,0.15);
    border:2px solid rgba(255,255,255,0.35);
    text-align:center; font-size:22px; font-weight:700; color:#fff;
    overflow:hidden; display:block;
  }
  .logo-circle img { width:100%; height:100%; display:block; }

  .assoc-name { font-size:17px; font-weight:700; color:#fff; margin-bottom:4px; }
  .assoc-contact { font-size:11px; color:rgba(255,255,255,0.72); margin-bottom:2px; }

  /* ── PASS TITLE ── */
  .pass-badge {
    text-align:center; border-radius:12px; padding:18px 24px; margin-bottom:20px;
    background:#E1F5EE; border:1.5px solid #5DCAA5;
  }
  .pass-title { font-size:18px; font-weight:700; color:#085041; letter-spacing:4px; text-transform:uppercase; }
  .pass-sub { font-size:10px; color:#0F6E56; margin-top:4px; letter-spacing:1.5px; text-transform:uppercase; }

  /* ── BENEVOLE CARD ── */
  .benv-card {
  background:#F0FDF4; border:1.5px solid #86EFAC;
  border-radius:12px; padding:20px 24px; margin-bottom:20px;
  text-align: center;
}
  .benv-name { font-size:18px; font-weight:700; color:#064E3B; margin-bottom:5px; }
  .benv-email { font-size:12px; color:#16A34A; margin-bottom:10px; }


  .benv-inner { display:table; width:100%; border-collapse:collapse; }
  .benv-avatar-cell { display:table-cell; width:70px; vertical-align:middle; text-align:center; }
  .benv-info-cell { display:table-cell; vertical-align:middle; padding-left:16px; }

  .benv-avatar {
    width:56px; height:56px; line-height:56px;
    border-radius:28px;
    background: linear-gradient(135deg, #064E3B, #1D9E75);
    border:3px solid #fff;
    text-align:center; font-size:22px; font-weight:700; color:#fff;
    display:block; overflow:hidden;
    box-shadow: 0 4px 12px rgba(6,78,59,0.25);
  }
  .benv-avatar img { width:100%; height:100%; display:block; }

 
  .benv-badge {
    display:inline-block; padding:3px 12px;
    background:#085041; color:#E1F5EE;
    border-radius:20px; font-size:10px; font-weight:700;
    letter-spacing:1px; text-transform:uppercase;
  }
  

  /* ── SECTION ── */
  .section { border:1px solid #E2E8F0; border-radius:12px; margin-bottom:16px; overflow:hidden; }
  .section-header {
    background:#F8FAFC; padding:10px 18px;
    font-size:9px; font-weight:700; text-transform:uppercase;
    letter-spacing:2px; color:#64748B;
    border-bottom:1px solid #E2E8F0;
  }
  .section-body { padding:0 18px; }

  .detail-row { display:table; width:100%; border-collapse:collapse; border-bottom:1px solid #F1F5F9; padding:11px 0; }
  .detail-row:last-child { border-bottom:none; }
  .detail-label { display:table-cell; width:40%; font-size:10px; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:0.5px; vertical-align:middle; }
  .detail-value { display:table-cell; width:60%; font-size:13px; font-weight:600; color:#1E293B; text-align:right; vertical-align:middle; }

  /* ── QR / DIVIDER ── */
  .divider { border:none; border-top:1.5px dashed #CBD5E1; margin:20px 0; }

  /* ── FOOTER ── */
  .footer { text-align:center; }
  .footer-text { font-size:10px; color:#94A3B8; margin-bottom:3px; }
  .valid-stamp {
    display:inline-block; margin-top:14px;
    padding:7px 24px; border:2px solid #5DCAA5;
    border-radius:24px; font-size:11px; font-weight:700;
    color:#085041; letter-spacing:2px; text-transform:uppercase;
  }

  /* ── ID strip ── */
  .id-strip {
    background:#F1F5F9; border-radius:8px;
    padding:8px 14px; margin-top:14px;
    display:table; width:100%; border-collapse:collapse;
  }
  .id-left { display:table-cell; font-size:10px; color:#94A3B8; vertical-align:middle; }
  .id-right { display:table-cell; text-align:right; font-size:10px; font-weight:700; color:#475569; vertical-align:middle; }
</style>
</head>
<body>
<div class="page">

  {{-- ── HEADER ── --}}
  <div class="header">
    <div class="header-inner">
      <div class="header-logo">
        <span class="logo-circle">
          @if(isset($association->logo) && $association->logo)
            <img src="{{ public_path('storage/' . $association->logo) }}" alt="logo"/>
          @else
            {{ strtoupper(substr($association->nom, 0, 1)) }}
          @endif
        </span>
      </div>
      <div class="header-info">
        <div class="assoc-name">{{ $association->nom }}</div>
        @if($association->email)
          <div class="assoc-contact">✉ &nbsp;{{ $association->email }}</div>
        @endif
        @if(isset($association->telephone) && $association->telephone)
          <div class="assoc-contact">☎ &nbsp;{{ $association->telephone }}</div>
        @endif
      </div>
    </div>
  </div>

  {{-- ── PASS TITLE ── --}}
  <div class="pass-badge">
    <div class="pass-title">Pass Bénévolat</div>
    <div class="pass-sub">Document officiel de participation</div>
  </div>
  <div class="benv-card">
  <div class="benv-name">{{ $benevole->nom }}</div>
  <div class="benv-email">{{ $benevole->email }}</div>
  <span class="benv-badge">✓ &nbsp;Bénévole confirmé</span>
</div>

  {{-- ── MISSION DETAILS ── --}}
  <div class="section">
    <div class="section-header">Détails de la mission</div>
    <div class="section-body">
      <div class="detail-row">
        <span class="detail-label">Association</span>
        <span class="detail-value">{{ $association->nom }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Mission</span>
        <span class="detail-value">{{ $mission->titre }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Date</span>
        <span class="detail-value">{{ \Carbon\Carbon::parse($mission->date)->format('d/m/Y') }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Lieu</span>
        <span class="detail-value">{{ $mission->lieu }}</span>
      </div>
      @if(isset($mission->categorie) && $mission->categorie)
      <div class="detail-row">
        <span class="detail-label">Catégorie</span>
        <span class="detail-value">{{ ucfirst($mission->categorie) }}</span>
      </div>
      @endif
    </div>
  </div>

  {{-- ── ID STRIP ── --}}
  <div class="id-strip">
    <span class="id-left">Référence du pass</span>
    <span class="id-right">#PASS-{{ str_pad($candidature->id, 5, '0', STR_PAD_LEFT) }} &nbsp;·&nbsp; {{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
  </div>

  <hr class="divider"/>

  {{-- ── FOOTER ── --}}
  <div class="footer">
    <p class="footer-text">Généré le {{ \Carbon\Carbon::now()->format('d/m/Y à H:i') }}</p>
    <p class="footer-text">Ce document atteste la participation officielle du bénévole à la mission ci-dessus.</p>
    <span class="valid-stamp">✓ &nbsp;Validé</span>
  </div>

</div>
</body>
</html>