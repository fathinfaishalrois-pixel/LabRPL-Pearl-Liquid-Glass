<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LabRPL') · LabRPL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
      :root{--bg:#f3f6fb;--card:#fff;--ink:#17243b;--muted:#75829a;--line:#e5ebf4;--blue:#2563eb;--cyan:#06b6d4;--green:#0f9f78;--amber:#b7791f;--red:#dc4656}
      *{box-sizing:border-box}body{margin:0;background:var(--bg);color:var(--ink);font:14px Inter,system-ui,sans-serif}
      a{color:inherit;text-decoration:none}button,input,select,textarea{font:inherit}.shell{display:flex;min-height:100vh}
      .sidebar{width:245px;background:#101d34;color:#eaf1ff;padding:25px 17px;display:flex;flex-direction:column;gap:26px;flex-shrink:0}
      .brand{display:flex;gap:11px;align-items:center;padding:0 10px}.brandmark{display:grid;place-items:center;width:40px;height:40px;border-radius:13px;background:linear-gradient(135deg,#3b82f6,#06b6d4);font-weight:800;font-size:20px;box-shadow:0 8px 22px #2563eb55}
      .brand strong{display:block;font-size:17px;letter-spacing:-.5px}.brand small{font-size:9px;letter-spacing:1.5px;color:#83e5f1}
      .nav-label{font-size:10px;letter-spacing:1.5px;color:#8090ad;padding:0 12px;margin-bottom:8px}.nav{display:grid;gap:5px}.nav a{display:flex;align-items:center;gap:12px;padding:12px;border-radius:11px;color:#aebbd0;font-weight:500;transition:.2s}.nav a:hover,.nav a.active{color:white;background:linear-gradient(90deg,#2563eb55,#06b6d422);box-shadow:inset 3px 0 #5de0ee}.nav .ico{width:20px;text-align:center;font-size:17px}
      .sidebar-bottom{margin-top:auto;border-top:1px solid #ffffff18;padding:17px 8px 0;display:flex;align-items:center;gap:10px}.avatar{display:grid;place-items:center;background:#dbeafe;color:#1d4ed8;border-radius:50%;width:36px;height:36px;font-weight:700}.sidebar-bottom small{display:block;color:#92a0b8;margin-top:3px;font-size:11px}
      .main{min-width:0;flex:1;padding:28px 34px 45px}.topbar{display:flex;align-items:center;justify-content:space-between;gap:20px;margin-bottom:28px}.eyebrow{font-size:10px;color:#0891b2;letter-spacing:1.5px;font-weight:700;margin-bottom:8px}.topbar h1{margin:0;font-size:27px;letter-spacing:-1px}.sub{color:var(--muted);margin-top:8px;line-height:1.6}.top-actions{display:flex;align-items:center;gap:10px}.profile{background:white;border:1px solid var(--line);padding:9px 13px;border-radius:12px;font-size:12px;font-weight:600}
      .card{background:var(--card);border:1px solid var(--line);border-radius:18px;padding:22px;box-shadow:0 8px 24px #24395b08}.stats{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px;margin-bottom:22px}.stat{position:relative;overflow:hidden}.stat:after{content:"";position:absolute;width:100px;height:100px;border-radius:50%;right:-30px;top:-35px;background:var(--tint,#dbeafe);opacity:.6}.stat-label{color:var(--muted);font-size:12px;font-weight:600}.stat-value{font-size:30px;font-weight:800;letter-spacing:-1px;margin:14px 0 8px}.stat-foot{font-size:11px;color:var(--green);font-weight:600}.section-title{display:flex;justify-content:space-between;align-items:center;gap:15px;margin-bottom:17px}.section-title h2{font-size:16px;margin:0}.section-title p{margin:6px 0 0;color:var(--muted);font-size:12px}
      .btn{display:inline-flex;justify-content:center;align-items:center;gap:7px;border:0;border-radius:10px;padding:11px 15px;background:var(--blue);color:white;font-weight:600;font-size:12px;cursor:pointer;transition:transform .18s,box-shadow .18s}.btn:hover{transform:translateY(-1px);box-shadow:0 7px 18px #2563eb35}.btn.secondary{background:#eef4ff;color:#2457bd}.btn.danger{background:#fff0f1;color:#c53343}.btn.success{background:#e5faf3;color:#087b5c}.btn.small{padding:8px 10px;font-size:11px}.btn.ghost{background:#f3f6fb;color:#4a5b75}
      .toolbar{display:flex;gap:10px;flex-wrap:wrap;align-items:center;margin-bottom:17px}.input,.select,.textarea{width:100%;border:1px solid #dce4f0;background:#fbfcff;border-radius:10px;padding:12px 13px;color:var(--ink);outline:none;transition:.2s}.input:focus,.select:focus,.textarea:focus{border-color:#60a5fa;box-shadow:0 0 0 3px #3b82f61a}.search{max-width:310px}.field{display:grid;gap:8px;margin-bottom:17px}.field label{font-size:12px;font-weight:700;color:#43516a}.hint{font-size:11px;color:var(--muted)}
      .table-wrap{overflow:auto}table{width:100%;border-collapse:collapse;white-space:nowrap}th{text-align:left;font-size:10px;letter-spacing:.8px;color:#8995a9;background:#f7f9fd;padding:13px 12px;font-weight:700}td{padding:15px 12px;border-bottom:1px solid #edf1f7;font-size:12px}tbody tr:hover{background:#fbfdff}.item-main{font-weight:700}.item-sub{font-size:10px;color:var(--muted);margin-top:5px}.badge{display:inline-flex;padding:6px 9px;border-radius:99px;font-size:10px;font-weight:700;background:#eef2f7;color:#65738a}.badge.menunggu{background:#fff5df;color:#a56808}.badge.disetujui,.badge.dikembalikan,.badge.baik{background:#e5f8f1;color:#087b5c}.badge.ditolak,.badge.rusak{background:#fff0f1;color:#c53343}.badge.perlu_perbaikan{background:#fff5df;color:#a56808}
      .alert{padding:13px 15px;border-radius:12px;margin-bottom:18px;font-size:12px}.alert.success{background:#e7faf2;color:#087b5c}.alert.error{background:#fff0f1;color:#c53343}.errors{color:#c53343;font-size:11px;margin-top:5px}.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}.form-grid .field{margin:0}.form-actions{display:flex;gap:10px;justify-content:flex-end;margin-top:22px}.empty{padding:38px;text-align:center;color:var(--muted)}.pagination{margin-top:18px}
      .login-page{min-height:100vh;display:grid;grid-template-columns:1.05fr .95fr;background:linear-gradient(135deg,#f7faff,#edf4ff);overflow:hidden}.login-hero{position:relative;overflow:hidden}.login-hero:after{content:"";position:absolute;width:260px;height:260px;right:-100px;bottom:-110px;border:1px solid #ffffff1c;border-radius:50%;box-shadow:0 0 0 35px #ffffff08,0 0 0 70px #ffffff05;pointer-events:none}.login-card{animation:riseIn .6s cubic-bezier(.2,.75,.25,1) both}.login-hero{background:radial-gradient(circle at 15% 15%,#2f75f866,transparent 38%),linear-gradient(145deg,#101d34,#172d50);color:white;padding:7vw;display:flex;flex-direction:column;justify-content:center}.login-hero h1{font-size:clamp(34px,4vw,55px);line-height:1.1;letter-spacing:-2px;margin:28px 0 18px}.login-hero p{color:#b6c7e2;line-height:1.8;max-width:460px}.login-card-wrap{display:grid;place-items:center;padding:28px}.login-card{width:min(440px,100%);padding:35px;background:white;border:1px solid #e2eafa;border-radius:24px;box-shadow:0 25px 80px #1b37601a}.login-card h2{font-size:26px;margin:8px 0}.login-card .sub{margin-bottom:26px}.login-card .btn{width:100%;padding:14px}.checkline{display:flex;justify-content:space-between;align-items:center;font-size:11px;color:var(--muted);margin:16px 0 20px}.mobile-menu{display:none}
      .auth-switch{margin-top:20px;text-align:center;color:var(--muted);font-size:12px}.auth-switch a{color:var(--blue);font-weight:700}.role-note{line-height:1.6;margin:15px 0 0}.secure-note{margin-top:35px;color:#8fe6f0;font-size:11px;font-weight:700;letter-spacing:1px}.hero-copy{margin-top:70px}.sound-toggle{position:fixed;right:18px;bottom:18px;z-index:50;display:inline-flex;align-items:center;gap:8px;border:1px solid #dbe5f4;border-radius:999px;background:#ffffffed;color:#34445f;padding:10px 14px;font-size:11px;font-weight:700;box-shadow:0 8px 28px #15284a18;cursor:pointer;backdrop-filter:blur(12px);transition:transform .2s,box-shadow .2s}.sound-toggle:hover{transform:translateY(-2px);box-shadow:0 12px 28px #15284a24}.sound-toggle[aria-pressed="true"]{background:#eaf2ff;color:#1d4ed8;border-color:#bfdbfe}
      body{animation:pageIn .45s ease both}.card,.login-card,.stat{animation:riseIn .5s cubic-bezier(.2,.75,.25,1) both}.stat:nth-child(2){animation-delay:.05s}.stat:nth-child(3){animation-delay:.1s}.stat:nth-child(4){animation-delay:.15s}.btn:active{transform:scale(.98)}.alert{animation:riseIn .25s ease both}.brandmark{transition:transform .3s}.brand:hover .brandmark{transform:rotate(-7deg) scale(1.04)}@keyframes pageIn{from{opacity:0}to{opacity:1}}@keyframes riseIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
      @media(max-width:1100px){.sidebar{width:215px}.main{padding:24px}.stats{grid-template-columns:repeat(2,minmax(0,1fr))}.topbar h1{font-size:24px}}
      @media(max-width:760px){.hero-copy{margin-top:35px}.secure-note{margin-top:20px}.shell{display:block}.sidebar{width:100%;padding:14px 16px;gap:12px}.brand{padding:0}.nav-label{display:none}.nav{display:flex;overflow-x:auto}.nav a{white-space:nowrap;padding:10px}.nav .ico{display:none}.sidebar-bottom{display:none}.main{padding:20px 14px 32px}.topbar{align-items:flex-start}.topbar h1{font-size:23px}.top-actions .profile{display:none}.stats{gap:10px}.card{padding:16px;border-radius:15px}.stat-value{font-size:25px}.form-grid{grid-template-columns:1fr}.login-page{grid-template-columns:1fr}.login-hero{padding:28px 25px 34px;min-height:250px}.login-hero h1{font-size:35px;margin:18px 0 10px}.login-hero p{font-size:12px}.login-card-wrap{padding:18px}.login-card{padding:25px}.section-title{align-items:flex-start;flex-direction:column}.search{max-width:none;flex:1}}
      @media(prefers-reduced-motion:reduce){*,*::before,*::after{animation:none!important;transition:none!important;scroll-behavior:auto!important}}

      /* LabRPL glassmorphism system: consistent across every application surface. */
      :root{--bg:#091126;--card:rgba(255,255,255,.075);--ink:#f4f7ff;--muted:#b4c0dc;--line:rgba(255,255,255,.15);--blue:#67e8f9;--cyan:#a78bfa;--green:#6ee7b7;--amber:#fcd34d;--red:#fda4af}
      body{background:radial-gradient(ellipse at 5% 0%,#1e3a6c 0,transparent 34%),radial-gradient(ellipse at 100% 35%,#40205d 0,transparent 30%),linear-gradient(135deg,#080d20,#101832 58%,#0a1d30);color:var(--ink);background-attachment:fixed}
      .sidebar,.card,.stat,.profile,.login-card,.login-hero,.input,.select,.textarea,th,.btn.secondary,.btn.ghost,.alert,.badge,.metric,.toolbar,.pagination,.section-title,.sound-toggle{backdrop-filter:blur(22px);-webkit-backdrop-filter:blur(22px)}
      .sidebar{background:rgba(9,16,39,.64);border-right:1px solid var(--line);box-shadow:12px 0 50px #0002}
      .card,.stat,.login-card{background:rgba(255,255,255,.075);border:1px solid var(--line);box-shadow:0 18px 55px #0002,inset 0 1px #ffffff12}
      .stat:after{opacity:.18;filter:blur(4px)}.profile,.input,.select,.textarea{background:rgba(255,255,255,.07);border-color:var(--line);color:var(--ink)}
      .input::placeholder,.textarea::placeholder{color:#8997b8}select option{background:#111b36;color:#fff}
      .btn{background:linear-gradient(110deg,#67e8f9,#a78bfa);color:#0a1228}.btn.secondary,.btn.ghost{background:rgba(255,255,255,.08);border:1px solid var(--line);color:#e7edff}
      th{background:rgba(255,255,255,.06);color:#b8c6e5}td{border-bottom-color:#ffffff16}tbody tr:hover{background:#ffffff09}
      .badge{background:#ffffff14;color:#dbeafe}.badge.menunggu{background:#fbbf241b;color:#fde68a}.badge.disetujui,.badge.dikembalikan,.badge.baik{background:#34d39920;color:#a7f3d0}.badge.ditolak,.badge.rusak{background:#fb71851f;color:#fecdd3}
      .alert.success{background:#34d3991a;color:#a7f3d0;border:1px solid #34d3993d}.alert.error{background:#fb71851a;color:#fecdd3;border:1px solid #fb71853d}
      .login-page{background:transparent}.login-hero{background:rgba(9,16,39,.44);border-right:1px solid var(--line)}.login-card-wrap{background:transparent}.login-card h2{color:#f5f7ff}.field label{color:#dbe5ff}.hint{color:#aab8d7}.auth-switch{color:#b4c0dc}.auth-switch a{color:#67e8f9}
      .sound-toggle{background:rgba(255,255,255,.1);border-color:var(--line);color:#eaf0ff}.sound-toggle[aria-pressed="true"]{background:#67e8f921;color:#a5f3fc;border-color:#67e8f96b}
      .nav a:hover,.nav a.active{background:linear-gradient(90deg,#67e8f925,#a78bfa1c);box-shadow:inset 3px 0 #67e8f9}.avatar{background:linear-gradient(135deg,#67e8f9,#a78bfa);color:#0b1430}
      .btn:focus-visible,a:focus-visible,input:focus-visible,select:focus-visible,textarea:focus-visible{outline:2px solid #67e8f9;outline-offset:3px}
    
      /* LIQUID CHROME — shared by dashboard, inventory, loans and auth pages */
      :root{--bg:#080b10;--card:rgba(178,192,207,.075);--ink:#f0f3f6;--muted:#aeb8c4;--line:rgba(220,232,244,.18);--blue:#d8e2eb;--cyan:#a8b8c9;--green:#8ee0c1;--amber:#f0d18b;--red:#f0aab5}
      body{background:radial-gradient(ellipse at 8% 0%,#26313e 0,transparent 34%),radial-gradient(ellipse at 100% 45%,#222a35 0,transparent 32%),linear-gradient(135deg,#080b10,#111720 58%,#090d13);color:var(--ink);background-attachment:fixed;overflow-x:hidden}
      #liquid-metal-bg{position:fixed;inset:0;width:100%;height:100%;z-index:0;pointer-events:none;opacity:.7}
      .shell,.login-page,.sound-toggle{position:relative;z-index:1}
      .sidebar,.card,.stat,.profile,.login-card,.login-hero,.input,.select,.textarea,th,.btn.secondary,.btn.ghost,.alert,.badge,.metric,.toolbar,.pagination,.section-title,.sound-toggle{backdrop-filter:blur(24px) saturate(125%);-webkit-backdrop-filter:blur(24px) saturate(125%)}
      .sidebar{background:linear-gradient(160deg,rgba(28,36,47,.83),rgba(9,13,20,.8));border-right:1px solid var(--line);box-shadow:12px 0 55px #0005;position:relative}
      .sidebar:after{content:"";position:absolute;inset:0 auto 0 0;width:1px;background:linear-gradient(transparent,#dbe6f455,transparent);pointer-events:none}
      .card,.stat,.login-card{background:linear-gradient(135deg,rgba(218,229,240,.105),rgba(68,81,96,.065) 50%,rgba(255,255,255,.025));border:1px solid var(--line);box-shadow:0 20px 60px #0004,inset 0 1px 0 #ffffff25,inset 0 -1px 0 #0003;position:relative}
      .card:before,.login-card:before{content:"";position:absolute;inset:0;border-radius:inherit;pointer-events:none;background:linear-gradient(115deg,#ffffff12,transparent 22%,transparent 75%,#dce7f20a)}
      .stat:after{opacity:.22;filter:blur(7px)}.profile,.input,.select,.textarea{background:rgba(191,205,220,.075);border-color:var(--line);color:var(--ink)}
      .input::placeholder,.textarea::placeholder{color:#8290a1}select option{background:#151c26;color:#fff}input[type=date],input[type=datetime-local]{color-scheme:dark}
      .btn{background:linear-gradient(115deg,#f5f8fb 0%,#aab7c5 19%,#edf2f6 35%,#667585 57%,#dce5ed 77%,#8c9aaa 100%);background-size:220% 100%;color:#10151c;border:1px solid #f4f7fa88;box-shadow:0 8px 28px #c3d1df1b,inset 0 1px #fff9;transition:transform .22s,box-shadow .22s,background-position .4s}
      .btn:hover{background-position:100% 0;box-shadow:0 12px 32px #c3d1df2b,inset 0 1px #fff;transform:translateY(-2px)}.btn.secondary,.btn.ghost{background:linear-gradient(130deg,#ffffff13,#68788a16);border:1px solid var(--line);color:#e8edf3;box-shadow:inset 0 1px #ffffff18}
      th{background:rgba(211,224,237,.07);color:#c6d1dc}td{border-bottom-color:#ffffff15}tbody tr:hover{background:#dbe7f20a}
      .badge{background:#ffffff12;color:#dce5ed;border:1px solid #ffffff10}.badge.menunggu{background:#fbbf2417;color:#f5d995}.badge.disetujui,.badge.dikembalikan,.badge.baik{background:#34d39917;color:#9ce7ca}.badge.ditolak,.badge.rusak{background:#fb718517;color:#f4b8c2}
      .alert.success{background:#34d39915;color:#a5e8cc;border:1px solid #34d39936}.alert.error{background:#fb718515;color:#f6c0c8;border:1px solid #fb718538}
      .login-page{background:transparent}.login-hero{background:linear-gradient(140deg,rgba(185,201,218,.1),rgba(11,16,24,.38));border-right:1px solid var(--line)}.login-card-wrap{background:transparent}.login-card h2{color:#f4f6f8}.field label{color:#d5dee7}.hint{color:#aab6c4}.auth-switch{color:#b4c0cd}.auth-switch a{color:#d8e3ed}
      .sound-toggle{background:linear-gradient(130deg,#dbe4ed1a,#ffffff09);border-color:var(--line);color:#eaf0f5;box-shadow:0 12px 35px #0005,inset 0 1px #ffffff20}.sound-toggle[aria-pressed="true"]{background:#d5e2ef20;color:#f1f6fa;border-color:#dce8f36b}
      .nav a:hover,.nav a.active{background:linear-gradient(90deg,#d7e5f018,#8396ab12);box-shadow:inset 3px 0 #dce7f2}.avatar{background:linear-gradient(145deg,#f7fafc,#9cabb9 30%,#465462 58%,#d9e3eb 78%,#7a8998);color:#111820;box-shadow:inset 0 1px #fff8}
      .brandmark{background:linear-gradient(145deg,#f7fafc,#9cabb9 30%,#465462 58%,#d9e3eb 78%,#7a8998);color:#111820;box-shadow:0 8px 24px #c5d5e61a,inset 0 1px #fff}
      .topbar{border-bottom-color:#ffffff10}.eyebrow{color:#c3ceda}.btn:focus-visible,a:focus-visible,input:focus-visible,select:focus-visible,textarea:focus-visible{outline:2px solid #dce8f3;outline-offset:3px}
      @media(prefers-reduced-motion:reduce){#liquid-metal-bg{display:none}}

      /* PEARL / PLATINUM GLASS — clean light UI inspired by premium wellness apps */
      :root{--bg:#f2f3f1;--card:rgba(255,255,255,.62);--ink:#2b3038;--muted:#747c86;--line:rgba(255,255,255,.92);--blue:#7f8995;--cyan:#b9add5;--green:#568d77;--amber:#ad864a;--red:#b65e6a}
      body{background:radial-gradient(ellipse at 4% 5%,rgba(213,217,224,.82),transparent 34%),radial-gradient(ellipse at 96% 20%,rgba(224,216,238,.65),transparent 30%),linear-gradient(135deg,#f8f8f6,#eef0ee 58%,#f7f7f5);color:var(--ink);background-attachment:fixed;overflow-x:hidden;isolation:isolate}
      #liquid-metal-bg{z-index:-1;opacity:.92;mix-blend-mode:multiply}
      .shell,.login-page,.sound-toggle{position:relative;z-index:1}
      .sidebar,.card,.stat,.profile,.login-card,.login-hero,.input,.select,.textarea,th,.btn.secondary,.btn.ghost,.alert,.badge,.metric,.toolbar,.pagination,.section-title,.sound-toggle{backdrop-filter:blur(25px) saturate(140%);-webkit-backdrop-filter:blur(25px) saturate(140%)}
      .sidebar{background:linear-gradient(160deg,rgba(255,255,255,.82),rgba(233,236,238,.76));color:#303740;border-right:1px solid #fff;box-shadow:12px 0 42px #67717e12;position:relative}
      .sidebar:after{background:linear-gradient(transparent,#fff,transparent)}.brand{color:#303740}.brand small,.nav-label{color:#858c95}
      .nav a{color:#69717b}.nav a:hover,.nav a.active{background:linear-gradient(90deg,#ffffffd9,#e5e6ef9c);color:#333a43;box-shadow:inset 3px 0 #aeb7c2,0 5px 18px #6e77800b}
      .card,.stat,.login-card{background:linear-gradient(135deg,rgba(255,255,255,.86),rgba(255,255,255,.54) 52%,rgba(225,228,232,.45));border:1px solid #fff;box-shadow:0 18px 50px rgba(65,73,84,.09),inset 0 1px 0 #fff,inset 0 -1px 0 rgba(141,151,164,.12);position:relative;color:#303740}
      .card:before,.login-card:before{background:linear-gradient(115deg,#ffffffc7,transparent 22%,transparent 75%,#d9d0e91e)}
      .stat:after{opacity:.14;filter:blur(7px)}.profile,.input,.select,.textarea{background:rgba(255,255,255,.66);border-color:#fff;color:#303740;box-shadow:inset 0 1px 2px #5b65700b,0 5px 18px #5b657008}
      .input::placeholder,.textarea::placeholder{color:#9aa0a8}select option{background:#fff;color:#303740}input[type=date],input[type=datetime-local]{color-scheme:light}
      .btn{background:linear-gradient(115deg,#fff 0%,#dfe3e7 20%,#fdfdfd 37%,#b5bec8 57%,#f8fafb 76%,#c4ccd4 100%);background-size:220% 100%;color:#303740;border:1px solid #fff;box-shadow:0 8px 25px #6c758216,inset 0 1px #fff;transition:transform .22s,box-shadow .22s,background-position .4s}
      .btn:hover{background-position:100% 0;box-shadow:0 12px 30px #6c758222,inset 0 1px #fff;transform:translateY(-2px)}.btn.secondary,.btn.ghost{background:rgba(255,255,255,.7);border:1px solid #fff;color:#555d67;box-shadow:inset 0 1px #fff,0 6px 18px #6c75820a}
      th{background:rgba(255,255,255,.72);color:#626b75}td{border-bottom-color:#e4e6e8;color:#424951}tbody tr:hover{background:#fff8}
      .badge{background:#fff9;color:#5e6670;border:1px solid #fff}.badge.menunggu{background:#fbf0d9;color:#9c7435}.badge.disetujui,.badge.dikembalikan,.badge.baik{background:#e0f0e8;color:#3c795f}.badge.ditolak,.badge.rusak{background:#f7e2e5;color:#a54d5b}
      .alert.success{background:#e4f2ea;color:#39755c;border:1px solid #cbe5d7}.alert.error{background:#f8e5e8;color:#9e4654;border:1px solid #efcdd3}
      .login-page{background:transparent}.login-hero{background:linear-gradient(140deg,rgba(255,255,255,.75),rgba(230,231,237,.5));border-right:1px solid #fff;color:#303740}.login-hero h1,.login-card h2{color:#303740}.login-hero p{color:#737b85}.login-card-wrap{background:transparent}.field label{color:#555e68}.hint,.auth-switch{color:#858c95}.auth-switch a{color:#68727e}
      .sound-toggle{background:rgba(255,255,255,.78);border-color:#fff;color:#5d6670;box-shadow:0 12px 30px #6b748012,inset 0 1px #fff}.sound-toggle[aria-pressed="true"]{background:#e6e2ef;color:#62557f;border-color:#fff}
      .avatar,.brandmark{background:linear-gradient(145deg,#fff 0%,#e5e8ec 24%,#aab3bd 48%,#fff 67%,#c0c8d1 100%);color:#343b45;box-shadow:0 8px 22px #6f7b8a18,inset 0 1px #fff;border:1px solid #fff}
      .topbar{border-bottom-color:#ffffffb8}.eyebrow{color:#858c95}.sub{color:#818892}.stat-label{color:#858c95}.stat-value{color:#303740}
      .btn:focus-visible,a:focus-visible,input:focus-visible,select:focus-visible,textarea:focus-visible{outline:2px solid #aeb7c2;outline-offset:3px}
      @media(prefers-reduced-motion:reduce){#liquid-metal-bg{display:none}}


      /* Pearl Liquid Glass — unified depth, refraction, and responsive interaction */
      :root{--bg:#090d19;--card:rgba(255,255,255,.075);--ink:#f4f6fb;--muted:#a6afc2;--line:rgba(255,255,255,.14);--blue:#b8c9e8;--cyan:#e7edf8;--green:#a8e6d0;--amber:#f4d7a0;--red:#f2b7c0;--glass-shadow:0 28px 80px rgba(0,0,0,.28),inset 0 1px 0 rgba(255,255,255,.2)}
      html{scroll-behavior:smooth}body{background:radial-gradient(ellipse at 15% 5%,#29354b 0,transparent 36%),radial-gradient(ellipse at 88% 70%,#252c3d 0,transparent 40%),linear-gradient(135deg,#0a0e19,#111827 55%,#080b13);background-attachment:fixed;color:var(--ink);cursor:default}
      body:before{content:"";position:fixed;inset:0;z-index:-1;pointer-events:none;opacity:.16;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.18'/%3E%3C/svg%3E")}
      #liquid-metal-bg{position:fixed!important;inset:0;z-index:-1!important;pointer-events:none;opacity:.9;filter:blur(1px)}
      .shell{gap:20px;padding:18px;position:relative}.sidebar{width:252px;border:1px solid rgba(255,255,255,.13);border-radius:26px;padding:25px 17px;background:linear-gradient(155deg,rgba(255,255,255,.12),rgba(255,255,255,.035) 44%,rgba(12,18,31,.64));backdrop-filter:blur(28px) saturate(145%);-webkit-backdrop-filter:blur(28px) saturate(145%);box-shadow:var(--glass-shadow);position:relative;overflow:hidden}.sidebar:before,.card:before,.login-card:before,.profile:before{content:"";position:absolute;inset:0;pointer-events:none;border-radius:inherit;background:linear-gradient(135deg,rgba(255,255,255,.14),transparent 27%,transparent 72%,rgba(255,255,255,.035));opacity:.85}
      .brandmark{background:linear-gradient(145deg,#fff,#cbd5e1 35%,#69778d 60%,#f8fafc 82%,#9ba8ba)!important;color:#151c2b!important;border:1px solid #ffffffb8!important;box-shadow:0 9px 26px #0005,inset 0 1px #fff!important}.brand strong{color:#f8fafc}.brand small{color:#c4d0e3}.nav-label{color:#94a3b8}.nav a{color:#b6c1d4;border:1px solid transparent;position:relative;overflow:hidden}.nav a:hover,.nav a.active{background:linear-gradient(115deg,rgba(255,255,255,.17),rgba(255,255,255,.055));border-color:rgba(255,255,255,.16);box-shadow:inset 0 1px rgba(255,255,255,.15),0 8px 25px #0002;color:#fff}.nav a.active:after{content:"";position:absolute;left:0;top:20%;height:60%;width:2px;background:#e4ecf8;box-shadow:0 0 12px #fff}.sidebar-bottom{border-color:#ffffff20}.sidebar-bottom small{color:#aab6c9}.avatar{background:linear-gradient(145deg,#f8fafc,#aebbd0)!important;color:#202a3b!important}
      .main{padding:20px 20px 45px}.topbar{padding:14px 5px 22px;border-bottom:1px solid rgba(255,255,255,.12);margin-bottom:25px}.eyebrow{color:#c4cedf;letter-spacing:2px}.topbar h1{color:#f7f8fc;font-size:clamp(25px,2.4vw,34px);letter-spacing:-1.3px}.sub{color:#a7b1c3}.profile{position:relative;overflow:hidden;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:#dce4f2;backdrop-filter:blur(18px);box-shadow:inset 0 1px #ffffff16}
      .card{position:relative;overflow:hidden;background:linear-gradient(145deg,rgba(255,255,255,.115),rgba(255,255,255,.045) 55%,rgba(255,255,255,.065));border:1px solid rgba(255,255,255,.16);border-radius:22px;backdrop-filter:blur(24px) saturate(145%);-webkit-backdrop-filter:blur(24px) saturate(145%);box-shadow:0 20px 55px rgba(0,0,0,.19),inset 0 1px rgba(255,255,255,.17);transition:transform .28s ease,border-color .28s ease,box-shadow .28s ease}.card:hover{border-color:rgba(255,255,255,.25);box-shadow:0 28px 70px #0003,inset 0 1px rgba(255,255,255,.22)}.stats .stat{background:linear-gradient(145deg,rgba(255,255,255,.15),rgba(255,255,255,.045));border:1px solid rgba(255,255,255,.17);box-shadow:0 18px 45px #0002,inset 0 1px #ffffff20}.stat:after{background:radial-gradient(circle,rgba(255,255,255,.2),transparent 70%);opacity:.7}.stat-label,.section-title p,.stat-foot{color:#b9c3d5}.stat-value{color:#f6f8fc}.section-title h2{color:#f6f8fc}.btn{background:linear-gradient(135deg,#f8fafc,#cbd5e1 55%,#eef2f7);color:#171e2c;border:1px solid #ffffffb8;box-shadow:0 8px 24px #0002,inset 0 1px #fff;transition:transform .22s ease,box-shadow .22s ease,filter .22s ease}.btn:hover{transform:translateY(-3px);filter:brightness(1.05);box-shadow:0 14px 30px #0004,inset 0 1px #fff}.btn.secondary,.btn.ghost{background:rgba(255,255,255,.09);border-color:rgba(255,255,255,.16);color:#e4eaf4}.btn.danger{background:rgba(190,70,90,.18);border-color:#e9a7b455;color:#ffd4db}.btn.success{background:rgba(58,155,124,.2);border-color:#9ee6cd55;color:#c8f7e7}
      .input,.select,.textarea{background:rgba(5,10,20,.36);border:1px solid rgba(255,255,255,.15);color:#f4f7fb;border-radius:13px;box-shadow:inset 0 2px 8px #0002;transition:border-color .22s,box-shadow .22s,background .22s}.input::placeholder,.textarea::placeholder{color:#7f8ba0}.input:focus,.select:focus,.textarea:focus{background:rgba(5,10,20,.52);border-color:#d6e1f4;box-shadow:0 0 0 4px #dbeafe18,0 0 25px #dbeafe0b}.field label{color:#d5ddec}.hint{color:#9ca9bd}.table-wrap{border-radius:14px}th{background:rgba(255,255,255,.055);color:#aeb9cc}td{border-color:rgba(255,255,255,.085);color:#dce3ee}tbody tr:hover{background:rgba(255,255,255,.055)}.item-sub{color:#a6b1c4}.badge{background:rgba(255,255,255,.1);color:#d4dceb;border:1px solid rgba(255,255,255,.08)}.badge.menunggu,.badge.perlu_perbaikan{background:#a87b2929;color:#ffdda1}.badge.disetujui,.badge.dikembalikan,.badge.baik{background:#3ba98424;color:#aaf0d6}.badge.ditolak,.badge.rusak{background:#c94d6229;color:#ffc2cc}.alert.success{background:#2b9c7624;color:#b8f3dd;border:1px solid #6ee7b733}.alert.error{background:#c94d6224;color:#ffc4cd;border:1px solid #fda4af33}.empty{color:#a6b1c4}
      .login-page{position:relative;isolation:isolate;min-height:100svh;display:grid;grid-template-columns:1fr;align-items:center;justify-items:center;padding:38px 20px;background:transparent;overflow:hidden}.login-page:before{content:"";position:absolute;inset:0;z-index:-1;background:radial-gradient(ellipse at 50% 20%,rgba(206,220,242,.15),transparent 42%),radial-gradient(ellipse at 15% 85%,rgba(150,166,193,.09),transparent 40%);pointer-events:none}.login-hero{position:absolute;inset:0;background:transparent!important;border:0!important;padding:34px clamp(22px,5vw,72px);justify-content:flex-start;pointer-events:none;color:#f7f8fc}.login-hero .brand{pointer-events:auto;width:max-content}.login-hero .brand strong{color:#fff}.login-hero .brand small{color:#cbd5e1}.login-hero .brandmark{pointer-events:auto}.login-hero:after{display:none}.hero-copy{position:absolute;left:clamp(22px,5vw,72px);bottom:48px;max-width:390px;margin:0;opacity:.72}.hero-copy .eyebrow{color:#c6d0e0}.login-hero h1{font-size:clamp(24px,3vw,38px);line-height:1.12;letter-spacing:-1.3px;margin:14px 0 10px;color:#f7f8fc}.login-hero p{font-size:12px;line-height:1.7;color:#aebbd0;max-width:350px}.secure-note{position:absolute;left:clamp(22px,5vw,72px);bottom:20px;margin:0;color:#a8b7cc;font-size:9px}.login-card-wrap{position:relative;z-index:2;width:min(460px,100%);padding:0;display:grid;place-items:center;background:transparent}.login-card{position:relative;isolation:isolate;overflow:hidden;width:100%;padding:clamp(26px,4vw,42px);border:1px solid rgba(255,255,255,.24);border-radius:28px;background:linear-gradient(145deg,rgba(255,255,255,.19),rgba(255,255,255,.075) 44%,rgba(255,255,255,.11));backdrop-filter:blur(34px) saturate(160%);-webkit-backdrop-filter:blur(34px) saturate(160%);box-shadow:0 35px 100px rgba(0,0,0,.42),inset 0 1px rgba(255,255,255,.32),inset 0 -1px rgba(255,255,255,.06);transform-style:preserve-3d}.login-card:after{content:"";position:absolute;inset:0;z-index:-1;border-radius:inherit;background:radial-gradient(circle at var(--shine-x,50%) var(--shine-y,0%),rgba(255,255,255,.17),transparent 43%);pointer-events:none}.login-card h2{color:#f7f8fc;font-size:29px;letter-spacing:-1px}.login-card .sub{color:#b7c2d4;line-height:1.7}.login-card .eyebrow{color:#d5dfef}.login-card .field{margin-bottom:19px}.login-card .field label{font-size:10px;letter-spacing:1.2px;color:#d7e0ef}.login-card .input{padding:14px 15px}.login-card .hint{color:#aeb9ca}.login-card .btn{width:100%;padding:15px;border-radius:13px;margin-top:2px}.checkline{color:#b8c3d5}.checkline input{accent-color:#e4eaf4}.auth-switch{color:#b4bfd1}.auth-switch a{color:#f4f7fb;text-decoration:underline;text-decoration-color:#ffffff70;text-underline-offset:3px}.login-card .alert{position:relative;z-index:1}.sound-toggle{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.18);color:#e2e8f0;backdrop-filter:blur(20px);box-shadow:0 12px 35px #0003,inset 0 1px #ffffff18}.sound-toggle[aria-pressed=true]{background:rgba(255,255,255,.2);color:#fff;border-color:#ffffff55}
      .cursor-aura{position:fixed;z-index:40;left:0;top:0;width:280px;height:280px;border-radius:50%;pointer-events:none;transform:translate(-50%,-50%);background:radial-gradient(circle,rgba(210,224,245,.075),rgba(171,190,219,.025) 35%,transparent 70%);mix-blend-mode:screen;opacity:0;transition:opacity .3s}.cursor-aura.visible{opacity:1}a,button,.btn,input,select,textarea{ -webkit-tap-highlight-color:transparent}a,button,.btn{cursor:pointer}.nav a,.btn,.brandmark,.sound-toggle{will-change:transform}.mobile-menu{display:none}
      @media(max-width:900px){.shell{padding:10px;gap:12px}.sidebar{width:220px}.main{padding:15px 10px 30px}.hero-copy{display:none}.secure-note{display:none}}
      @media(max-width:760px){.shell{padding:0;gap:0}.sidebar{width:auto;border-radius:0 0 22px 22px;margin:8px 8px 0;padding:15px;background:rgba(16,22,36,.82)}.main{padding:18px 13px 32px}.login-page{padding:88px 17px 32px;align-items:center}.login-hero{padding:18px 20px;inset:0 0 auto;height:82px}.login-hero .brandmark{width:36px;height:36px}.login-card{padding:26px 22px;border-radius:23px}.login-card h2{font-size:25px}.topbar{gap:12px}.top-actions{gap:6px}.stats{grid-template-columns:repeat(2,minmax(0,1fr))}.sound-toggle{right:12px;bottom:12px}}
      @media(hover:none),(pointer:coarse){.cursor-aura{display:none}.card:hover{transform:none}}
      @media(prefers-reduced-motion:reduce){.cursor-aura{display:none}.card,.login-card,.btn{transition:none!important}}

</style>
</head>
<body>
<canvas id="liquid-metal-bg" aria-hidden="true"></canvas>
@if(!request()->routeIs('login', 'register'))
<div class="shell">
  <aside class="sidebar">
    <a class="brand" href="{{ route('dashboard') }}"><span class="brandmark">L</span><span><strong>LabRPL</strong><small>LAB EQUIPMENT OS</small></span></a>
    <div><div class="nav-label">WORKSPACE</div><nav class="nav">
      <a class="{{ request()->routeIs('dashboard')?'active':'' }}" href="{{ route('dashboard') }}"><span class="ico">◈</span>Dashboard</a>
      <a class="{{ request()->routeIs('alat.*')?'active':'' }}" href="{{ route('alat.index') }}"><span class="ico">▦</span>Data Alat</a>
      <a class="{{ request()->routeIs('peminjaman.*')?'active':'' }}" href="{{ route('peminjaman.index') }}"><span class="ico">⇄</span>Peminjaman</a>
      @if(auth()->user()->role==='admin')
      <a class="{{ request()->routeIs('pengembalian.*')?'active':'' }}" href="{{ route('pengembalian.index') }}"><span class="ico">↩</span>Pengembalian</a>
      <a class="{{ request()->routeIs('pengguna.*')?'active':'' }}" href="{{ route('pengguna.index') }}"><span class="ico">♙</span>Pengguna</a>
      @endif
    </nav></div>
    <div class="sidebar-bottom"><span class="avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span><div><strong>{{ auth()->user()->name }}</strong><small>{{ ucfirst(auth()->user()->role) }}</small></div></div>
  </aside>
  <main class="main">
    <header class="topbar"><div><div class="eyebrow">LABORATORY / MANAGEMENT</div><h1>@yield('heading','Dashboard')</h1><div class="sub">@yield('subtitle','Kelola inventaris laboratorium dengan lebih mudah.')</div></div><div class="top-actions"><span class="profile">{{ now()->translatedFormat('d M Y') }}</span><form method="POST" action="{{ route('logout') }}">@csrf<button class="btn secondary" type="submit">Keluar ↗</button></form></div></header>
    @if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert error">{{ session('error') }}</div>@endif
    @if($errors->any())<div class="alert error">Periksa kembali input Anda. {{ $errors->first() }}</div>@endif
    @yield('content')
  </main>
</div>
@else
  @yield('content')
@endif
<button class="sound-toggle" id="soundToggle" type="button" aria-pressed="false" aria-label="Aktifkan atau matikan efek suara"><span aria-hidden="true">♫</span><span id="soundLabel">Suara: Mati</span></button>
<script>
(() => {
  const toggle = document.getElementById('soundToggle');
  const label = document.getElementById('soundLabel');
  if (!toggle || !label) return;
  let enabled = false;
  try { enabled = window.localStorage.getItem('labrpl-sfx') === 'on'; } catch (_) {}
  let audioContext = null;
  toggle.setAttribute('aria-pressed', String(enabled));
  label.textContent = enabled ? 'Suara: Aktif' : 'Suara: Mati';
  const playTone = (kind = 'click') => {
    if (!enabled) return;
    try {
      audioContext ||= new (window.AudioContext || window.webkitAudioContext)();
      if (audioContext.state === 'suspended') audioContext.resume();
      const now = audioContext.currentTime;
      const oscillator = audioContext.createOscillator();
      const gain = audioContext.createGain();
      const frequencies = kind === 'success' ? [660, 880] : kind === 'error' ? [240, 190] : [520];
      oscillator.type = 'sine';
      oscillator.frequency.setValueAtTime(frequencies[0], now);
      if (frequencies[1]) oscillator.frequency.setValueAtTime(frequencies[1], now + .09);
      gain.gain.setValueAtTime(.0001, now);
      gain.gain.exponentialRampToValueAtTime(.045, now + .015);
      gain.gain.exponentialRampToValueAtTime(.0001, now + (frequencies[1] ? .22 : .09));
      oscillator.connect(gain); gain.connect(audioContext.destination);
      oscillator.start(now); oscillator.stop(now + (frequencies[1] ? .23 : .1));
    } catch (_) { /* Audio is optional and must never block app actions. */ }
  };
  toggle.addEventListener('click', () => {
    enabled = !enabled;
    try { window.localStorage.setItem('labrpl-sfx', enabled ? 'on' : 'off'); } catch (_) {}
    toggle.setAttribute('aria-pressed', String(enabled));
    label.textContent = enabled ? 'Suara: Aktif' : 'Suara: Mati';
    if (enabled) playTone('success');
  });
  document.querySelectorAll('button.btn, a.btn').forEach((el) => el.addEventListener('click', () => playTone('click')));
  document.querySelectorAll('form').forEach((form) => form.addEventListener('submit', () => playTone('click')));
  if (document.querySelector('.alert.success')) playTone('success');
  if (document.querySelector('.alert.error')) playTone('error');
})();
</script>
<script>
(() => {const canvas=document.getElementById('liquid-metal-bg');if(!canvas)return;const ctx=canvas.getContext('2d',{alpha:true});if(!ctx)return;const reduce=matchMedia('(prefers-reduced-motion: reduce)').matches;let w=0,h=0,dpr=1,tx=-9999,ty=-9999,mx=-9999,my=-9999;const blobs=[{x:.12,y:.18,r:.24,p:.4},{x:.8,y:.28,r:.22,p:2.4},{x:.55,y:.82,r:.29,p:4.1}];function size(){w=innerWidth;h=innerHeight;dpr=Math.min(devicePixelRatio||1,1.5);canvas.width=w*dpr;canvas.height=h*dpr;canvas.style.width=w+'px';canvas.style.height=h+'px';ctx.setTransform(dpr,0,0,dpr,0,0)}function move(e){tx=e.clientX;ty=e.clientY}addEventListener('pointermove',move,{passive:true});addEventListener('pointerleave',()=>{tx=ty=-9999},{passive:true});addEventListener('resize',size,{passive:true});size();function draw(t){mx+=(tx-mx)*.05;my+=(ty-my)*.05;ctx.clearRect(0,0,w,h);ctx.globalCompositeOperation='screen';blobs.forEach((b,i)=>{let x=(b.x+Math.sin(t*.00008+b.p)*.035)*w,y=(b.y+Math.cos(t*.0001+b.p)*.04)*h;if(mx>-1000){let dx=(mx-x)/w,dy=(my-y)/h,pull=Math.max(0,1-Math.hypot(dx,dy)*1.5);x+=dx*w*pull*.1;y+=dy*h*pull*.1}let r=b.r*Math.min(w,h),g=ctx.createRadialGradient(x-r*.2,y-r*.24,0,x,y,r);g.addColorStop(0,'rgba(239,246,252,.13)');g.addColorStop(.22,'rgba(166,187,207,.08)');g.addColorStop(.55,'rgba(77,95,116,.035)');g.addColorStop(1,'rgba(10,15,22,0)');ctx.fillStyle=g;ctx.beginPath();ctx.arc(x,y,r,0,Math.PI*2);ctx.fill();ctx.beginPath();ctx.ellipse(x,y,r*.68,r*.34,t*.00005+b.p,Math.PI*1.05,Math.PI*1.8);ctx.strokeStyle='rgba(224,235,245,.065)';ctx.lineWidth=Math.max(1,r*.006);ctx.stroke()});if(mx>-1000){let r=Math.min(w,h)*.2,g=ctx.createRadialGradient(mx,my,0,mx,my,r);g.addColorStop(0,'rgba(213,228,243,.06)');g.addColorStop(1,'rgba(130,154,179,0)');ctx.fillStyle=g;ctx.fillRect(mx-r,my-r,r*2,r*2)}ctx.globalCompositeOperation='source-over';if(!reduce)requestAnimationFrame(draw)}if(reduce)draw(0);else requestAnimationFrame(draw)})();
</script>

<script>
(() => {
  const fine = matchMedia('(hover:hover) and (pointer:fine)').matches;
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!fine || reduce) return;
  const aura = document.createElement('div'); aura.className = 'cursor-aura'; aura.setAttribute('aria-hidden','true'); document.body.appendChild(aura);
  let x = innerWidth/2, y = innerHeight/2, ax=x, ay=y, raf=0;
  addEventListener('pointermove', e => { x=e.clientX; y=e.clientY; aura.classList.add('visible'); }, {passive:true});
  addEventListener('pointerleave', () => aura.classList.remove('visible'), {passive:true});
  const animate = () => { ax += (x-ax)*.16; ay += (y-ay)*.16; aura.style.left=ax+'px'; aura.style.top=ay+'px'; raf=requestAnimationFrame(animate); };
  animate();
  document.querySelectorAll('.card,.login-card').forEach(card => {
    card.addEventListener('pointermove', e => {
      if (e.pointerType !== 'mouse') return;
      const r=card.getBoundingClientRect(), px=(e.clientX-r.left)/r.width, py=(e.clientY-r.top)/r.height;
      card.style.setProperty('--shine-x',(px*100)+'%'); card.style.setProperty('--shine-y',(py*100)+'%');
      if (card.classList.contains('login-card')) { card.style.transform=`perspective(1100px) rotateX(${(0.5-py)*3}deg) rotateY(${(px-0.5)*3}deg) translateY(-2px)`; }
    }, {passive:true});
    card.addEventListener('pointerleave', () => { card.style.transform=''; card.style.setProperty('--shine-x','50%'); card.style.setProperty('--shine-y','0%'); }, {passive:true});
  });
  document.querySelectorAll('.btn,.nav a,.brandmark,.sound-toggle').forEach(el => {
    el.addEventListener('pointermove', e => { const r=el.getBoundingClientRect(); const dx=(e.clientX-r.left-r.width/2)/r.width; const dy=(e.clientY-r.top-r.height/2)/r.height; if(el.matches('.btn')) el.style.transform=`translate(${dx*2}px,${dy*2}px) translateY(-2px)`; }, {passive:true});
    el.addEventListener('pointerleave', () => { el.style.transform=''; }, {passive:true});
  });
})();
</script>

</body>
</html>
